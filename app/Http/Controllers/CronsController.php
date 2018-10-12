<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CronsController extends Controller
{
    // Admin dashboard view
    public function crons(){

    	$date = date('Y-m-d H:i:s');

    	// Make empty all commodities price and sell quantity
    	$remove_prices = DB::table('inventories')->update([

    		'sell_quantity' => null,
    		'price' => 0,
    		'updated_at' => $date
    	]);

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

    	// remove all pending deals which are not completed yet
    	$remove_deals = DB::table('buy_sells')->where('status', '!=', '2')->delete();
    }
}
