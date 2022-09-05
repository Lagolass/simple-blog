<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Orchid\Platform\Models\Role;
use Orchid\Support\Facades\Dashboard;

class AddUserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('orchid:admin admin admin@admin admin');

        $role = Role::create([
           'slug' => 'admin',
           'name' => 'Admin',
           'permissions' => Dashboard::getAllowAllPermission()->all(),
        ]);

        DB::table('role_users')->insert([
            'user_id' => 1,
            'role_id' => $role->id,
        ]);
    }
}
