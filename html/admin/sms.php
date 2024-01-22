<?php
 

  $url = "http://206.189.159.184/api";
  $data = [
    "api_key" => "C200220963982415234249.96775123",
    "senderid" => "8809612444336",
    "messages" => json_encode( [
      [
        "to" => "8801795621796",
        "message" => "test sms content …"
      ]
     ])
  ];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  
  curl_close($ch);
 
echo $response;

?>