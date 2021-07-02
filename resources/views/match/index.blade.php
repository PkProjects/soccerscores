
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <form id="select-frm" class="" action="" method="POST">
                            @csrf
                                <select id="sortDate" class="form-control" name="sortDate" placeholder="Sort matches by:"
                                            rows="4" required>
                                    <option value="none" selected disabled hidden>Sort matches by:</option>
                                    <option value="1">Last week - Ascending</option>
                                    <option value="2">Last week - Descending</option>
                                    <option value="3">Last month - Ascending</option>
                                    <option value="4">Last month - Descending</option>
                                </select>
                            <div class="col-6">
                                <button type="submit" class="btn btn-info" id="sort-button">Sort Matches</button>
                            </div>
                        </form>

                        @forelse($matches as $match)
                            <ul>
                                @if($match->isteam1 == "true")
                                    <li><b>Team1 ID: {{ $match->team1->id}}</b></li>
                                @else
                                    <li><b>Player1 ID: {{ $match->team1->id}}</b></li>
                                @endif
                                <li><b>Team1 isteam: {{ $match->isteam1 }}</b></li>
                                @if($match->isteam2 == "true")
                                    <li><b>Team2 ID: {{ $match->team2_id }}</b></li>
                                @else
                                    <li><b>Player2 ID: {{ $match->team2_id }}</b></li>
                                @endif
                                <li><b>Team2 isteam: {{ $match->isteam2 }}</b></li>
                                <li><b>Team1 score: {{ $match->team1_score }}</b></li>
                                <li><b>Team2 score: {{ $match->team2_score }}</b></li>
                                <li><b>Created at: {{ $match->created_at }}</b></li>
                                <li><b>That was {{ now()->diffInDays($match->created_at) }} days ago </b></li>
                            </ul>
                        @empty
                            <p class="text-warning">No matches available</p>
                        @endforelse
                    </div>         
                </div>       
            </div>
        </div>
    </div>
@endsection