<?php 
    // Code for SMS script
    $request = "";
    $param['authorization'] ="0fghGt706rJ1C8fsddpUXSEPLWv2aDRuMkyeif7mKBwNHxd4vw0gKcTfrhemqdsFS8gb6Do59Nzp1Ry5fi";
    $param['sender_id'] = 'FSTSMS';
    $param['message'] = 'This is the test SMS from ICode e-commerce';
    $param['numbers'] = '9800000000';
    $param['language'] = 'english';
    $param['route'] = "p";
    
    foreach($param as $key=>$val){
        $request.= $key."=".urlencode($val);
        $request.="&";
    }
    $request = substr($request, 0 , strlen($request)-1);
    $url = "https://www.fast2sms.com/dev/bulk?".$request;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);
?>