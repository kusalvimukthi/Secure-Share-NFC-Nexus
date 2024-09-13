<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);

        $adminPermissions = [
            'create_customers',
            'delete_customers',
            'update_customers',
            'create_supervisors',
            'delete_supervisors',
            'update_supervisors',
            'view_cards',
            'create_cards',
            'update_cards',
            'delete_cards',
            'view_wallets',
            'create_wallets',
            'update_wallets',
            'delete_wallets',
            'view_custom_card',
            'create_custom_card',
            'update_custom_card',
            'delete_custom_card',
            'view_pet_tag',
            'create_pet_tag',
            'update_pet_tag',
            'delete_pet_tag',
            'view_storage_tag',
            'create_storage_tag',
            'update_storage_tag',
            'delete_storage_tag'
            ];

        $supervisorPermissions = [
            'view_cards',
            'update_cards',
            'delete_cards',
            'create_wallets',
            'update_wallets',
            'delete_wallets',
            'create_custom_card',
            'update_custom_card',
            'delete_custom_card',
            'create_pet_tag',
            'update_pet_tag',
            'delete_pet_tag',
            'create_storage_tag',
            'update_storage_tag',
            'delete_storage_tag'
        ];

        $customerPermissions = [
            'view_cards',
            'view_wallets',
            'view_custom_card',
            'view_pet_tag',
            'view_storage_tag',
            'update_cards',
            'update_custom_card',
            'update_wallets',
            'update_pet_tag',
            'update_storage_tag',
        ];

        foreach ($adminPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $adminRole->givePermissionTo($perm);
        }

        foreach ($customerPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $customerRole->givePermissionTo($perm);
        }

        foreach ($supervisorPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $supervisorRole->givePermissionTo($perm);
        }
    }
}
