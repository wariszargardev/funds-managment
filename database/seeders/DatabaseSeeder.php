<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Editor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'phone_number'=>'03086529243',
            'password'=>Hash::make('password'),
        ]);

        Editor::create([
            'name'=>'editor',
            'email'=>'editor@editor.com',
            'phone_number'=>'03086529243',
            'password'=>Hash::make('password'),
            'admin_id'=>1,
        ]);

    }
}
