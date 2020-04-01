
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
        Permission::create(['name' => 'dashboard']);

        Permission::create(['name' => 'dashboard.permission']);
        Permission::create(['name' => 'dashboard.permission.create']);
        Permission::create(['name' => 'dashboard.permission.edit']);
        Permission::create(['name' => 'dashboard.permission.delete']);

        Permission::create(['name' => 'dashboard.role']);
        Permission::create(['name' => 'dashboard.role.create']);
        Permission::create(['name' => 'dashboard.role.edit']);
        Permission::create(['name' => 'dashboard.role.delete']);

        Permission::create(['name' => 'dashboard.user']);
        Permission::create(['name' => 'dashboard.user.create']);
        Permission::create(['name' => 'dashboard.user.edit']);
        Permission::create(['name' => 'dashboard.user.delete']);

        Permission::create(['name' => 'dashboard.item']);
        Permission::create(['name' => 'dashboard.item.create']);
        Permission::create(['name' => 'dashboard.item.edit']);
        Permission::create(['name' => 'dashboard.item.delete']);

        Permission::create(['name' => 'dashboard.invoice']);
        Permission::create(['name' => 'dashboard.invoice.create']);
        Permission::create(['name' => 'dashboard.invoice.edit']);
        Permission::create(['name' => 'dashboard.invoice.delete']);

        Permission::create(['name' => 'dashboard.payment']);
        Permission::create(['name' => 'dashboard.payment.create']);
        Permission::create(['name' => 'dashboard.payment.edit']);
        Permission::create(['name' => 'dashboard.payment.delete']);

        Permission::create(['name' => 'dashboard.checkout']);
        Permission::create(['name' => 'dashboard.checkout.execute']);
        Permission::create(['name' => 'dashboard.checkout.process']);
        Permission::create(['name' => 'dashboard.checkout.finalized']);

        Permission::create(['name' => 'dashboard.importExport']);
        Permission::create(['name' => 'dashboard.invoices.import']);
        Permission::create(['name' => 'dashboard.invoices.exportExcel']);
        Permission::create(['name' => 'dashboard.invoices.exportCsv']);
        Permission::create(['name' => 'dashboard.invoices.exportTxt']);
        Permission::create(['name' => 'dashboard.users.import']);
        Permission::create(['name' => 'dashboard.users.exportExcel']);
        Permission::create(['name' => 'dashboard.users.exportCsv']);
        Permission::create(['name' => 'dashboard.users.exportTxt']);

        // create roles and assign created permissions
        //role1 super-admin all permissions
        $role1 = Role::create(['name' => 'super-admin']);
        $role1->givePermissionTo(Permission::all());

        //role2: moderator, permissions
        $role2 = Role::create(['name' => 'moderator']);
        $role2->givePermissionTo('dashboard');
        $role2->givePermissionTo('dashboard.user');
        $role2->givePermissionTo('dashboard.user.create');
        $role2->givePermissionTo('dashboard.user.edit');
        $role2->givePermissionTo('dashboard.invoice');
        $role2->givePermissionTo('dashboard.invoice.create');
        $role2->givePermissionTo('dashboard.invoice.edit');
        $role2->givePermissionTo('dashboard.item');
        $role2->givePermissionTo('dashboard.item.create');
        $role2->givePermissionTo('dashboard.item.edit');
        $role2->givePermissionTo('dashboard.payment');
        $role2->givePermissionTo('dashboard.payment.create');
        $role2->givePermissionTo('dashboard.payment.edit');
        $role2->givePermissionTo('dashboard.checkout');
        $role2->givePermissionTo('dashboard.checkout.execute');
        $role2->givePermissionTo('dashboard.checkout.process');
        $role2->givePermissionTo('dashboard.checkout.finalized');
        $role2->givePermissionTo('dashboard.importExport');
        $role2->givePermissionTo('dashboard.invoices.import');
        $role2->givePermissionTo('dashboard.users.import');
        $role2->givePermissionTo('dashboard.invoices.exportExcel');
        $role2->givePermissionTo('dashboard.invoices.exportCsv');
        $role2->givePermissionTo('dashboard.invoices.exportTxt');
        $role2->givePermissionTo('dashboard.users.exportExcel');
        $role2->givePermissionTo('dashboard.users.exportCsv');
        $role2->givePermissionTo('dashboard.users.exportTxt');

        //role3: guess, permissions
        $role3 = Role::create(['name' => 'guess']);
        $role2->givePermissionTo('dashboard');
        $role3->givePermissionTo('dashboard.user');
        $role3->givePermissionTo('dashboard.invoice');
        $role3->givePermissionTo('dashboard.item');
        $role3->givePermissionTo('dashboard.payment');
        $role3->givePermissionTo('dashboard.checkout');
        $role3->givePermissionTo('dashboard.checkout.execute');
        $role3->givePermissionTo('dashboard.checkout.process');
        $role3->givePermissionTo('dashboard.checkout.finalized');
    }
}