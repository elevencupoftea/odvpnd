@extends('layouts.app')
@section('title','Get Free VPN or buy for Dogecoins')
@section('content')
<?php
//$b = file_get_contents('https://api.binance.com/api/v1/ticker/24hr');
//$bt = json_decode($b, true);
//$pair_array = [];
//$symbol = 'ETH';
//
//for($i=0; $i<count($bt); $i++) { // перебор всех значений
//    $pairName = (string)$bt[$i]['symbol'];
//    $lastPrice = (float)$bt[$i]['lastPrice'];
//    if ($bt[$i]['symbol'] == $symbol . "USDT"
//        || $bt[$i]['symbol'] == $symbol . "BTC"
//        || $bt[$i]['symbol'] == "BTCUSDT"
//    ) {
//        $pair_array[$pairName] = $lastPrice;
////        echo $pairName;
//    }
//}
//        $usd = 100;
//        print_r($pair_array);
//
//$eth_price_usd = $pair_array[$symbol."USDT"];
//$eth_price_btc = $pair_array[$symbol."BTC"];
//$btc_price_usd = $pair_array["BTCUSDT"];
//
//echo "<br>symbol: ".$symbol."<br>";
//echo $symbol."USDT: ".$usd/$eth_price_usd."<br>";
//echo $symbol."BTC --> BTCUSDT: ". ($usd/$btc_price_usd)/$eth_price_btc ."<br>";
?>
<div id="connect_status" style="color:green"></div><br>
<div id="data"></div>
<script>
    let streams = "";
    let pairs = {
        'xrpusdt': {
            'plan':0.55,
            'order':'s'},
        'dotusdt': {
            'plan':0,
            'order':'-'},
        'dogeusdt': {
            'plan':0,
            'order':'-'},
        'btcusdt': {
            'plan':0.0,
            'order':'-'},
        'ethusdt': {
            'plan':0.0,
            'order':'-'},
        'ethbtc': {
            'plan':0.0,
            'order':'-'},
    };

    // pairs.forEach((pair)=>{
    for(const [pair,data] of Object.entries(pairs)) {
        streams += pair + "@ticker/";
        link = "https://www.binance.com/en/trade/"+pair.toUpperCase()+"?layout=lite"
        $("#data").append("<div id='" + pair + "' class='data_block'></div>")
        $("#" + pair).append("<div id='order_type'>"+data['order']+"</div>")
        $("#" + pair).append("<h2 id='pair_name'><a href="+link+" target='_blank'>" + pair.toUpperCase() + "</a></h2>")
        $("#" + pair).append("<div id='price_indicator'></div>")
        $("#" + pair).append("<div id='price_block'></div>")
        $("#" + pair + " > #price_block").append("<span id='price_ask' class='neg'>0.00000000</span>")
        $("#" + pair + " > #price_block").append("<span id='price_bid' class='pos'>0.00000000</span>")
        $("#" + pair).append("<span id='plan'>"+data['plan'].toFixed(8)+"</span>")
        $("#" + pair).append("<span id='diff'></span>")
    }
    // })

    streams = streams.slice(0,-1)
    console.log(streams);


    // var  socket = new WebSocket("wss://dex.binance.org/api/ws/$all@allTickers");
    // var  socket = new WebSocket("wss://stream.binance.com:9443/ws/dogebtc@trade");
    var  socket = new WebSocket("wss://stream.binance.com:9443/stream?streams="+streams);
    var old_price = [];
    socket.onopen = function() {
        // alert("Соединение установлено.");
        $("#connect_status").text("ON");


    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            $("#connect_status").text('Соединение закрыто чисто');
        } else {
            $("#connect_status").text("Обрыв соединения");
        }
        $("#connect_status").text('Код: ' + event.code + ' причина: ' + event.data);
    };

    socket.onmessage = function(event) {
        let json = JSON.parse(event.data);
        let data = json.data;
        let pair_name = data.s.toLowerCase();

        let price_ask = data.a
        let price_bid = data.b

        // console.log(old_price[pair_name])
        // if(old_price[pair_name] == 'undefined'){
        //     old_price[pair_name] = price_ask
        // }
        //
        // if (price_ask > old_price[pair_name]) {
        //     $("#" + pair_name + " > #price_indicator").addClass('pos_bg')
        //     $("#" + pair_name + " > #price_indicator").removeClass('neg_bg')
        // } else {
        //     $("#" + pair_name + " > #price_indicator").addClass('neg_bg')
        //     $("#" + pair_name + " > #price_indicator").removeClass('pos_bg')
        // }
        // if(old_price[pair_name] !== price_ask) {
        //     old_price[pair_name] = $("#" + pair_name + " #price_ask").text();
        //     console.log(old_price[pair_name])
        // }
        //

        $("#"+pair_name+"  #price_ask").text(price_ask)
        $("#"+pair_name+"  #price_bid").text(price_bid)
        plan = $("#"+pair_name+" > #plan").text();
        if(plan != 0) {
            if ($("#"+pair_name+" > #order_type").text() === 's') {
                diff = (plan - price_bid).toFixed(8);
                diff_p = ((diff / (price_bid / 100)) - 0.15).toFixed(2)
                $("#" + pair_name + " > #diff").text(diff + "  (" + diff_p + "%)")
            }
            else{
                diff = (price_bid-plan).toFixed(8);
                diff_p = ((diff / (price_bid / 100)) - 0.15).toFixed(2)
                $("#" + pair_name + " > #diff").text(diff + "  (" + diff_p + "%)")
            }
        }
        else{
            $("#"+pair_name+" > #plan").css('color','transparent')
            $("#"+pair_name).css('opacity','0.5')
        }

    };

    socket.onerror = function(error) {
        console.log("Ошибка " + error.message);
    };
</script>
@stop
