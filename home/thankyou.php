<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include 'src/instamojo.php';
/*$api = new Instamojo\Instamojo('5ab10726b6ff4eacdc65389ea7c8475c', '830b2e5caa7a946679fa656850dde37d','https://www.instamojo.com/api/1.1/payment-requests/');

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);


    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
    echo "<h6>An email was sent to you. (Check Junk Folder)</h6>";

/*echo "<pre>";
   print_r($response);
echo "</pre>";*/
?>


<?php
/*
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

*/
?>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payments/MOJO5a06005J21512197/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:5ab10726b6ff4eacdc65389ea7c8475c", "X-Auth-Token:830b2e5caa7a946679fa656850dde37d"));
$response = curl_exec($ch);
echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
echo "<h6>An email was sent to you. (Check Junk Folder)</h6>";
curl_close($ch);
echo $response;
