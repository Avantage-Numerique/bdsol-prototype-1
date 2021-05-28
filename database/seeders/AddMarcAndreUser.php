<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Domain\Users\Models\User;

class AddMarcAndreUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App::environment() == 'local' || \App::environment() == 'staging') {
            $target_user = User::create([
                'name' => 'Marc-André Martin',
                'email' => 'marcandre@mamarmite.com',
                'password' => \Hash::make('h44VGW@K^8>FBW?iY])k0RRm+')
            ]);
            //$target_user = User::where('email','marcandre@mamarmite.com')->first();
            $target_user->assignRole('admin');
        }
    }
}
