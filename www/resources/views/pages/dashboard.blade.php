@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="add_new_container">
        <form id="add_new_profile" action="/add_profile" method="post">
            @csrf
            <label for="name"><span>Name</span><input id="name" type="text" name="name"></label>
            <label for="alias_name"><span>Alias</span><input id="alias_name" type="text" name="alias_name"></label>
            <label for="comment"><span>Comment</span><input id="comment" type="text" name="comment"></label>
            <label for="days"><span>Days</span><input id="days" type="number" name="days"></label>
            <input type="submit" value="Create new profile">
        </form>
    </div>
    @if($profiles)
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Alias</td>
                    <td>Status</td>
                    <td>Days left</td>
                    <td>Comment</td>
                </tr>
            </thead>
            <tbody>
                @foreach($profiles as $profile)
                    <tr>
                        <td><a href="/profiles/{{$profile->name}}.conf" download>{{$profile->name}}</a></td>
                        <td>{{$profile->alias_name}}</td>
                        @if($profile->status == 1)
                            <td>Active ({{$profile->days}} days)</td>
                        @else
                            <td>Expired</td>
                        @endif
                        <td>{{$profile->days_left}}</td>
                        <td>{{$profile->comment}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif
@stop
