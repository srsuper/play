<?php
date_default_timezone_set('Asia/Bangkok');
  include('./httpful.phar');
$access_token =
'XuAPgE5eH13Hbgj7mSSCmqe5wheTgVDhiE805ypPKx1hyHXCXLgshl02rpLCe+rUUVTfBE6SkoXrkRD0c1omm6o8RFZMgCETtwF7nDTKSg3PDQG6OIHE2npC1e3YfWXhvBMcXBwFrF5zE8s9T83cgQdB04t89/1O/w1cDnyilFU=';

$sidname='709c1a7e5a83bd434de8f';
$vturl='http://redfoxdev.com/vtiger/';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
      $userID = $event['source']['userId'];
      $groupID = $event['source']['groupId'];
			// Get replyToken
      $resultlist = '';
			$replyToken = $event['replyToken'];

			// Build message to reply back
      // $thirdtext = substr($text, 0, 3);
      // $thirdtext = substr($text, 0, 3);
      $context = substr($text, 0, 2);
      $ttrdtext = substr($text, 0, 3);
      $fivetext = substr($text, 0, 5);
			$ftext = substr($text, 0, 1);
      $sectext = strtoupper(substr($text, 0, 2));
      $alltext= strtoupper(strstr($text, '-', true));
      $newtext = substr($alltext, 1);

      // $lentext = strlen($newtext);
      //
      //   $n1 = 'P'.substr($newtext,0,1);
      //   $n2 = 'P'.substr($newtext,1,1);
      //   $n3 = 'P'.substr($newtext,2,1);
      //   $n4 = 'P'.substr($newtext,3,1);
      //   $txc='';
      //
      //
      //   $nn1 = substr($newtext,0,1);
      //   $nn2 = substr($newtext,1,1);
      //   $nn3 = substr($newtext,2,1);
      //   $nn4 = substr($newtext,3,1);


        //gamestatus
        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
        $response = \Httpful\Request::get($uri)->send();
        // echo $response;
        $gameStatus = $response->body->result[0]->bgame_tks_gamestatus;

      if(strtoupper($ftext) == "T"){

        $nn1 = substr($newtext,0,1);
        $nn2 = substr($newtext,1,1);
        $nn3 = substr($newtext,2,1);
        $money  = substr($text, (strpos($text, '-') ?: -1) + 1);

        $nx = 0;

        if(is_numeric($newtext) || is_numeric($money)){
          $nx = 0;
        } else {
          $nx = 1;
        }

        if($nn1 > 6 || $nn2 > 6 || $nn3 > 6){
            $nx = 1;
        }

        if($nn1 <= 0 || $nn2 <= 0 || $nn3 <= 0){
            $nx = 1;
        }


        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Nmember%20where%20nmember_tks_userid='".$userID."';";
        $response = \Httpful\Request::get($uri)->send();

        $mbalance = $response->body->result[0]->nmember_tks_balance;
        $betx = $money *3;
        $nt = 1;

        if($mbalance<$betx){
            $nt = 2;
        }

                    $dname= '';
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://api.line.me/v2/bot/group/".$groupID."/member/".$userID,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "GET",
                      CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer XuAPgE5eH13Hbgj7mSSCmqe5wheTgVDhiE805ypPKx1hyHXCXLgshl02rpLCe+rUUVTfBE6SkoXrkRD0c1omm6o8RFZMgCETtwF7nDTKSg3PDQG6OIHE2npC1e3YfWXhvBMcXBwFrF5zE8s9T83cgQdB04t89/1O/w1cDnyilFU=",
                        "cache-control: no-cache",
                        "postman-token: 6dc09c6b-dd83-81ca-75ed-71ce43b5edd7"
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      echo "cURL Error #:" . $err;
                    } else {
                    //   echo $response;
                    //
                    $data = json_decode($response,true);
                    $dname =  $data['displayName'];
                    }


              if($nx != 1 && $nt != 2 && strlen($newtext)==3 && $money > 0){


                $c1="";
                $c2="";
                $c3="";


                  if($nn1 == "1"){
                    $c1="น้ำเต้า 💧";
                  }else if($nn1 == "2"){
                    $c1="ปู 🦀";
                  }else if($nn1 == "3"){
                    $c1="ปลา 🐠";
                  }else if($nn1 == "4"){
                    $c1="กุ้ง 🦐";
                  }else if($nn1 == "5"){
                    $c1="เสือ 🐯";
                  }else if($nn1 == "6"){
                    $c1="ไก่ 🐔";
                  }

                  if($nn2 == "1"){
                    $c2="น้ำเต้า 💧";
                  }else if($nn2 == "2"){
                    $c2="ปู 🦀";
                  }else if($nn2 == "3"){
                    $c2="ปลา 🐠";
                  }else if($nn2 == "4"){
                    $c2="กุ้ง 🦐";
                  }else if($nn2 == "5"){
                    $c2="เสือ 🐯";
                  }else if($nn2 == "6"){
                    $c2="ไก 🐔่";
                  }


                  if($nn3 == "1"){
                    $c3="น้ำเต้า 💧";
                  }else if($nn3 == "2"){
                    $c3="ปู 🦀";
                  }else if($nn3 == "3"){
                    $c3="ปลา 🐠";
                  }else if($nn3 == "4"){
                    $c3="กุ้ง 🦐";
                  }else if($nn3 == "5"){
                    $c3="เสือ 🐯";
                  }else if($nn3 == "6"){
                    $c3="ไก่ 🐔";
                  }

                    $messages = [
                      'type' => 'text',
                      'text' => $dname.' ผู้เล่นแทงพนัน '.$c1.'   '.$c2.'   '.$c3.'   จำนวน '.$money
                    ];
              }
              else if ($nt == 2) {
                    $messages = [
                      'type' => 'text',
                      'text' => $dname.' ยอดเงินไม่พอสำหรับการแทง ยอดคงเหลือคือ '.$mbalance
                    ];
              }
              else{
                    $messages = [
                      'type' => 'text',
                      'text' => $dname.' รูปแบบการแทงไม่ถูกต้อง'
                    ];
              }
      }

      else if(strtoupper($ftext) == "S"){

        //find admin
        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
        $response = \Httpful\Request::get($uri)->send();

        $adminID = $response->body->result[0]->bgame_tks_adminid;
        $xround = $response->body->result[0]->bgame_tks_round;
        $extext = explode(",", $text);
          if(strcmp($adminID,$userID) == 0){



        // echo $extext[0]; // piece1
        // echo $extext[1]; // piece2
        // echo $extext[2]; // piece2
        // echo $extext[3]; // piece2
        $xround = $xround-1;


        $listname= 'สรุปผล : รอบที่ # '.$xround;
        $resultlist= 'สรุปผล : รอบที่ # '.$xround;

        $x1 = substr($extext[0], 2);

        if ($x1=="-1"){
           $msg1 = 'ขา 1 เสียให้เจ้ามือ 1 เท่า';

           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P1%'%20;";
           $response = \Httpful\Request::get($uri)->send();



// **************

              $data = json_decode($response,true);
              $total = 0;
              foreach ($data["result"] as $value) {
                      $total = $total+1;
              }

              foreach($data["result"] as $item) { //foreach element in $arr

                   $username = $item['bmember_tks_username'];
                   $userID = $item['bmember_tks_userid'];
                   $vid = $item['id'];
                   $balance = $item['bmember_tks_balance'];
                   $bet = $item['bmember_tks_bet'];
                   $player = $item['bmember_tks_player'];
                   $expend = $item['bmember_tks_expend']+$bet;
                   $income = $item['bmember_tks_income'];
                   $playerbet = $item['bmember_tks_playerbet'];
                   $newbalance = $balance;

                $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                    \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                    \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                    \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                    "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                  echo $response;
                }


                }

//

        } else if  ($x1=="+1"){
           $msg1 = 'ขา 1 ได้ 1 เท่า';
                      $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P1%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+$bet;
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }




             }

        }else if  ($x1=="+0"){
           $msg1 = 'เจ๊า';

                 $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P1%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }




             }

        }else if  ($x1=="-2"){
           $msg1 = 'ขา 1 ได้ 2 เท่า';

                      $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P1%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $betx = ($bet+$bet);
                $expend = $item['bmember_tks_expend']+$betx;
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }




             }
        }else if  ($x1=="+2"){
           $msg1 = 'ขา 1 ได้ 2 เท่า';

                      $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P1%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+($bet*2);
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }



             }
        }
        $x2 = substr($extext[1], 1);
        if ($x2=="-1"){
                     $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P2%'%20;";
          $response = \Httpful\Request::get($uri)->send();

          $data = json_decode($response,true);
          $total = 0;
          foreach ($data["result"] as $value) {
                  $total = $total+1;
          }

          foreach($data["result"] as $item) { //foreach element in $arr

               $username = $item['bmember_tks_username'];
               $userID = $item['bmember_tks_userid'];
               $vid = $item['id'];
               $balance = $item['bmember_tks_balance'];
               $bet = $item['bmember_tks_bet'];
               $player = $item['bmember_tks_player'];
               $expend = $item['bmember_tks_expend']+$bet;
               $income = $item['bmember_tks_income'];
               $playerbet = $item['bmember_tks_playerbet'];
               $newbalance = $balance;

            $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            }




            }

        } else if  ($x2=="+1"){

           $msg2 = 'ขา 2 ได้ 1 เท่า';

           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P2%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+$bet;
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }


             }


        }else if  ($x2=="+0"){
           $msg2 = 'เจ๊า';
           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P2%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;
             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }





             }

        }else if  ($x2=="-2"){
           $msg2 = 'ขา 2 เสียให้เจ้ามือ 2 เท่า';
          $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P2%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend']+($bet*2);
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;
             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }



             }

        }else if  ($x2=="+2"){
           $msg2 = 'ขา 2 ได้ 2 เท่า';
           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P2%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+($bet*2);
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }




             }
        }

        $x3 = substr($extext[2], 1);
        if ($x3=="-1"){
           $msg3 = 'ขา3 เสียให้เจ้ามือ 1 เท่า';

           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P3%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend']+$bet;
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }



             }

        } else if  ($x3=="+1"){
           $msg3 = 'ขา 3 ได้ 1 เท่า';
            $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P3%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+$bet;
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }



             }
        }else if  ($x3=="+0"){
           $msg3 = 'เจ๊า';
            $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P3%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }

             }
        }else if  ($x3=="-2"){
           $msg3 = 'ขา 3 เสียให้เจ้ามือ 2 เท่า';
            $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P3%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend']+($bet*2);
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;

             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }


             }
        }else if  ($x3=="+2"){
           $msg3 = 'ขา 3 ได้ 2 เท่า';
         $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P3%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+($bet*2);
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }

             }
        }

        $x4 = substr($extext[3], 1);
        if ($x4=="-1"){
           $msg4 = 'ขา 4 เสียให้เจ้ามือ 1 เท่า';

                       $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P4%'%20;";
                      $response = \Httpful\Request::get($uri)->send();

                      $data = json_decode($response,true);
                      $total = 0;
                      foreach ($data["result"] as $value) {
                              $total = $total+1;
                      }

                      foreach($data["result"] as $item) { //foreach element in $arr

                           $username = $item['bmember_tks_username'];
                           $userID = $item['bmember_tks_userid'];
                           $vid = $item['id'];
                           $balance = $item['bmember_tks_balance'];
                           $bet = $item['bmember_tks_bet'];
                           $player = $item['bmember_tks_player'];
                           $expend = $item['bmember_tks_expend']+$bet;
                           $income = $item['bmember_tks_income'];
                           $playerbet = $item['bmember_tks_playerbet'];
                           $newbalance = $balance;

                        $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                            \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                            \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                            \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                          CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                            "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
                          ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                          echo "cURL Error #:" . $err;
                        } else {
                          echo $response;
                        }



                        }
        } else if  ($x4=="+1"){
           $msg4 = 'ขา 4 ได้ 1 เท่า';
           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P4%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+$bet;
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;

             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }

             }
        }else if  ($x4=="+0"){
           $msg4 = 'เจ๊า';
           $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P4%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n\n".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;


             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }

             }
        }else if  ($x4=="-2"){
           $msg4 = 'ขา 4 เสียให้เจ้ามือ 2 เท่า';
            $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P4%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend']+($bet*2);
                $income = $item['bmember_tks_income'];
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;



             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }


             }
        }else if  ($x4=="+2"){
           $msg4 = 'ขา 4 ได้ 2 เท่า';
             $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20%20Bmember%20where%20bmember_tks_playerbet%20LIKE%20'%P4%'%20;";
           $response = \Httpful\Request::get($uri)->send();

           $data = json_decode($response,true);
           $total = 0;
           foreach ($data["result"] as $value) {
                   $total = $total+1;
           }

           foreach($data["result"] as $item) { //foreach element in $arr

                $username = $item['bmember_tks_username'];
                $userID = $item['bmember_tks_userid'];
                $vid = $item['id'];
                $balance = $item['bmember_tks_balance'];
                $bet = $item['bmember_tks_bet'];
                $player = $item['bmember_tks_player'];
                $expend = $item['bmember_tks_expend'];
                $income = $item['bmember_tks_income']+($bet*2);
                $playerbet = $item['bmember_tks_playerbet'];
                $newbalance = $balance;

             $listname = $listname."\n ".$username."  -".$bet." = ".$newbalance.'  Loop +:'.$i.'total'.$total;

             $curl = curl_init();

             curl_setopt_array($curl, array(
               CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                 \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"$bet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
                 \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                 \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
               CURLOPT_HTTPHEADER => array(
                 "cache-control: no-cache",
                 "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                 "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);

             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }
             }
        }

        /// สิ้นสุด x4
        $messages = [
          'type' => 'text',
          'text' =>  'ยืนยันการสรุปผลหรือไม่ ?'
        ];

      }else {

      }

    }

      //แก้ไขผล
    else if(strtoupper($fivetext) == "CLEAR"){

      $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
      $response = \Httpful\Request::get($uri)->send();

      $adminID = $response->body->result[0]->bgame_tks_adminid;
        if(strcmp($adminID,$userID) == 0){

      $urix = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bmember%20Where%20bmember_tks_status='1';";
      $responsex = \Httpful\Request::get($urix)->send();

      $datax = json_decode($responsex,true);

      foreach($datax["result"] as $itemx) {
          $username = '001';
          $userID = $itemx['bmember_tks_userid'];
          $vid = $itemx['id'];
          $balance = $itemx['bmember_tks_balance'];
          $moneybet = $itemx['bmember_tks_bet'];
          $xmoneyx = $itemx['bmember_tks_player'];
          $expend = 0;
          $income = 0;
          $playerbet = $itemx['bmember_tks_playerbet'];


          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
              \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$balance\",\n            \"bmember_tks_bet\": \"$moneybet\",\n            \"bmember_tks_username\": \"$username\",\n            \"bmember_tks_player\": \"0\",\n            \"bmember_tks_playerbet\": \"$playerbet\",\n            \"bmember_tks_expend\": \"$expend\",\n            \"bmember_tks_income\": \"$income\",\n
              \"bmember_tks_status\": \"1\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
              \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
              "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            $messages = [
              'type' => 'text',
              'text' =>  'เคลียร์ผลสรุปแล้ว สรุปผลใหม่อีกครั้ง'
            ];
          }


        }

        }

    }
    //สิ้นสุดแก้ไขผล



			else if($ftext == "@"){

        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
        $response = \Httpful\Request::get($uri)->send();
        $xround = $response->body->result[0]->bgame_tks_round-1;


        $listname= 'สรุปผล : รอบที่ # '.$xround;
        $resultlist= 'สรุปผล : รอบที่ # '.$xround;


        $myid = substr($text,1);
        $teststr = substr($myid,0,2);

        if(strcmp($teststr,"id") == 0){

          $dname= '';
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.line.me/v2/bot/group/".$groupID."/member/".$userID,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "authorization: Bearer XuAPgE5eH13Hbgj7mSSCmqe5wheTgVDhiE805ypPKx1hyHXCXLgshl02rpLCe+rUUVTfBE6SkoXrkRD0c1omm6o8RFZMgCETtwF7nDTKSg3PDQG6OIHE2npC1e3YfWXhvBMcXBwFrF5zE8s9T83cgQdB04t89/1O/w1cDnyilFU=",
              "cache-control: no-cache",
              "postman-token: 6dc09c6b-dd83-81ca-75ed-71ce43b5edd7"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {

          $data = json_decode($response,true);
          $dname =  $data['displayName'];
          }


          $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bmember%20where%20bmember_tks_userid='".$userID."';";
          $response = \Httpful\Request::get($uri)->send();
          // echo $response;
          $username = $response->body->result[0]->bmember_tks_username;
          $vid = $response->body->result[0]->id;
          $balance = $response->body->result[0]->bmember_tks_balance;

          $userlen = strlen($vid);
          if($vid > 2) {


                      $messages = [
                        'type' => 'text',
                        'text' =>  $dname.' ID คือ '.$vid.' ยอดเงินคงเหลือ '.$balance
                      ];
          } else {

                      $messages = [
                        'type' => 'text',
                        'text' =>  'คุณไม่ได้เป็นสมาชิกโปรดสมัครด้วย คำสั่ง " Play "'
                      ];
          }


        } else if (strcmp($teststr,"okk") == 0){


          $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
          $response = \Httpful\Request::get($uri)->send();

          $adminID = $response->body->result[0]->bgame_tks_adminid;


            if(strcmp($adminID,$userID) == 0){

              $urix = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bmember%20Where%20bmember_tks_status='1';";
              $responsex = \Httpful\Request::get($urix)->send();

              $datax = json_decode($responsex,true);

              foreach($datax["result"] as $itemx) {
                  $username = '';
                  $userID = $itemx['bmember_tks_userid'];

                  $dname= '';
                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.line.me/v2/bot/group/".$groupID."/member/".$userID,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                      "authorization: Bearer XuAPgE5eH13Hbgj7mSSCmqe5wheTgVDhiE805ypPKx1hyHXCXLgshl02rpLCe+rUUVTfBE6SkoXrkRD0c1omm6o8RFZMgCETtwF7nDTKSg3PDQG6OIHE2npC1e3YfWXhvBMcXBwFrF5zE8s9T83cgQdB04t89/1O/w1cDnyilFU=",
                      "cache-control: no-cache",
                      "postman-token: 6dc09c6b-dd83-81ca-75ed-71ce43b5edd7"
                    ),
                  ));

                  $response = curl_exec($curl);
                  $err = curl_error($curl);

                  curl_close($curl);

                  if ($err) {
                    echo "cURL Error #:" . $err;
                  } else {

                  $data = json_decode($response,true);
                  $username =  $data['displayName'];
                  }

                  $vid = $itemx['id'];
                  $balance = $itemx['bmember_tks_balance'];
                  $bet = $itemx['bmember_tks_bet'];
                  $xmoneyx = $itemx['bmember_tks_player'];
                  $expend = $itemx['bmember_tks_expend'];
                  $income = $itemx['bmember_tks_income'];
                  $sum = $income - $expend;
                  $playerbet = $itemx['bmember_tks_playerbet'];
                  // เริ่ม

                  $urit = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
                  $responset = \Httpful\Request::get($urit)->send();

                //รายรับจ้าวมือ
                  $allincome = $responset->body->result[0]->bgame_tks_allincome;
                  $adminID = $responset->body->result[0]->bgame_tks_adminid;
                  $xxround = $responset->body->result[0]->bgame_tks_round;

                //รายจ่ายจ้าวมือ
                  $allexpend = $responset->body->result[0]->bgame_tks_allexpend;
                    //รายรับจ้าวมือ = รายจ่ายของผู้เล่น
                  $newincome = $allincome+$expend;
                  //รายรับจ้าวมือ = รายรับของผู้เล่น
                  $newexpend = $allexpend+$income;






                  $curl = curl_init();

                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bgameno\": \"\",\n            \"bgame_tks_adminid\": \"$adminID\",\n            \"bgame_tks_gamestatus\": \"0\",\n            \"bgame_tks_round\": \"$xxround\",\n
                      \"bgame_tks_allincome\": \"$newincome\",\n            \"bgame_tks_allexpend\": \"$newexpend\",\n
                      \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 06:06:23\",\n            \"modifiedtime\": \"2018-02-02 06:06:23\",\n            \"id\": \"37x3\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                    CURLOPT_HTTPHEADER => array(
                      "cache-control: no-cache",
                      "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                      "postman-token: ae7060b7-5521-c599-c9e6-e7e630892a76"
                    ),
                  ));

                  $response = curl_exec($curl);
                  $err = curl_error($curl);

                  curl_close($curl);

                  if ($err) {
                    echo "cURL Error #:" . $err;
                  } else {

                    if($income == 0 && $expend >=1){
                        $sum = substr($sum,1);
                      $newbalance = $balance - $sum;
                       $resultlist = $resultlist."\n".$username." -".$sum."=".$newbalance."";



                                               $curl = curl_init();

                                               curl_setopt_array($curl, array(
                                                 CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                                                 CURLOPT_RETURNTRANSFER => true,
                                                 CURLOPT_ENCODING => "",
                                                 CURLOPT_MAXREDIRS => 10,
                                                 CURLOPT_TIMEOUT => 30,
                                                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                 CURLOPT_CUSTOMREQUEST => "POST",
                                                 CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                                                   \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"\",\n            \"bmember_tks_username\": \"001\",\n            \"bmember_tks_player\": \"\",\n            \"bmember_tks_playerbet\": \"\",\n            \"bmember_tks_expend\": \"\",\n            \"bmember_tks_income\": \"\",\n
                                                   \"bmember_tks_status\": \"\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                                                   \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                                                 CURLOPT_HTTPHEADER => array(
                                                   "cache-control: no-cache",
                                                   "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                                                   "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
                                                 ),
                                               ));

                                               $response = curl_exec($curl);
                                               $err = curl_error($curl);

                                               curl_close($curl);

                                               if ($err) {
                                                 echo "cURL Error #:" . $err;
                                               } else {
                                                 echo $response;
                                               }


                    }
                    else if($sum < 0){
                        $sum = substr($sum,1);
                      $newbalance = $balance - $sum;
                       $resultlist = $resultlist."\n".$username." -".$sum."=".$newbalance."";

                       $curl = curl_init();

                       curl_setopt_array($curl, array(
                         CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                         CURLOPT_RETURNTRANSFER => true,
                         CURLOPT_ENCODING => "",
                         CURLOPT_MAXREDIRS => 10,
                         CURLOPT_TIMEOUT => 30,
                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                         CURLOPT_CUSTOMREQUEST => "POST",
                         CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                           \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"\",\n            \"bmember_tks_username\": \"001\",\n            \"bmember_tks_player\": \"\",\n            \"bmember_tks_playerbet\": \"\",\n            \"bmember_tks_expend\": \"\",\n            \"bmember_tks_income\": \"\",\n
                           \"bmember_tks_status\": \"\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                           \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                         CURLOPT_HTTPHEADER => array(
                           "cache-control: no-cache",
                           "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                           "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
                         ),
                       ));

                       $response = curl_exec($curl);
                       $err = curl_error($curl);

                       curl_close($curl);

                       if ($err) {
                         echo "cURL Error #:" . $err;
                       } else {
                         echo $response;
                       }

                    }else if ($sum >= 0){
                      $newbalance = $balance + $sum;
                     $resultlist = $resultlist."\n".$username." +".$sum."=".$newbalance."";

                     $curl = curl_init();

                     curl_setopt_array($curl, array(
                       CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                       CURLOPT_RETURNTRANSFER => true,
                       CURLOPT_ENCODING => "",
                       CURLOPT_MAXREDIRS => 10,
                       CURLOPT_TIMEOUT => 30,
                       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                       CURLOPT_CUSTOMREQUEST => "POST",
                       CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n        {\n            \"bmemberno\": \"\",\n
                         \"bmember_tks_userid\": \"$userID\",\n            \"bmember_tks_balance\": \"$newbalance\",\n            \"bmember_tks_bet\": \"\",\n            \"bmember_tks_username\": \"001\",\n            \"bmember_tks_player\": \"\",\n            \"bmember_tks_playerbet\": \"\",\n            \"bmember_tks_expend\": \"\",\n            \"bmember_tks_income\": \"\",\n
                         \"bmember_tks_status\": \"\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 05:25:21\",\n
                         \"modifiedtime\": \"2018-02-02 05:25:21\",\n            \"id\": \"$vid\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                       CURLOPT_HTTPHEADER => array(
                         "cache-control: no-cache",
                         "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                         "postman-token: 0dd99b19-60e4-0597-8d0b-76831d38ee2f"
                       ),
                     ));

                     $response = curl_exec($curl);
                     $err = curl_error($curl);

                     curl_close($curl);

                     if ($err) {
                       echo "cURL Error #:" . $err;
                     } else {
                       echo $response;
                     }
                    }

                  }

                }
                $messages = [
                  'type' => 'text',
                  'text' =>  $resultlist
                ];

              }

        } else {

        }


      }
      else if(strtoupper($text) == "PLAY"){


        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Nmember%20where%20nmember_tks_userid='".$userID."';";
        $response = \Httpful\Request::get($uri)->send();
        // echo $response;
        $exid = $response->body->result[0]->nmember_tks_userid;
        if(strcmp($exid,$userID) == 0){
          $messages = [
            'type' => 'text',
            'text' => 'คุณเป็นสมาชิกอยู่แล้ว'
          ];
        } else {
                      $dname= '';
                      $curl = curl_init();

                      curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.line.me/v2/bot/group/".$groupID."/member/".$userID,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                          "authorization: Bearer XuAPgE5eH13Hbgj7mSSCmqe5wheTgVDhiE805ypPKx1hyHXCXLgshl02rpLCe+rUUVTfBE6SkoXrkRD0c1omm6o8RFZMgCETtwF7nDTKSg3PDQG6OIHE2npC1e3YfWXhvBMcXBwFrF5zE8s9T83cgQdB04t89/1O/w1cDnyilFU=",
                          "cache-control: no-cache",
                          "postman-token: 6dc09c6b-dd83-81ca-75ed-71ce43b5edd7"
                        ),
                      ));

                      $response = curl_exec($curl);
                      $err = curl_error($curl);

                      curl_close($curl);

                      if ($err) {
                        echo "cURL Error #:" . $err;
                      } else {
                      //   echo $response;
                      //
                      $data = json_decode($response,true);
                      $dname =  $data['displayName'];
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\ncreate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n{\n            \"nmemberno\": \"\",\n            \"nmember_tks_userid\": \"$userID\",\n            \"nmember_tks_balance\": \"5000\",\n            \"nmember_tks_bet\": \"\",\n            \"nmember_tks_username\": \"001\",\n            \"nmember_tks_player\": \"\",\n            \"nmember_tks_fchoice\": \"\",\n            \"nmember_tks_schoice\": \"\",\n            \"nmember_tks_tchoice\": \"\",\n
                                \"nmember_tks_expend\": \"0\",\n            \"nmember_tks_income\": \"0\",\n            \"nmember_tks_status\": \"\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-14 04:47:17\",\n            \"modifiedtime\": \"2018-02-14 04:47:17\",\n            \"id\": \"52x866\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"elementType\"\r\n\r\nNmember\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                              CURLOPT_HTTPHEADER => array(
                                "cache-control: no-cache",
                                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                                "postman-token: 56b5423a-b298-8856-72d9-b6262009c954"
                              ),
                            ));

                            $response = curl_exec($curl);
                            $err = curl_error($curl);

                            curl_close($curl);

                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {
                              $messages = [
                                'type' => 'text',
                                'text' => 'สมัครสมาชิกสำเร็จ '.$dname
                              ];
                            }


                      }

        }


      }

      else if(strtoupper($context) == "OX"){
        $messages = [
          'type' => 'text',
          'text' =>  'groupID : '.$groupID.'  userID :'.$userID
        ];
      }

      else if(strtoupper($context) == "EDD"){
        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
        $response = \Httpful\Request::get($uri)->send();

        $adminID = $response->body->result[0]->bgame_tks_adminid;


          if(strcmp($adminID,$userID) == 0){

            $urit = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
            $responset = \Httpful\Request::get($urit)->send();

          //รายรับจ้าวมือ
            $allincome = $responset->body->result[0]->bgame_tks_allincome;
          //รายจ่ายจ้าวมือ
            $allexpend = $responset->body->result[0]->bgame_tks_allexpend;


              $messages = [
                'type' => 'text',
                'text' =>  "สรุปผล ณ เวลา ".date("d-m-Y H:i:s")."\nรายรับ : ".$allincome."\nรายจ่าย : ".$allexpend."\nยอดถอน : 0 \nยอดฝาก : 0"
              ];
            } else {

            }
      }
      else if(strtoupper($context) == "OPP"){

        $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='37x3';";
        $response = \Httpful\Request::get($uri)->send();

        $adminID = $response->body->result[0]->bgame_tks_adminid;


          if(strcmp($adminID,$userID) == 0){

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n     {\n            \"bgameno\": \"\",\n            \"bgame_tks_adminid\": \"$adminID\",\n            \"bgame_tks_gamestatus\": \"0\",\n            \"bgame_tks_round\": \"1\",\n            \"bgame_tks_allincome\": \"\",\n            \"bgame_tks_allexpend\": \"\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 06:06:23\",\n            \"modifiedtime\": \"2018-02-02 06:06:23\",\n            \"id\": \"37x3\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 2854d113-098a-2091-f3a5-bc42427bc062"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $response;
            }


        $messages = [
          'type' => 'text',
          'text' => 'กำลังเริ่มรอบแรกเตรียมตัว ...'
        ];


      } else {
      }


      }

      else if(strtoupper($context) == "PL"){

        $forwardtext = strstr($text, '+', true);
        $num1 = substr($forwardtext, 3);
        $num2  = substr($text, (strpos($text, '+') ?: -1) + 1);
        $sumall = $num1+$num2;
        $messages = [
          'type' => 'text',
          'text' => $sumall
        ];
      }
      else if(strtoupper($context) == "MU"){

        $forwardtext = strstr($text, '*', true);
        $num1 = substr($forwardtext, 3);
        $num2  = substr($text, (strpos($text, '*') ?: -1) + 1);
        $sumall = $num1*$num2;
        $messages = [
          'type' => 'text',
          'text' => $sumall
        ];
      }
      else if(strtoupper($context) == "MI"){

        $forwardtext = strstr($text, '-', true);
        $num1 = substr($forwardtext, 3);
        $num2  = substr($text, (strpos($text, '-') ?: -1) + 1);
        $sumall = $num1-$num2;
        $messages = [
          'type' => 'text',
          'text' => $sumall
        ];
      }

      else if(strtoupper($context) == "DI"){

        $forwardtext = strstr($text, '/', true);
        $num1 = substr($forwardtext, 3);
        $num2  = substr($text, (strpos($text, '/') ?: -1) + 1);
        $sumall = $num1/$num2;
        $messages = [
          'type' => 'text',
          'text' => $sumall
        ];
      }
      else if($gameStatus==0) {

        // $messages = [
        //   'type' => 'text',
        //   'text' => 'ขณะนี้ ไม่ใช่เวลาแทง เปิดรอรอบใหม่อีกครั้ง'
        // ];
      }
      // else if($gameStatus==0) {
      //
      //   $messages = [
      //     'type' => 'text',
      //     'text' => 'ขณะนี้ ไม่ใช่เวลาแทง เปิดรอรอบใหม่อีกครั้ง'
      //   ];
      // }
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
    else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {

      $pid = $event['message']['packageId'];
      $sid = $event['message']['stickerId'];
        $userID = $event['source']['userId'];
			$replyToken = $event['replyToken'];

      $uri = $vturl."webservice.php?operation=query&sessionName=".$sidname."&query=select%20*%20from%20Bgame%20Where%20id%20='50x872';";
      $response = \Httpful\Request::get($uri)->send();

      $adminID = $response->body->result[0]->bgame_tks_adminid;
      $gameStatus = $response->body->result[0]->bgame_tks_gamestatus;
      $allincome = $response->body->result[0]->bgame_tks_allincome;
      $allexpend = $response->body->result[0]->bgame_tks_allexpend;
      $cround = $response->body->result[0]->bgame_tks_round;
      $cround2 = $cround+1;


        if(strcmp($adminID,$userID) == 0){

                  if($gameStatus ==0){


                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n     {\n            \"bgameno\": \"\",\n            \"bgame_tks_adminid\": \"$adminID\",\n            \"bgame_tks_gamestatus\": \"1\",\n            \"bgame_tks_round\": \"$cround\",\n            \"bgame_tks_allincome\": \"$allincome\",\n
                        \"bgame_tks_allexpend\": \"$allexpend\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 06:06:23\",\n            \"modifiedtime\": \"2018-02-02 06:06:23\",\n            \"id\": \"50x872\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                        "postman-token: 2dbc0309-4e61-c7f5-776f-3b2a14f71c55"
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      echo "cURL Error #:" . $err;
                    } else {
                      $messagesx = [
                        'type' => 'text',
                        // 'text' => 'แทงผู้เล่น'.$player.'จำนวน'.$money.'ชื่อผู้เล่น'.$username.'ยอดคงเหลือ'.$balance.'vid:'.$vid
                        'text' => '🍺 กติกา  🍭

พิมพ์ T ตามด้วย สัตว์ที่ต้องการแทง น้ำเต้า ปู ปลา
และ - (ขีด) ตามด้วยจำนวนเงิน เช่น T123-100

1 คือ น้ำเต้า 💧
2 คือ ปู 🦀
3 คือ ปลา 🐠
4 คือ  กุ้ง 🦐
5 คือ เสือ 🐯
6 คือ ไก่ 🐔'
                      ];


                      $url = 'https://api.line.me/v2/bot/message/push';
                      $datax = [
                        'to' => 'C460c62552ff61a39ccaa8e085335f969',
                        'messages' => [$messagesx],
                      ];
                      $postx = json_encode($datax);
                      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

                      $ch = curl_init($url);
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $postx);
                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                      $result = curl_exec($ch);
                      curl_close($ch);
                    }

                    $messages = [
                      'type' => 'text',
                      'text' => 'เริ่มรอบที่ # '.$cround
                    ];



                  }else{



                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "http://redfoxdev.com/vtiger/webservice.php",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"operation\"\r\n\r\nupdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionName\"\r\n\r\n709c1a7e5a83bd434de8f\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"element\"\r\n\r\n     {\n            \"bgameno\": \"\",\n            \"bgame_tks_adminid\": \"$adminID\",\n            \"bgame_tks_gamestatus\": \"0\",\n            \"bgame_tks_round\": \"$cround2\",\n            \"bgame_tks_allincome\": \"$allincome\",\n
                        \"bgame_tks_allexpend\": \"$allexpend\",\n            \"assigned_user_id\": \"19x1\",\n            \"createdtime\": \"2018-02-02 06:06:23\",\n            \"modifiedtime\": \"2018-02-02 06:06:23\",\n            \"id\": \"50x872\"\n        }\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                        "postman-token: 2dbc0309-4e61-c7f5-776f-3b2a14f71c55"
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      echo "cURL Error #:" . $err;
                    } else {
                      $messagesx = [
                        'type' => 'text',
                        // 'text' => 'แทงผู้เล่น'.$player.'จำนวน'.$money.'ชื่อผู้เล่น'.$username.'ยอดคงเหลือ'.$balance.'vid:'.$vid
                        'text' => '🍺 กติกา  🍭

พิมพ์ T ตามด้วย สัตว์ที่ต้องการแทง น้ำเต้า ปู ปลา
และ - (ขีด) ตามด้วยจำนวนเงิน เช่น T123-100

1 คือ น้ำเต้า 💧
2 คือ ปู 🦀
3 คือ ปลา 🐠
4 คือ  กุ้ง 🦐
5 คือ เสือ 🐯
6 คือ ไก่ 🐔
  '
                      ];


                      $url = 'https://api.line.me/v2/bot/message/push';
                      $datax = [
                        'to' => 'C460c62552ff61a39ccaa8e085335f969',
                        'messages' => [$messagesx],
                      ];
                      $postx = json_encode($datax);
                      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

                      $ch = curl_init($url);
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($ch, CURLOPT_POSTFIELDS, $postx);
                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                      $result = curl_exec($ch);
                      curl_close($ch);
                    }


                    $messages = [
                      'type' => 'text',
                      'text' => 'ปิดรอบที่ # '.$cround
                    ];

                  }


      }else {

      }




			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
