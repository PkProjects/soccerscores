
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1> Team info </h1>
                            <ul>
                                    <li><b>Team ID: {{ $team->id }}</b></li>
                                    <li>Team name: {{ $team->name }}</li>
                                    <li>Team score: {{ $team->score }}</li>
                                    <li>Team total goals: {{ $team->total_goals }}</li>
                                    <li>Team total games played: {{ $team->games_played }}</li>
                                    <li>Team close victories: {{ $team->close_victories }}</li>
                                    <li>Team members: 
                                    <ul>
                                    @forelse( $team->users as $user )
                                        <li>{{$user->name}}</li>
                                    @empty
                                    @endforelse
                                    </ul>
                                    </li>   
                                    <li>Matches played: 
                                    <ul>
                                    @forelse( $team->team1matchup as $team1 )
                                        @if($team1->isteam1 == "true")
                                            <li>Match #: {{$team1->id}}</li>
                                            <li>Team {{$team1->team1_id}}</li>
                                            <li>Score  : {{$team1->team1_score}}</li>
                                            @if($team1->isteam2 == "true")
                                                <li>Team {{$team1->team2_id}}</li>
                                            @else
                                                <li>Player {{$team1->team2_id}}</li>
                                            @endif
                                            <li>Score  : {{$team1->team2_score}}</li>
                                            <BR/>
                                        @endif
                                    @empty
                                    @endforelse
                                    @forelse( $team->team2matchup as $team2 )
                                        @if($team2->isteam2 == "true")
                                            <li>Match #: {{$team2->id}}</li>
                                            <li>Team {{$team2->team1_id}}</li>
                                            <li>Score  : {{$team2->team1_score}}</li>
                                            @if($team2->isteam2 == "true")
                                                <li>Team {{$team2->team2_id}}</li>
                                            @else
                                                <li>Player {{$team2->team2_id}}</li>
                                            @endif
                                            <li>Score  : {{$team2->team2_score}}</li>
                                            <BR/>
                                        @endif
                                    @empty
                                    @endforelse
                                    </ul>
                                    </li>
                                </ul>
                    </div>         
                </div>       
            </div>
        </div>
    </div>
@endsection