<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Matchup;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class MatchController extends Controller
{
    //
    public function index()
    {
        $matches = Matchup::all();

        return view('match.index', [
            'matches' => $matches
        ]);
    }

    public function create()
    {
        //
        $teams = Team::all();
        $users = User::all();

        return view('match.create', [
            'teams' => $teams,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        //
        try{
            //SOME LOGIC TO ADD DATA TO TEAMS
            if($request->team1 == $request->team2 && $request->isteam1 == $request->isteam2){
                return response()->json([
                    'succes' => false,
                    'message' => "Duplicate teams not allowed!",
                    'error' => "lies"
                ]);
            }
            $validation = $request->validate([
                'team1score' => 'integer',
                'team2score' => 'integer'
            ]);
            $team1;
            $team2;
            $closeVictory = 0;

            if($request->isteam1 == "true"){
                $team1 = Team::find($request->team1);
            } else {
                $team1 = User::find($request->team1);
            }

            if($request->isteam2 == "true"){
                $team2 = Team::find($request->team2);
            } else {
                $team2 = User::find($request->team2);
            }

            if($request->team1score-$request->team2score == 1 || $request->team2score-$request->team1score == 1){
                $closeVictory = 1;
            }

            if($request->team1score > $request->team2score){
                $team1->update([
                    'score' => ($team1->score + 2),
                    'total_goals' => ($team1->total_goals + $request->team1score),
                    'games_played' => ($team1->games_played + 1)
                ]);
                $team2->update([
                    'total_goals' => ($team2->total_goals + $request->team2score),
                    'games_played' => ($team2->games_played + 1)
                ]);
            }elseif($request->team1score < $request->team2score){
                $team2->update([
                    'score' => ($team2->score + 2),
                    'total_goals' => ($team2->total_goals + $request->team2score),
                    'games_played' => ($team2->games_played + 1)
                ]);
                $team1->update([
                    'total_goals' => ($team1->total_goals + $request->team1score),
                    'games_played' => ($team1->games_played + 1)
                ]);
            }else{
                $team1->update([
                    'score' => ($team1->score + 1),
                    'total_goals' => ($team1->total_goals + $request->team1score),
                    'games_played' => ($team1->games_played + 1)
                ]);
                $team2->update([
                    'score' => ($team2->score + 1),
                    'total_goals' => ($team2->total_goals + $request->team2score),
                    'games_played' => ($team2->games_played + 1)
                ]);
            }

            $newMatch = Matchup::create([
                'team1_id' => $request->team1,
                'team2_id' => $request->team2,
                'isteam1' => $request->isteam1,
                'isteam2' => $request->isteam2,
                'team1_score' => $request->team1score,
                'team2_score' => $request->team2score,
            ]);
            
            return response()->json([
                'succes' => true
            ]);
        } catch(Exception $e){

            return response()->json([
                'succes' => false,
                'message' => $request->team1,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function sort(Request $request){
        $matches = Matchup::all(); 
        if($request->sortDate == 1){
            $matches = $matches->sortBy('created_at')->where('created_at', '>', Carbon::now()->subDays(7));
        } else if($request->sortDate == 2){
            $matches = $matches->sortByDesc('created_at')->where('created_at', '>', Carbon::now()->subDays(7));
        } else if($request->sortDate == 3){
            $matches = $matches->sortBy('created_at')->where('created_at', '>', Carbon::now()->subDays(30));
        } else if($request->sortDate == 4){
            $matches = $matches->sortByDesc('created_at')->where('created_at', '>', Carbon::now()->subDays(30));
        }
        //dd($sortedItems);
        return view ('match.index',[
            'matches'  => $matches
        ]);
    }
}
