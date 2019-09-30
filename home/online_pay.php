<?php
include 'src/instamojo.php';
/*$api = new Instamojo\Instamojo('5ab10726b6ff4eacdc65389ea7c8475c', '830b2e5caa7a946679fa656850dde37d','https://www.instamojo.com/api/1.1/payment-requests/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $b_username,
        "amount" => $b_price2,
        "buyer_name" => $sessionInit_username,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://www.kairosodeum.com/home/thankyou.php",
        "webhook" => "http://www.kairosodeum.com/home/webhook.php"
        



        ));
    print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
*/
?>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:5ab10726b6ff4eacdc65389ea7c8475c", "X-Auth-Token:830b2e5caa7a946679fa656850dde37d"));
$payload = Array("purpose" => $b_username, "amount" => $b_price2, "phone" => $phone, "buyer_name" => $sessionInit_username, "redirect_url" => "http://www.kairosodeum.com/home/thankyou.php", "webhook" => "http://www.kairosodeum.com/home/webhook.php", "send_email" => true, "send_sms" => true, "email" => $email, "allow_repeated_payments" => false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
var_dump($data);
$site = $data["payment_request"]["longurl"];
header('HTTP/1.1 301 Moved Permanently');
header('Location:' . $site);
