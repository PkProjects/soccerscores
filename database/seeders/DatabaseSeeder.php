<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $user = \App\Models\User::factory()->create([
            'name'        => 'Admin',
            'email'       => 'admin@admin.com',
            'score'       => 5, 
            'password'    => bcrypt('password')
        ]);
        $team = \App\Models\Team::factory()->create([
            'name'        => 'TestTeam1',
            'score'         => 10
        ]);
        $team->users()->attach(1);
        $team->users()->attach(2);
        $team = \App\Models\Team::factory()->create([
            'name'        => 'TestTeam2',
            'score'         => 5
        ]);
        $team->users()->attach(2);
        $team->users()->attach(3);
        $team = \App\Models\Team::factory()->create([
            'name'        => 'TestTeam3',
            'score'         => 3
        ]);
        $team->users()->attach(4);
        $team->users()->attach(5);
        $matchup = \App\Models\Matchup::factory()->create([
            'team1_id'        => '1',
            'team2_id'        => '2',
            'team1_score'        => '5',
            'team2_score'        => '7',
            'isteam1'        => 'true',
            'isteam2'        => 'true',
            'created_at'        =>  now()->subDays(29)
        ]);
        $matchup = \App\Models\Matchup::factory()->create([
            'team1_id'        => '2',
            'team2_id'        => '3',
            'team1_score'        => '2',
            'team2_score'        => '9',
            'isteam1'        => 'true',
            'isteam2'        => 'true',
            'created_at'        =>  now()->subDays(6)
        ]);
        $matchup = \App\Models\Matchup::factory()->create([
            'team1_id'        => '1',
            'team2_id'        => '3',
            'team1_score'        => '15',
            'team2_score'        => '1',
            'isteam1'        => 'false',
            'isteam2'        => 'false',
            'created_at'        =>  now()->subDays(2)
        ]);
        $matchup = \App\Models\Matchup::factory()->create([
            'team1_id'        => '6',
            'team2_id'        => '7',
            'team1_score'        => '6',
            'team2_score'        => '15',
            'isteam1'        => 'false',
            'isteam2'        => 'false',
            'created_at'        =>  now()->subDays(2)
        ]);
    }
}
