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
            'role_id' => 1,
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
            ['username' => 'CarolGut', 'role_id' => 2, 'name' => 'Jennifer Cadiz', 'password' => Hash::make('123')],
            ['username' => 'Jonlle', 'role_id' => 2, 'name' => 'Jhonatan Llerena', 'password' => Hash::make('190792')]
        ];

        for ($i=0; $i < 2; $i++) {
            $email_model = new App\UserEmail($admin_emails[$i]);
            $admin_model = App\User::create($admins[$i]);
            $admin_model->user_emails()->save($email_model);
        }

        $customer = App\User::create(['username' => 'Conejito', 'role_id' => 3, 'name' => 'Conejito Cadiz', 'document_type_id' => 'ci', 'document' => 'V21375756', 'password' => Hash::make('123')]);

        $customer_email = new App\UserEmail(['email' => 'admin@admin.com', 'principal' => '1']);

        $customer_address = new App\UserAddress(['address_type_id' => 'domicilio', 'postal_code' => '1090', 'state_id' => 24, 'city_id' => 149, 'address' => 'El Valle, Caracas']);

        $user_phone = new App\UserPhone(['phone_number' => '04162133470', 'principal' => '1']);

        $customer->user_emails()->save($customer_email);
        $customer->user_addresses()->save($customer_address);
        $customer->user_phones()->save($user_phone);

        factory(App\User::class,5)->create()->each(function ($user) {
            $user->user_emails()->save(factory(App\UserEmail::class)->make());
        });
    }
}
