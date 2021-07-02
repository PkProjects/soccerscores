@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{ route('team.create') }}" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Add a match result</h1>
                    <p>Fill out this form to add a match</p>
                    <p>Please make sure to use valid numbers!</p>

                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">

                            <div id="team1div" class="control-group col-12 mt-2">
                                <label for="team1">Players</label>
                                <p>Select the player to add to the team</p>
                                <select id="team1" name="team1" class="form-control" required>
                                @foreach ($teams as $team)
                                    <option isteam="true" value="{{ $team->id }}">Team : {{ $team->name }}</option>
                                @endforeach
                                @foreach ($users as $user)
                                    <option isteam="false" value="{{ $user->id }}">Solo : {{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="control-group col-12">
                                <label for="t1score">Team 1 score</label>
                                <input type="number" id="t1score" class="form-control" name="t1score"
                                       placeholder="Enter team 1 score" value="" route="{{route('match.store')}}" required>
                            </div>

                            <div id="team2div" class="control-group col-12 mt-2">
                                <label for="team2">Players</label>
                                <p>Select the player to add to the team</p>
                                <select id="team2" name="team2" class="form-control" required>
                                @foreach ($teams as $team)
                                    <option isteam="true" value="{{ $team->id }}">Team : {{ $team->name }}</option>
                                @endforeach
                                @foreach ($users as $user)
                                    <option isteam="false" value="{{ $user->id }}">Solo : {{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="control-group col-12">
                                <label for="t2score">Team 2 score</label>
                                <input type="number" id="t2score" class="form-control" name="t2score"
                                       placeholder="Enter team 2 score" value="" route="{{route('team.store')}}" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button type="button" id="btn-submit" class="btn btn-primary" onclick="addMatch();">
                                    Add Match
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
<script>

    function addMatch(){
        let isTeam1 = document.getElementById('team1');
        isTeam1 = isTeam1.options[isTeam1.selectedIndex].getAttribute('isteam');
        let isTeam2 = document.getElementById('team2');
        isTeam2 = isTeam2.options[isTeam2.selectedIndex].getAttribute('isteam');
        let team1 = document.getElementById('team1').value;
        let team2 = document.getElementById('team2').value;
        let team1score = document.getElementById('t1score').value;
        let team2score = document.getElementById('t2score').value;

        axios({
            url: document.getElementById('t1score').getAttribute('route'),
            method: 'PUT',
            data: {
                team1: team1,
                team2: team2,
                isteam1: isTeam1,
                isteam2: isTeam2,
                team1score: team1score,
                team2score: team2score
            }
        }).then(function(response){
            if (response.data.succes === true) {
                console.log('yay!');
                alert('Match succesfully added!');
            } else {
                alert(response.data.error);
            }
        }).catch(function(response){
            console.log("This is not okay");
        });
    }
</script>

@endsection