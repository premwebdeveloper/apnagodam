<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class expireOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login Mobile OTP Expire in 1 Min.';

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

        //Get All User Data they recently logedin with otp
        $users = DB::table('users')->where('status', 1)->get();

        foreach ($users as $key => $user) {

            $given_time = date('Y-m-d H:i:s',  strtotime("+1 minute", strtotime($user->updated_at)));
            $current_time = date('Y-m-d H:i:s');
            if(!is_null($user->login_otp))
            {
                if($current_time > $given_time)
                {
                    //Remove OTP
                    $expir = DB::table('users')->where('id', $user->id)->update(['login_otp' => null, 'updated_at' => $date]);
                }
            }
        }
    }
}
