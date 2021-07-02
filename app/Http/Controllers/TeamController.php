<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;

class TeamController extends Controller
{
    // 
    public function index()
    {
        //
        $teams = Team::all();
        $teams = $teams->sortByDesc('score')->values();
        $users = User::all();
        $users = $users->sortByDesc('score')->values();
        
        return view('team.index', [
            'teams' => $teams,
            'users' => $users
        ]);
    }

    public function matcher(Request $request)
    {
        //
        try{
            $avgArray = [];
            foreach($request->teams as $teamId){
                $tempTeam = Team::find($teamId);
                if($tempTeam->games_played != 0){
                    $tempAvg = $tempTeam->score/$tempTeam->games_played;
                } else {
                    $tempAvg = 1;
                }
                $avgArray[] = $tempAvg;
            }
            foreach($request->users as $userId){
                $tempUser = User::find($userId);
                if($tempUser->games_played != 0){
                    $tempAvg = $tempUser->score/$tempUser->games_played;
                } else {
                    $tempAvg = 1;
                }
                $avgArray[] = $tempAvg;
            }
            $inputRating = 0;
            foreach($avgArray as $average){
                $inputRating += $average;
            }
            $inputRating = $inputRating / count($avgArray);

            $teamsArray = [];
            $teams = Team::all();
            foreach($teams as $team){
                if($team->games_played != 0){
                    $average = $team->score / $team->games_played;
                } else {
                    $average = 1;
                }
                if($average*0.8 <= $inputRating && $inputRating*0.8 <= $average){
                    $teamsArray[] = $team;
                }
            }

            $usersArray = [];
            $users = User::all();
            foreach($users as $user){
                if($user->games_played != 0){
                    $average = $user->score / $user->games_played;
                } else {
                    $average = 1;
                }
                if($average*0.8 <= $inputRating && $inputRating*0.8 <= $average){
                    $usersArray[] = $user;
                }
            }
            return response()->json([
                'succes' => true,
                'teamsArray' => $teamsArray,
                'usersArray' => $usersArray
            ]);
        } catch(Exception $e){
            return response()->json([
                'succes' => false,
                'request' => $request,
                'message' => $e->getMessage()
            ]);
        } 
    }

    public function showMatcher(){
        
        $teams = Team::all();
        $users = User::all();

        return view('team.matcher', [
            'teams' => $teams,
            'users' => $users
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teams = Team::all();
        $users = User::all();

        return view('team.create', [
            'teams' => $teams,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{

            $newTeam = Team::create([
                'name' => $request->name
            ]);
            foreach($request->users as $id){
                $newTeam->users()->attach($id);
            }
            

            return response()->json([
                'succes' => true
            ]);
        } catch(Exception $e){

            return response()->json([
                'succes' => false,
                'request' => $request->item,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
        return view('team.show', [
            'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
        $team->update([
            'name' => $request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
        $team->delete();
    }
}
