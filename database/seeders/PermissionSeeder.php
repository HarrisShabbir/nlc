<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permissions = [
          // Role Module Permissions
          ['name'=>'role_view', 'guard_name'=>'web'],
          ['name'=>'role_add', 'guard_name' => 'web'],
          ['name'=>'role_edit', 'guard_name'=>'web'],
          ['name'=>'role_delete', 'guard_name'=>'web'],
          ['name'=>'role_has_permission', 'guard_name'=>'web'],

          // Permission Module Permissions
          ['name'=>'permission_view', 'guard_name'=>'web'],
          ['name'=>'permission_add', 'guard_name'=>'web'],
          ['name'=>'permission_edit', 'guard_name'=>'web'],
          ['name'=>'permission_delete', 'guard_name'=>'web'],

          // User Module Permissions
          ['name'=>'user_view', 'guard_name'=>'web'],
          ['name'=>'user_add', 'guard_name'=>'web'],
          ['name'=>'user_edit', 'guard_name'=>'web'],
          ['name'=>'user_delete', 'guard_name'=>'web'],
          ['name'=>'user_has_permission', 'guard_name'=>'web'],

          // Driver Module Permissions
          ['name'=>'driver_view', 'guard_name'=>'web'],
          ['name'=>'driver_add', 'guard_name'=>'web'],
          ['name'=>'driver_edit', 'guard_name'=>'web'],
          ['name'=>'driver_delete', 'guard_name'=>'web'],

          // Distributor Module Permissions
          ['name'=>'distributor_view', 'guard_name'=>'web'],
          ['name'=>'distributor_add', 'guard_name'=>'web'],
          ['name'=>'distributor_edit', 'guard_name'=>'web'],
          ['name'=>'distributor_delete', 'guard_name'=>'web'],

          // Article Module Permissions
          ['name'=>'article_view', 'guard_name'=>'web'],
          ['name'=>'article_add', 'guard_name'=>'web'],
          ['name'=>'article_edit', 'guard_name'=>'web'],
          ['name'=>'article_delete', 'guard_name'=>'web'],

          // Shift Module Permissions
          ['name'=>'shift_view', 'guard_name'=>'web'],
          ['name'=>'shift_add', 'guard_name'=>'web'],
          ['name'=>'shift_edit', 'guard_name'=>'web'],
          ['name'=>'shift_delete', 'guard_name'=>'web'],

          // Vehicle Module Permissions
          ['name'=>'vehicle_view', 'guard_name'=>'web'],
          ['name'=>'vehicle_add', 'guard_name'=>'web'],
          ['name'=>'vehicle_edit', 'guard_name'=>'web'],
          ['name'=>'vehicle_delete', 'guard_name'=>'web'],

          // vendor pool Module Permissions
          ['name'=>'vendor_pool_view', 'guard_name'=>'web'],
          ['name'=>'vendor_pool_add', 'guard_name'=>'web'],
          ['name'=>'vendor_pool_edit', 'guard_name'=>'web'],
          ['name'=>'vendor_pool_delete', 'guard_name'=>'web'],

          // In Loads Module Permissions
          ['name'=>'inload_view', 'guard_name'=>'web'],
          ['name'=>'inload_add', 'guard_name'=>'web'],
          ['name'=>'inload_edit', 'guard_name'=>'web'],
          ['name'=>'inload_delete', 'guard_name'=>'web'],

          // Out Loads Module Permissions
          ['name'=>'outload_view', 'guard_name'=>'web'],
          ['name'=>'outload_add', 'guard_name'=>'web'],
          ['name'=>'outload_edit', 'guard_name'=>'web'],
          ['name'=>'outload_delete', 'guard_name'=>'web'],

          // Category Module Permissions
          ['name'=>'category_view', 'guard_name'=>'web'],
          ['name'=>'category_add', 'guard_name'=>'web'],
          ['name'=>'category_edit', 'guard_name'=>'web'],
          ['name'=>'category_delete', 'guard_name'=>'web'],
      ];
      foreach($permissions as $permission)
      {
        Permission::create($permission);
      }
    }
}
