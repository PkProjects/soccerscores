@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{ route('team.create') }}" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Add a team</h1>
                    <p>Fill out this form to add a team</p>

                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="name">Team Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                       placeholder="Enter team name" value="" route="{{route('team.store')}}" required>
                            </div>

                            <div id="userdiv" class="control-group col-12 mt-2">
                                <label for="player1">Players</label>
                                <p>Select the player to add to the team</p>
                                <select id="player1" name="player1" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value= "{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <button type="button" id="adduser" onclick="addPlayer();">
                                Add Another Player
                            </button>

                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button type="button" id="btn-submit" class="btn btn-primary" onclick="addTeam();">
                                    Add Team
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
<script>

    console.log('im crazy');
    let playerAmount = 1;

    function addPlayer(){
        playerAmount += 1;
        let userdiv = document.getElementById('userdiv');
        userdiv.innerHTML += '<select id="player' + playerAmount + '" name="player' + playerAmount + '" class="form-control" required> @foreach ($users as $user) <option value= "{{ $user->id }}">{{ $user->name }}</option> @endforeach </select>';
    }

    function addTeam(){
        let teamInput = document.getElementById('name');
        let teamName = teamInput.value;
        let playerArray = [];
        for(i=0;i<playerAmount;i++){
            let newPlayer = document.getElementById('player' + (i+1) + '').value;
            playerArray.push(newPlayer);
        }
        console.log(playerArray);

        axios({
            url: teamInput.getAttribute('route'),
            method: 'PUT',
            data: {
                name: teamName,
                users: playerArray
            }
        }).then(function(response){
            if (response.data.succes === true) {
                console.log('yay!');
                alert('Team succesfully added!');
            } else {
                console.log('whydoesthisrun');
            }
        }).catch(function(response){
            console.log(response.data.message);
        });
    }
</script>

@endsection