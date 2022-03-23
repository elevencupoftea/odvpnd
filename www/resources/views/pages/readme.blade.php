@extends('layouts.app')
@section('title','Get Free VPN')
@section('content')
        <article>
            <div class="readme_block">
                <h2>User identification</h2>
                <p>We do not have user authorization. Therefore, for payment we use Dogecoin cryptocurrency (more choice of cryptocurrencies in the future). You just need to remember the Dogecoin address that is issued to you for payment.</p>
                <h2>Personal data protection</h2>
                <p>We provide two profiles - <a href="https://www.wireguard.com/install/">Wireguard</a> (Crypto essential Routing) and <a href="https://openvpn.net/download-open-vpn/">OpenVpn</a> (AES-128-CBC). These VPN implementations are open source and have long established themselves as a reliable way to secure Internet access. An additional plus will be Doh (DNS over HTTPS), DNSSEC (Domain Name System Security Extensions), partial ad blocking (except for js injection).</p>
                <h2>Specifications</h2>
                <ul>
                    <li>Speed Up to 100Mbps</li>
                    <li>P2P</li>
                    <li>DNSSEC</li>
                    <li>DoH</li>
                    <li>Unlimited traffic</li>
                    <li>Daily free profiles</li>
                </ul>
                <h2>If I have lost access to VPN profiles</h2>
                <p>If you lose your purchased VPN profiles (Clearing cookies, or losing access to the device from which the payment was made) Visit the <a href="/buy/check">Check</a> section where you need to enter the Dogecoin address that was issued for payment. You can find it in your wallet's transaction history. After successful entry, you will receive links to your VPN profiles.</p>
                <h2>Why Dogecoin?</h2>
                <p>We chose Dogecoin for its simplicity and affordability. Its low commission allows you to make small transactions at an incredible speed. And for enrollment, we do not need only 1 confirmation of the network. We love this cryptocurrency as much as <a href="https://twitter.com/elonmusk" target="_blank">Elon Musk</a>, <a href="https://twitter.com/dogecoinlegion" target="_blank">DogecoinLegion</a>, <a href="https://twitter.com/DogecoinRise" target="_blank">DogecoinRise</a></p>
                <h2>Where can I buy Dogecoin?</h2>
                <p>
                    <ul>
                        <li><a href="https://cli.co/gpoSdyN" target="_blank">Binance</a></li>
                        <li><a href="https://cli.co/mzvloA4" target="_blank">999dice (in chat rooms)</a></li>
                    </ul>
                </p>
            </div>
            <div class="info_block">Remember that you get anonymity and privacy of your personal data, but VPN tunnel does not give you the right to violate the laws of your country.</div>
        </article>
    <script>
        $(document).ready(()=>{
            $("#getvpn").on('click',()=>{
                $("body").prepend("<div class=wait_back_screen><p>Generating profiles... Wait please.<p></div>");
                backscreen = $(".wait_back_screen").fadeIn(500)
           });
        });
    </script>
@stop
