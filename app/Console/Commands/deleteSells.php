<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class deleteSells extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:sells';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete All Sells(Bid Conversation) if Admin can not Approve Before 02.30PM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d H:i:s');
        $expire_time = date("H:i:s", strtotime("17:00:00"));
        $current_time = date("H:i:s");

        if($current_time > $expire_time)
        {
            $remove_bids = DB::table('buy_sells')->where('status', 1)->delete();
            $remove_bids_conv = DB::table('buy_sell_conversations')->delete();
            // remove all pending deals which are not completed yet
            $remove_deals = DB::table('buy_sells')->where('status', '=', '1')->delete();

            $all_done_deals = DB::table('buy_sells')
                ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                ->join('users','users.id', '=', 'buy_sells.seller_id')
                ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                ->join('categories', 'categories.id', '=', 'inv.commodity')
                ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                ->where('buy_sells.status', 2)
                ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.mandi_license', 'users.fname as seller_name', 'categories.category', 'categories.mandi_fees', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.gate_pass_wr', 'inv.image')
                ->get();

            foreach ($all_done_deals as $key => $done_deals) 
            {
                $deal_id = $done_deals->id;
                $inventory_id = $done_deals->seller_cat_id;
                $quantity = $done_deals->quantity;
                $buyer_id = $done_deals->buyer_id;
                $seller_id = $done_deals->seller_id;
                $warehouse_id = $done_deals->warehouse_id;
                $price = $done_deals->price;
                $quality_category = $done_deals->quality_category;

                // get old sell quantity of this inventory
                $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

                $remaining_quantity = $inventory_info->quantity - $quantity;
                $date = date('Y-m-d H:i:s');

                //$trader_inventory = DB::table('inventories')->where(['user_id' => $buyer_id, 'commodity' => $inventory_info->commodity])->first();

                // If trader have this commodity already then update quantity
                /*if(!empty($trader_inventory)){

                    $update_trader_quantity = DB::table('inventories')->where('id', $trader_inventory->id)->update([

                        'quantity' => $trader_inventory->quantity + $quantity,
                        'updated_at' => $date,
                    ]);

                }else{
*/
                    // If trader do not have this commodity already then insert this commodity with this teader
                    $cate = DB::table('categories')->where('id', $inventory_info->commodity)->first();
                    $new_cate = DB::table('categories')->where(['category' => $cate->category, 'commodity_type' => 'Paid'])->first();


                    // If trader do not have this commodity already then insert this commodity with this teader
                    $insert_id = DB::table('inventories')->insertGetId([

                        'user_id'          => $buyer_id,
                        'warehouse_id'     => $inventory_info->warehouse_id,
                        'commodity'        => $new_cate->id,
                        'quantity'         => $quantity,
                        'gate_pass_wr'     => $gate_pass,
                        'price'            => $price,
                        'quality_category' => $quality_category,
                        'sales_status'     => 2,
                        'image'            => $done_deals->image,
                        'status'           => 1,
                        'created_at'       => $date,
                        'updated_at'       => $date,
                    ]);
                /*}*/

                //Get Remainning Inverntry From Farmer
                $inventory_info_seller = DB::table('inventories')->where(['user_id' => $seller_id, 'warehouse_id' => $warehouse_id, 'commodity' => $inventory_info->commodity])->first();

                if($inventory_info_seller->quantity == 0)
                {
                    $data = array(
                        'quantity' => $remaining_quantity,
                        'sell_quantity' => null,
                        'updated_at'    => $date,
                        'status'        => 0,
                    );
                }else{
                    $data = array(                
                        'quantity'      => $remaining_quantity,
                        'sell_quantity' => null,
                        'updated_at'    => $date,
                    );
                }

                // update inventory / qauantity of farmaer
                $update_sell_quantity = DB::table('inventories')->where('id', $inventory_info_seller->id)->update($data);

                //If Send pdf to email
                //$data = json_decode(json_encode($done_deals),true);

                //$pdf = PDF::loadView('vikray_parchi_pdf', $data);

                //$pdf->download('vikray_parchi.pdf');

                //Get User Old Power
                $user = DB::table('user_details')->where('user_id', $buyer_id)->first();

                $new_power = $user->power - ($quantity * $price);
                $date = date('Y-m-d H:i:s');

                //Update sell status
                $update_buy_sells = DB::table('buy_sells')->where('id', $deal_id)->update([
                    'status' => 3,
                    'updated_at' => $date
                ]);

                //Update Power of Trader
                $user_power_update = DB::table('user_details')->where('user_id', $buyer_id)->update([
                    'power' => $new_power,
                    'updated_at' => $date,
                ]);

                //Send SMS to Seller
                $user = DB::table('users')->where('id', $seller_id)->first();

                //Send Message after Deal Done
                $sms = 'Congratulations. Your Payment done by Admin';
                $done = sendsms($user->phone, $sms);
            }
        }
    }
}
