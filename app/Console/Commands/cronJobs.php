<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class cronJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:bid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        // Make empty all commodities price and sell quantity
        $remove_prices = DB::table('inventories')->update([

            'sell_quantity' => null,
            'price' => 0,
            'updated_at' => $date
        ]);

        // remove all pending deals which are not completed yet
        $remove_deals = DB::table('buy_sells')->where('status', '!=', '2')->delete();

        // First get all incomplete deal's bid
        $bids = DB::table('buy_sell_conversations')
                ->join('buy_sells', 'buy_sells.id', '=', 'buy_sell_conversations.buy_sell_id')
                ->where('buy_sells.status', '!=', '2')
                ->select('buy_sell_conversations.*')
                ->get();

        foreach ($bids as $key => $bid) {
            
            // remove all bids which deal is not completed yet
            $remove_bids = DB::table('buy_sell_conversations')->where('id', $bid->id)->delete();        

        }
    }
}
