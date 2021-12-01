@extends('parts.template')
@section('content')
    <div class="row border-2 p-3 mb-7" style="margin-top:10px;">
        <div class="col-md-12 text-center">
            <h3 class="font-bold">Median number of viewers for all streams</h3>
            <livewire:avarage-views />
        </div>
        <div class="col-md-6 mt-5">
            <h3 class="font-bold">Top games by viewer count for each game</h3>
            <livewire:top-games />
        </div>
        <div class="col-md-6 mt-5">
            <h3 class="font-bold">Total number of streams for each game</h3>
            <livewire:total-streams />
        </div>  
    </div>
    <div class="row border-2 p-3 mb-7" style="margin-top:10px;">
        <div class="col-md-6">
            <h3 class="font-bold">Total number of streams by their start time (rounded to the nearest hour)</h3>
            <livewire:start-hour />
        </div>
        <div class="col-md-6">
            <h3 class="font-bold">List of top 100 streams by viewer count that can be sorted asc & desc</h3>
            <livewire:top100 />
        </div>
    </div>
    <div class="row border-2 p-3 mb-7" style="margin-top:10px;">
        <div class="col-md-6">
            <h3 class="font-bold">Which of the top 1000 streams is the logged in user following</h3>
            <livewire:top-streamers-followed />
        </div>
        <div class="col-md-6">
            <h3 class="font-bold">How many viewers does the lowest viewer count stream that the logged in user is following need to gain in order to make it into the top 1000?</h3>
            <livewire:all-the-way-up />
        </div>
    </div>
    <div class="row border-2 p-3 mb-7" style="margin-top:10px;">
        <div class="col-md-12">
            <h3 class="font-bold">Which tags are shared between the user followed streams and the top 1000 streams</h3>
            <livewire:tags />
        </div>
    </div>
@endsection