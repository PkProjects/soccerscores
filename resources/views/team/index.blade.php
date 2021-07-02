
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1> Team (and player) Rankings </h1>
                        <canvas id="myChart" width="400" height="300"></canvas>
                        <input id="teamsArray" type="hidden" value="{{$teams}}">
                        <input id="usersArray" type="hidden" value="{{$users}}">
                        <?php $lastScore=100000000;?>
                        @forelse($teams as $team)
                            @forelse($users as $user)
                                @if($lastScore > $user->score && $user->score >= $team->score)
                                    <ul>
                                    <li><b>User ID: {{ $user->id }}</b></li>
                                    <li>User name: {{ $user->name }}</li>
                                    <li>User score: {{ $user->score }}</li>
                                    <li>User teams: 
                                    <ul>
                                    @forelse( $user->teams as $userteam )
                                        <li>{{$userteam->name}}</li>
                                    @empty
                                    @endforelse
                                    </ul>
                                    </li>

                                    <a href="{{ route('user.show', $user->id)}}">-View user-</a>
                                    </ul>
                                @endif
                            @empty
                            @endforelse
                        
                            <?php $lastScore=$team->score;?>
                            <ul>
                            <li><b>Team ID: {{ $team->id }}</b></li>
                            <li>Team name: {{ $team->name }}</li>
                            <li>Team score: {{ $team->score }}</li>
                            <li>Team members: 
                            <ul>
                            @forelse( $team->users as $teamuser )
                                <li>{{$teamuser->name}}</li>
                            @empty
                            @endforelse
                            </ul>
                            </li>

                            <a href="{{ route('team.show', $team->id)}}">-View team-</a>
                            </ul>
                        @empty
                            <p class="text-warning">No orders available</p>
                        @endforelse    

                        @forelse($users as $user)
                            @if($lastScore > $user->score)
                                <ul>
                                <li><b>User ID: {{ $user->id }}</b></li>
                                <li>User name: {{ $user->name }}</li>
                                <li>User score: {{ $user->score }}</li>
                                <li>User teams: 
                                <ul>
                                @forelse( $user->teams as $userteam )
                                    <li>{{$userteam->name}}</li>
                                @empty
                                @endforelse
                                </ul>
                                </li>

                                <a href="{{ route('user.show', $user->id)}}">-View user-</a>
                                </ul>
                            @endif
                        @empty
                        @endforelse
                    </div>         
                </div>       
            </div>
        </div>
    </div>
    <script>
    let teamsArray = JSON.parse(document.getElementById('teamsArray').value);
    let usersArray = JSON.parse(document.getElementById('usersArray').value);
    let teamNameArray = [];
    let teamScoreArray = [];
    teamsArray.forEach(event => teamNameArray.push(event.name));
    teamsArray.forEach(event => teamScoreArray.push(event.score));
    
    //Sorting scores & names
    for(j=0; j<usersArray.length; j++){
        for(i=0; i<teamScoreArray.length; i++){
            if(teamScoreArray[i] <= usersArray[j].score){
                teamScoreArray.splice(i, 0 , usersArray[j].score);
                teamNameArray.splice(i, 0 , usersArray[j].name);
                break;
            } else if(i==teamScoreArray.length-1){
                teamScoreArray.push(usersArray[j].score);
                teamNameArray.push(usersArray[j].name);
                break;
            }
        }
    }
    //Max 10 entries
    teamNameArray.splice(10);
    teamScoreArray.splice(10);

    //Build chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: teamNameArray,
            datasets: [{
                label: 'Team score',
                data: teamScoreArray,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                    y:  {
                        beginAtZero: true
                        }
                    }
                }
            });
    </script>
@endsection