@extends('layouts.app')
@section('content')
@section('title','Buy')
<div class="full_cont">
    <div class='notify_container'>
        @isset($error)
            <div class="error">{{$error}}</div>
        @endisset
        @isset($message)
            <div class="message">{{$message}}</div>
        @endisset
        @isset($free_profile)
            <div class="free_profile flex vert flex-center">
                <span class="label_7">Free profile:</span>
                <a href="/profiles/{{$free_profile['name']}}.ovpn" download>{{$free_profile['name']}}</a>
                <span class="label_7">Expired: {{$free_profile['expired']}} (GMT)</span>
            </div>
        @endisset
    </div>
    <div class="payment_container">
        <h3></h3>
        {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::generate('34fdgdf78hyugu5hkkJGkuhutgklkbvc') }}
        <span class="label_7">D423RKFEEdewk24rO#$GFDFsdfdds</span>
    </div>
</div>
@stop
