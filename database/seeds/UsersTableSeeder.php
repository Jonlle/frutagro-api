<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner_email = new App\UserEmail([
            'email' => 'admin@frutagro.com',
            'principal' => '1'
        ]);

        $owner = App\User::create([
            'username' => 'admin',
            'role_id' => 'owner',
            'name' => 'Distribuidora Frutagro',
            'password' => Hash::make('frutagro'),
        ]);

        $owner->user_emails()->save($owner_email);

        // FIXME: Factory users
        $admin_emails = [
            ['email' => 'jen_cadiz@hotmail.com', 'principal' => '1'],
            ['email' => 'jonlle19@gmail.com', 'principal' => '1']
        ];

        $admins = [
            ['username' => 'CarolGut', 'role_id' => 'admin', 'name' => 'Jennifer Cadiz', 'password' => Hash::make('123')],
            ['username' => 'Jonlle', 'role_id' => 'admin', 'name' => 'Jhonatan Llerena', 'password' => Hash::make('190792')]
        ];

        for ($i=0; $i < 2; $i++) {
            $email_model = new App\UserEmail($admin_emails[$i]);
            $admin_model = App\User::create($admins[$i]);
            $admin_model->user_emails()->save($email_model);
        }

        $customer = App\User::create(['username' => 'Conejito', 'role_id' => 'person', 'name' => 'Conejito Cadiz', 'password' => Hash::make('123')]);

        $customer_email = new App\UserEmail(['email' => 'admin@admin.com', 'principal' => '1']);

        $customer_address = new App\UserAddress(['address_type_id' => 'domicilio', 'postal_code' => '1090', 'state_id' => 24, 'city_id' => 149, 'address' => 'El Valle, Caracas']);

        $customer->user_emails()->save($customer_email);
        $customer->user_addresses()->save($customer_address);

        factory(App\User::class,5)->create()->each(function ($user) {
            $user->user_emails()->save(factory(App\UserEmail::class)->make());
        });
    }
}
