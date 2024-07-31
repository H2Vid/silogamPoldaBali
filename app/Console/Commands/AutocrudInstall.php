<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class AutocrudInstall extends Command
{

    protected $signature = 'autocrud:install';
    protected $description = 'Install a new autocrud CMS and set superadmin user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->ask('Please insert the superadmin email');
        //cek email exists or not
        $warn = self::validateEmail($email);
        if ($warn) {
            $this->error($warn);
            exit();
        }
        if (self::checkEmailUsed($email)) {
            $this->error('Email is already used for another account');
            exit();
        }

        $username = $this->ask('Type your name');
        $password = null;
        while (strlen($password) == 0) {
            $password = $this->secret('Type your password');
            if (strlen($password) < 6) {
                $this->error('Your password too short. Please use at least 6 characters');
            }
        }

        if ($this->confirm('We will create new admin for user ' . $username . ' with email ' . $email . '. Do you wish to continue? ')) {
            //create user
            Artisan::call('autocrud:role');
            self::createUser($email, $username, $password);
            $this->info('Your admin account has been made. You can login with this credential now.');
        }
    }

    protected function checkEmailUsed($email)
    {
        $reformatted_email = reformatEmail($email);
        $n = DB::table('users')->where('email', $email)->orWhere('reformatted_email', $reformatted_email)->count();
        if ($n > 0) {
            return true;
        }

        return false;
    }

    protected function validateEmail($email)
    {
        $validate = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);
        if ($validate->fails()) {
            return $validate->messages()->first();
        }
        return false;
    }

    protected function createUser($email, $username, $password)
    {
        $sa_role = Role::where('is_sa', 1)->first();
        if (empty($sa_role)) {
            $this->error("Fatal error : Fail to create superadmin role, so we cannot create superadmin account right now");
            exit();
        }

        $user = new User;
        $user->name = $username;
        $user->email = $email;
        $user->reformatted_email = reformatEmail($email);
        $user->password = bcrypt($password);
        $user->is_active = 1;
        $user->save();        
        
        DB::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => $sa_role->id,
        ]);
    }
}
