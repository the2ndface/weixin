<?php
    // define('APP_ID','wxc02e3af3e6928c22');
    // define('APP_SECRET','581336bc68ab295dcff512a356f47b9d');

    // $_ch = curl_init();
    // $_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APP_ID.'&secret='.APP_SECRET;

    // curl_setopt($_ch, CURLOPT_URL,$_url);
    // curl_setopt($_ch, CURLOPT_RETURNTRANSFER,1);
    // curl_setopt($_ch, CURLOPT_HEADER,0);
    // curl_setopt($_ch, CURLOPT_TIMEOUT,10);

    // $_output = curl_exec($_ch);
    // curl_close($_ch);

    // var_dump($_output);

    define("TOKEN","wsxnm");

    function checkSignature()
    {
        //从GET参数中读取三个字段的值
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        //读取预定义的TOKEN
        $token = TOKEN;
        //对数组进行排序
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        //对三个字段进行sha1运算
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        //判断我方计算的结果是否和微信端计算的结果相符
        //这样利用只有微信端和我方了解的token作对比,验证访问是否来自微信官方.
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    if(checkSignature()){
        echo $_GET["echostr"];
    }
    else{
        echo 'error';
    }

?>