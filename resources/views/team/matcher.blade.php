@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{ route('team.create') }}" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Build a team</h1>
                    <p>Fill out this form to get suggestions for opponents</p>

                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">

                            <div id="userdiv" class="control-group col-12 mt-2" route="{{route('team.matcher')}}">
                                <p>Compose your team from teams and/or individual players!</p>
                            </div>
                            <button type="button" class="btn btn-info" id="adduser" onclick="addPlayer();">
                                Add Player
                            </button>
                            <button type="button" class="btn btn-info" id="addteam" onclick="addTeam();">
                                Add Team
                            </button>

                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button type="button" id="btn-submit" class="btn btn-primary" onclick="getMatch();">
                                    Get suggestions!
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="suggestions"></div>
                </div>
    </div>
<script>

    let playerAmount = 0;
    let teamAmount = 0;

    function addPlayer(){
        playerAmount += 1;
        let userdiv = document.getElementById('userdiv');
        userdiv.innerHTML += '<select id="player' + playerAmount + '" name="player' + playerAmount + '" class="form-control" required> @foreach ($users as $user) <option value= "{{ $user->id }}">{{ $user->name }}</option> @endforeach </select>';
    }

    function addTeam(){
        teamAmount += 1;
        let userdiv = document.getElementById('userdiv');
        userdiv.innerHTML += '<select id="team' + teamAmount + '" name="team' + teamAmount + '" class="form-control" required> @foreach ($teams as $team) <option value= "{{ $team->id }}">{{ $team->name }}</option> @endforeach </select>';
    }

    function getMatch(){
        let putRoute = document.getElementById('userdiv').getAttribute('route');
        let playerArray = [];
        let teamArray = [];
        for(i=0;i<playerAmount;i++){
            let newPlayer = document.getElementById('player' + (i+1) + '').value;
            playerArray.push(newPlayer);
        }
        for(i=0;i<teamAmount;i++){
            let newTeam = document.getElementById('team' + (i+1) + '').value;
            teamArray.push(newTeam);
        }

        axios({
            url: putRoute,
            method: 'PUT',
            data: {
                teams: teamArray,
                users: playerArray
            }
        }).then(function(response){
            if (response.data.succes === true) {
                console.log('yay!');
                listSuggestions(response.data.teamsArray, response.data.usersArray);
                alert('Suggestions succesfully loaded!');
            } else {
                console.log('This is not okay');
            }
        }).catch(function(response){
            console.log(response.data.message);
        });
    }

    function listSuggestions($teamsArray, $usersArray){
        let suggestionsDiv = document.getElementById('suggestions');
        $teamsArray.forEach( team => suggestionsDiv.innerHTML +=  "Team: " + team.name + "<BR/>");
        $usersArray.forEach( user => suggestionsDiv.innerHTML +=  "Player: " + user.name + "<BR/>");
        //suggestionsDiv.innerHTML =  

    }
</script>

@endsection