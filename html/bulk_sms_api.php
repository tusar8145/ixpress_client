<?php
	$entityBody = file_get_contents('php://input');
 
 
//echo $name = $data[0];

 $url = "https://msg.elitbuzz-bd.com/smsapimany";

 $data = [
    "api_key" => "C20083156283cb3a7eed87.11709072",
	"senderid" => "iXpress Ltd",
	"type" => "application/json",
	"messages" =>json_decode($entityBody)
  ]; 
 // {"api_key":"C200220963982415234249.96775123","senderid":"8809612444336","messages":[{"to":"8801795621796","message":"11"},{"to":"8801795621796","message":"22"}]}



   $compactJsonString =  json_encode($data);
  
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json',
                                            'Connection: Keep-Alive'
                                            ));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $compactJsonString);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  echo $response = curl_exec($ch);
  curl_close($ch);


?>


