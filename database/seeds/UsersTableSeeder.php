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
        $admin_email = new App\UserEmail([
            'email' => 'admin@frutagro.com',
            'status_id' => 'ac',
            'principal' => '1'
        ]);

        $admin = App\User::create([
            'username' => 'admin',
            'role_id' => 'owner',
            'status_id' => 'ac',
            'name' => 'Distribuidora Frutagro',
            'password' => Hash::make('frutagro'),
        ]);

        $admin->user_emails()->save($admin_email);

        factory(App\User::class, 25)->create()->each(function ($user) {
            $user->user_emails()->save(factory(App\UserEmail::class)->make());
        });
    }
}
