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
    protected $description = 'Delete All Sells(Bid Conversation) if Admin can not Approve Before 06.30PM';

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
        $expire_time = date("H:i:s", strtotime("20:00:00"));
        $current_time = date("H:i:s");
        if($current_time > $expire_time){

            // First get all incomplete deal's bid
            $buy_sells = DB::table('buy_sells')
                ->where('status', '=', '2')
                ->select('buy_sells.*')
                ->get();

            foreach ($buy_sells as $key => $sell) {
                // remove all bids which deal is not completed yet
                $remove_bids = DB::table('buy_sell_conversations')
                                    ->where('buy_sell_id', $sell->id)
                                    ->delete();
           }
            // remove all pending deals which are not completed yet
            $remove_deals = DB::table('buy_sells')->where('status', '=', '2')->delete();
        }
    }
}
