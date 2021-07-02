<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id',
        'team2_id',
        'isteam1',
        'isteam2',
        'team1_score',
        'team2_score'
    ];

    public function team1(){
        if($this->isteam1 == 'true'){
            return $this->belongsTo(Team::class, 'team1_id', 'id');
        } else {
            return $this->belongsTo(User::class, 'team1_id', 'id');
        }
    }

    public function team2(){
        if($this->isteam1 == 'true'){
            return $this->belongsTo(Team::class, 'team2_id', 'id');
        } else {
            return $this->belongsTo(User::class, 'team2_id', 'id');
        }
    }
}
