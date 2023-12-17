<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // private $features = ['user','role'];
    // private $permissions = [
    //     'view', 
    //     'create', 
    //     'update',
    //     'delete',
    //     'rate',
    //     'comment'
    // ];

    private $roles = ['user', 'admin'];
    private $permissions = [
        'can_like',
        'can_comment',
        'can_all'
    ];

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'user_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin_phatkyamal'),
            'gender' => 1,
            'is_active' => 1,
        ]);

        $adminRole = DB::table('role')->insertGetId(['name' => 'admin']);
        DB::table('role')->insertGetId(['name' => 'user']);

        foreach($this->permissions as $permission){
            $permissionId = DB::table('permissions')->insertGetId([
                'name' => $permission,
            ]);

            // Retrieve the Permission model using the ID
            $permissionModel = Permission::find($permissionId);

            // Associate the roles with the permission
            $permissionModel->roles()->sync($adminRole);
        }
    }
}
