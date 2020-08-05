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
            'principal' => '1'
        ]);

        $admin = App\User::create([
            'username' => 'admin',
            'role_id' => 'owner',
            'name' => 'Distribuidora Frutagro',
            'password' => Hash::make('frutagro'),
        ]);

        $admin->user_emails()->save($admin_email);

        // FIXME: Factory users
        $user_emails = [
            ['email' => 'jen_cadiz@hotmail.com', 'principal' => '1'],
            ['email' => 'jonlle19@gmail.com', 'principal' => '1'],
            ['email' => 'admin@admin.com', 'principal' => '1'],
        ];

        $users = [
            ['username' => 'CarolGut', 'role_id' => 'admin', 'name' => 'Jennifer Cadiz', 'password' => Hash::make('123')],
            ['username' => 'Jonlle', 'role_id' => 'admin', 'name' => 'Jhonatan Llerena', 'password' => Hash::make('190792')],
            ['username' => 'Conejito', 'role_id' => 'person', 'name' => 'Conejito Cadiz', 'password' => Hash::make('123')],
        ];

        for ($i=0; $i < 3; $i++) {
            $email_model = new App\UserEmail($user_emails[$i]);
            $user_model = App\User::create($users[$i]);
            $user_model->user_emails()->save($email_model);
        }

        factory(App\User::class,5)->create()->each(function ($user) {
            $user->user_emails()->save(factory(App\UserEmail::class)->make());
        });
    }
}
