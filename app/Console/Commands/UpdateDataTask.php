<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Department;
use Crypt;

class UpdateDataTask extends Command
{
    protected $signature = 'user:update';

    protected $description = 'Update user data';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    

    /**
     * The console command description.
     *
     * @var string
     */

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
     * @return int
     */
    public function handle()
    {
        $users = User::get();
        $currentYear = Carbon::now()->year;
        foreach ($users as $user)
        {
        // Lấy chuỗi cần kiểm tra
        $chuoi = $user->course;
        if($user->course == '' )
        {
            $user->save();
        }
        else{
            // Lấy 4 số cuối của chuỗi
        $lastFourDigits = substr($chuoi, -4);
        $userCourse = $lastFourDigits + 1 ;
        if ($userCourse == $currentYear) {
                $user->status = '4';
                $user->save();
            }
        }       
    }
}

}
