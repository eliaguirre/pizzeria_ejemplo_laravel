<?php

use Illuminate\Database\Seeder;
use App\Users;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        Users::create(array('email' => 'ventas@ventas.com','name'=>'Ventas','role'=>'venta','password'=>Crypt::encryptString('pass')));
        Users::create(array('email' => 'admin@ventas.com','name'=>'Admin','role'=>'admin','password'=>Crypt::encryptString('pass')));
    }
}
