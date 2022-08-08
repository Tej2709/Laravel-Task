<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
        'name'=> 'Super Admin',
        'email'=>'testprojects@kcsitglobal.com',
        'password'=>bcrypt('secret123'),
        'usertype'=>'1',

        ]);
    }
}
