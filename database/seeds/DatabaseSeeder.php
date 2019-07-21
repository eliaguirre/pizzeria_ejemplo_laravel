<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Pizza;
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
        User::create(array('email' => 'ventas@ventas.com','name'=>'Ventas','role'=>'venta','password'=>Hash::make('pass')));
        User::create(array('email' => 'admin@admin.com','name'=>'Admin','role'=>'admin','password'=>Hash::make('pass')));
        Pizza::create(array('name' => 'Simple Pizza','price'=> 30.50 ));
        Pizza::create(array('name' => 'Awesome Pizza','price'=> 130.70 ));
        Pizza::create(array('name' => 'Just Pizza','price'=> 70.50 ));
        Pizza::create(array('name' => 'Two Pizza','price'=> 90.00 ));
        Pizza::create(array('name' => 'Other Pizza','price'=> 110 ));

    }
}
