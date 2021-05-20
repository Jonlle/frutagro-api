<?php

use Illuminate\Database\Seeder;

class TeamMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamMembers = [
            ['name' => 'Stave Martin', 'position' => 'Manager', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.', 'file_image' => '10_team.png'],
            ['name' => 'Mark Smith', 'position' => 'Designer', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.', 'file_image' => '98_team.png'],
            ['name' => 'Ryan Printz', 'position' => 'Marketing', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.', 'file_image' => '50_team.png'],
        ];

        foreach ($teamMembers as $row) {
            App\Models\TeamMember::create($row);
        }
    }
}
