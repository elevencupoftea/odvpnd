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
    </div>
    <div class="payment_container">
        @if($payment['status'] === 1)
            @if($payment['expired'] === 1)
                <h3>{{$payment['address']}}</h3>
                <div class="payment_status expired"><i class="fas fa-times"></i></div>
                <span>The profiles have expired</span>
            @else
                <h3>{{$payment['address']}}</h3>
                <div class="payment_status accept"><i class="fas fa-check"></i></div>
{{--                <a href="/profiles/{{$payment['wg']}}.conf" download>Download WireGuard config</a>--}}
{{--                <a href="https://openvpn.net/download-open-vpn/" class="download - wg">Get WireGuard<i class="fal fa-fw fa-external-link-square"></i></a>--}}
{{--                <a href="/profiles/{{$payment['ovpn']}}.conf" download>Download OpenVPN profile</a>--}}
{{--                <a href="https://openvpn.net/download-open-vpn/" class="download ovpn">Get OpenVPN<i class="fal fa-fw fa-external-link-square"></i></a>--}}
                <div class="link_container">
                            <a href="/profiles/{{$payment['wg']}}.conf" class="download - wg" download>Download WireGuard config</a>
                            <a href="https://www.wireguard.com/install/" target="_blank">Get WireGuard<i class="fal fa-fw fa-external-link-square"></i></a>
                            <a href="/profiles/{{$payment['ovpn']}}.ovpn" class="download ovpn" download>Download OpenVPN profile</a>
                            <a href="https://openvpn.net/download-open-vpn/" target="_blank">Get OpenVPN<i class="fal fa-fw fa-external-link-square"></i></a>
                    <span class="expired label_8">Expired: {{$payment['expired']}} (UTC)</span>
                </div>
            @endif
        @elseif($payment['status'] === 0)
            <div class="info_block">
                <i class="fas fa-info"></i>
                <span>Processing takes approximately 5 minutes. If the status has not changed after successful payment, try refreshing the page. If you have lost your profiles, or want to activate them on another device, save the address. Also remember that each profile can work on one device at the same time. (You can use OpenVPN on one device and Wireguard on another).</span>
            </div>
            {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::generate($payment['address']) }}
            <h3>{{$payment['address']}}</h3>
            <div class="payment_status pending"><i class="fas fa-ellipsis-h"></i></div>
            @if($payment['days'] === 1)
                <span><b>{{$payment['price']}} Ð</b> for <b>{{$payment['days']}} day</b></span>
            @else
                <span><b>{{$payment['price']}} Ð</b> for <b>{{$payment['days']}} days</b></span>
            @endif
        @else
            <h3>{{$payment['address']}}</h3>
            <div class="payment_status expired"><i class="fas fa-times"></i></div>
            <span>Wrong address</span>
        @endif
            <form class="address_check form" action="/buy/check">
                <input name="address" type="text">
                <input type="submit" value="Check another address">

            </form>
    </div>
</div>
<script>
    function updateStatus(){
        let address = $(".payment_container h3").text();
        console.log('1')
        $.ajax({
            type: "GET",
            url: "/buy/check",
            data: {
                'address': address,
                'check':1
            },
            success: (result)=> {
                // alert(result)
                // alert('/buy/check/'+address)
                if(result === "1"){
                        window.location.href = '/buy/check/' + address
                        console.log('1')
                }
            }
        });
    }
    $(document).ready(()=>{
        if($('.pending')[0]) {
            setInterval(() => {
                    updateStatus()
                }
                , 5000);
        }
    });
</script>
@stop
