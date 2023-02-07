<?php
$name = str_replace(array("'", "\"", "`"), "", $_POST['w3lName']);
$company = str_replace(array("'", "\"", "`"), "", $_POST['w3lCompany']);
$email = str_replace(array("'", "\"", "`"), "", $_POST['w3lSender']);
$phone = str_replace(array("'", "\"", "`"), "", $_POST['w3lPhone']);
$message = str_replace(array("'", "\"", "`"), "", $_POST['w3lMessage']);

$finalText = $name." ".$company." ".$email." ".$phone." ".$message;
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Company = " . $company . "\r\n Phone = " . $phone . "\r\n Message =" . $message;
$api_endpoint = 'devapi.iothingss.com/api/v1/users/contact';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $api_endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>'{
    "name": "'.$name.'",
    "email": "'.$email.'",
    "company": "'.$company.'",
    "phone": "'.$phone.'",
    "message": "'.$message.'"
  }',
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Accept: application/json"
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

