<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

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

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'guess']);
        $role1->givePermissionTo('dashboard');
        $role1->givePermissionTo('dashboard.user');
        $role1->givePermissionTo('dashboard.invoice');
        $role1->givePermissionTo('dashboard.item');
        $role1->givePermissionTo('dashboard.payment');
        $role1->givePermissionTo('dashboard.checkout');
        $role1->givePermissionTo('dashboard.checkout.execute');
        $role1->givePermissionTo('dashboard.checkout.process');
        $role1->givePermissionTo('dashboard.checkout.finalized');

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

        $role3 = Role::create(['name' => 'super-admin']);
        $role3->givePermissionTo(Permission::all());
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = Factory(App\Models\User::class)->create([
            'identification' => '789',
            'first_name' => 'Guess',
            'last_name' => 'User',
            'email' => 'guess@demo.com',
            'password' => 'guessuser',
            'role' => 'guess'
        ]);
        $user->assignRole($role1);

        $user = Factory(App\Models\User::class)->create([
            'identification' => '456',
            'first_name' => 'Moderator',
            'last_name' => 'User',
            'email' => 'moderator@demo.com',
            'password' => 'moderatoruser',
            'role' => 'moderator'
        ]);
        $user->assignRole($role2);

        $user = Factory(App\Models\User::class)->create([
            'identification' => '123',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@demo.com',
            'password' => 'admin',
            'role' => 'super-admin'
        ]);
        $user->assignRole($role3);
    }
}