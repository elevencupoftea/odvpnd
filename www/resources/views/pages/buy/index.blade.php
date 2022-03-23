@extends('layouts.app')
@section('title','Buy')
@section('content')
<div class="full_cont">
    <div class='notify_container'>
        @isset($error)
            <div class="error">{{$error}}</div>
        @endisset
        @isset($message)
            <div class="message">{{$message}}</div>
        @endisset
{{--        @isset($free_profiles)--}}
{{--            <div class="free_profile flex vert flex-center">--}}
{{--                <span>Active profiles:</span>--}}
{{--                @foreach($free_profiles as $type => $free_profile)--}}
{{--                    @if($type === 'wg')--}}
{{--                        <a href="/profiles/{{$free_profile}}.conf" download>{{$free_profile}}</a>--}}
{{--                    @elseif($type === 'ovpn')--}}
{{--                        <a href="/profiles/{{$free_profile}}.ovpn" download>{{$free_profile}}</a>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endisset--}}
        <div class="info_block">
            <i class="fas fa-info"></i>
            <span>Free profiles will be deleted after successful payment </span>
        </div>
    </div>
    <div class="form_container">
        <form id="buy_form" action="/buy" method="post">
            @csrf
            <div class="radio_button_cont">
                <div class="radio_block">
                    <input class="st_radio" id="_01" type="radio" name="day_count" value="1" checked>
                    <label for="_01">1 day</label>
                    <div class="price_info">
                        <p class="price_per_day">{{$price['1']['price']}} Ð/Day</p>
                        <p class="price_overall">{{$price['1']['price']}} Ð</p>
                    </div>
                </div>
                <div class="radio_block">
                    <input class="st_radio" id="_10" type="radio" name="day_count" value="10">
                    <label for="_10">10 days</label>
                    <div class="price_info">
                        <p class="price_per_day">{{$price['10']['per_day']}} Ð/Day</p>
                        <p class="price_overall">{{$price['10']['price']}} Ð</p>
                    </div>
                </div>
                <div class="radio_block">
                    <input class="st_radio" id="_30" type="radio" name="day_count" value="30">
                    <label for="_30">30 days</label>
                    <div class="price_info">
                        <p class="price_per_day">{{$price['30']['per_day']}} Ð/Day</p>
                        <p class="price_overall">{{$price['30']['price']}} Ð</p>
                    </div>
                </div>
                <div class="radio_block">
                    <input class="st_radio" id="_365" type="radio" name="day_count" value="365">
                    <label for="_365">365 days</label>
                    <div class="price_info">
                        <p class="price_per_day">{{$price['365']['per_day']}} Ð/Day</p>
                        <p class="price_overall">{{$price['365']['price']}} Ð</p>
                    </div>
                </div>
            </div>
            <input type="submit" value="Buy VPN" name="get_button">
        </form>
    </div>
</div>
@stop
