<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'score',
        'total_goals',
        'games_played',
        'close_victories'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_team');
    }

    public function team1matchup(){
        return $this->hasMany(Matchup::class, 'team1_id', 'id');
    }

    public function team2matchup(){
        return $this->hasMany(Matchup::class, 'team2_id', 'id');
    }
}
