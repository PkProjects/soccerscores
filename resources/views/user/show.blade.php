
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1> User info </h1>
                            <ul>
                                    <li><b>User ID: {{ $user->id }}</b></li>
                                    <li>User name: {{ $user->name }}</li>
                                    <li>User score: {{ $user->score }}</li>
                                    <li>User total goals: {{ $user->total_goals }}</li>
                                    <li>User total games played: {{ $user->games_played }}</li>
                                    <li>User close victories: {{ $user->close_victories }}</li>
                                    <li>User teams: 
                                    <ul>
                                    @forelse( $user->teams as $team )
                                        <li>{{$team->name}}</li>
                                    @empty
                                    @endforelse
                                    </ul>
                                    </li>   
                                    <li>Matches played: 
                                    <ul>
                                    @forelse( $user->team1matchup as $user1 )
                                        @if($user1->isteam1 == "false")
                                            <li>Match #: {{$user1->id}}</li>
                                            <li>User {{$user1->team1_id}}</li>
                                            <li>Score  : {{$user1->team1_score}}</li>
                                            @if($user1->isteam2 == "true")
                                                <li>Team {{$user1->team2_id}}</li>
                                            @else
                                                <li>Player {{$user1->team2_id}}</li>
                                            @endif
                                            <li>Score  : {{$user1->team2_score}}</li>
                                            <BR/>
                                        @endif
                                    @empty
                                    @endforelse
                                    @forelse( $user->team2matchup as $user2 )
                                        @if($user2->isteam2 == "false")
                                            <li>Match #: {{$user2->id}}</li>
                                            <li>Team {{$user2->team1_id}}</li>
                                            <li>Score  : {{$user2->team1_score}}</li>
                                            @if($user2->isteam2 == "true")
                                                <li>Team {{$user2->team2_id}}</li>
                                            @else
                                                <li>Player {{$user2->team2_id}}</li>
                                            @endif
                                            <li>Score  : {{$user2->team2_score}}</li>
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