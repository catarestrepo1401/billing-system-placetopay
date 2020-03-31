
<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'create item']);
        Permission::create(['name' => 'read items']);
        Permission::create(['name' => 'update item']);
        Permission::create(['name' => 'delete item']);

        Permission::create(['name' => 'create invoice']);
        Permission::create(['name' => 'read invoices']);
        Permission::create(['name' => 'update invoice']);
        Permission::create(['name' => 'delete invoice']);

        Permission::create(['name' => 'create payment']);
        Permission::create(['name' => 'read payments']);
        Permission::create(['name' => 'update payment']);
        Permission::create(['name' => 'delete payment']);

        Permission::create(['name' => 'read checkouts']);
        Permission::create(['name' => 'url place_to_pay for payment']);
        Permission::create(['name' => 'process payment']);
        Permission::create(['name' => 'finalized payment']);

        Permission::create(['name' => 'import invoices']);
        Permission::create(['name' => 'import users']);

        Permission::create(['name' => 'export invoices excel']);
        Permission::create(['name' => 'export invoices csv']);
        Permission::create(['name' => 'export invoices txt']);
        Permission::create(['name' => 'export users excel']);
        Permission::create(['name' => 'export users csv']);
        Permission::create(['name' => 'export users txt']);

        // create roles and assign created permissions
        //role1 super-admin all permissions
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo(Permission::all());

        //role2: moderator, permissions
        $role2 = Role::create(['name' => 'moderator']);
        $role2->givePermissionTo('create user');
        $role2->givePermissionTo('read users');
        $role2->givePermissionTo('update user');
        $role2->givePermissionTo('create invoice');
        $role2->givePermissionTo('read invoices');
        $role2->givePermissionTo('update invoice');
        $role2->givePermissionTo('create item');
        $role2->givePermissionTo('read items');
        $role2->givePermissionTo('update item');
        $role2->givePermissionTo('create payment');
        $role2->givePermissionTo('read payments');
        $role2->givePermissionTo('update payment');
        $role2->givePermissionTo('import invoices');
        $role2->givePermissionTo('import users');
        $role2->givePermissionTo('export invoices excel');
        $role2->givePermissionTo('export invoices csv');
        $role2->givePermissionTo('export invoices txt');
        $role2->givePermissionTo('export users excel');
        $role2->givePermissionTo('export users csv');
        $role2->givePermissionTo('export users txt');
        $role2->givePermissionTo('read checkouts');
        $role2->givePermissionTo('url place_to_pay for payment');
        $role2->givePermissionTo('process payment');
        $role2->givePermissionTo('finalized payment');

        //role3: guess, permissions
        $role3 = Role::create(['name' => 'guess']);
        $role3->givePermissionTo('read users');
        $role3->givePermissionTo('read invoices');
        $role3->givePermissionTo('read items');
        $role3->givePermissionTo('read payments');
        $role2->givePermissionTo('read checkouts');
        $role2->givePermissionTo('url place_to_pay for payment');
        $role2->givePermissionTo('process payment');
        $role2->givePermissionTo('finalized payment');
    }
}