<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 
    public function run()
    {
        $adminData = [
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678')
        ];
        User::create($adminData)->assignRole(Role::where('name','admin')->first());
    }
}
