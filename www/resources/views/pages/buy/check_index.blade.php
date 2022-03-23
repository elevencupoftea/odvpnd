@extends('layouts.app')
@section('title','Check Payment')
@section('content')
<div class="full_cont">
    <div class='notify_container'>
        @isset($error)
            <div class="error">{{$error}}</div>
        @endisset
        @isset($message)
            <div class="message">{{$message}}</div>
        @endisset
        <div class="info_block">
            <i class="fas fa-info"></i>
            <span>If you logged in from another device or browser and want to receive the profiles purchased earlier, enter the Dogecoin address to which you made the transfer.</span>
        </div>
    </div>
    <div class="payment_container">
        <form class="address_check form" action="/buy/check">
            <input name="address" type="text" placeholder="Dogecoin address">
            <input name="check_address" type="submit" value="Check address">
        </form>
    </div>
</div>
@stop
