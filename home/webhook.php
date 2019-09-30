<?php
$data = $_POST;
$mac_provided = $data['mac']; // Get the MAC from the POST data
unset($data['mac']); // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int)$ver[0];
$minor = (int)$ver[1];
if ($major >= 5 and $minor >= 4) {
    ksort($data, SORT_STRING | SORT_FLAG_CASE);
} else {
    uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
$mac_calculated = hash_hmac("sha1", implode("|", $data), "33b5d0e4eb514b6abb4417a61b445ec1");
if ($mac_provided == $mac_calculated) {
    echo "MAC is fine";
    // Do something here
    if ($data['status'] == "Credit") {
        $username_booked = $data['purpose'];
        $pay_id = $data['payment_id'];
        $price = $data['amount'];
        $email = $data['buyer'];
        $username_booker = $data['buyer_name'];
        include_once ("../scripts/DB_connect.php");
        $sql_query_b = mysqli_query($connection, "SELECT * FROM users WHERE username='$username_booked'");
        while ($row = mysqli_fetch_array($sql_query_b)) {
            $user_id = $row['id'];
            $booked_email = $row['email'];
        }
        $sql_q = mysqli_query($connection, "SELECT * FROM hire_request WHERE hiring_id='$user_id'");
        while ($row = mysqli_fetch_array($sql_q)) {
            $hired_id = $row['hiring_id'];
        }
        $sql_q2 = mysqli_query($connection, "SELECT * FROM users WHERE username='$username_booker'");
        while ($row = mysqli_fetch_array($sql_q2)) {
            $booker_id = $row['id'];
        }
        $sql_quey_send = mysqli_query($connection, "INSERT INTO bookings (booking_user,booked_user,booked_price,transaction_id,payment_status,paydate) VALUES('$booker_id','$user_id','$price','$pay_id','1',now())");
        $sql_query2 = mysqli_query($connection, "DELETE FROM hire_request WHERE own_id='$booker_id' AND hiring_id='$user_id' LIMIT 1");
        $creator_email = "kairosodeum@gmail.com";
        // Payment was successful, mark it as completed in your database
        $from = "info@kairosodeum.com";
        $to = '' . $data['buyer'] . ',' . $creator_email . ',' . $booked_email . '';
        $subject = 'Kairosodeum payment details for' . $data['buyer_name'] . '';
        $message = "<h1>Payment Details</h1>";
        $message.= "<hr>";
        $message.= '<p><b>ID:</b> ' . $data['payment_id'] . '</p>';
        $message.= '<p><b>Amount:</b> ' . $data['amount'] . '</p>';
        $message.= "<hr>";
        $message.= '<p><b>Name:</b> ' . $data['buyer_name'] . '</p>';
        $message.= '<p><b>Email:</b> ' . $data['buyer'] . '</p>';
        $message.= '<p><b>Phone:</b> ' . $data['buyer_phone'] . '</p>';
        $message.= "<hr>
                Note: <h6>If you have any problems regarding payment. Contact us at www.kairosodeum.com</h6>
                ";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        // send email
        mail($to, $subject, $message, $headers);
    } else {
        // Payment was unsuccessful, mark it as failed in your database
        //$sql_query = mysqli_query($connection,"UPDATE applicants SET pay_id='$pay_id', payment_status='0' WHERE course_id='$c_id' AND email='$email' LIMIT 1");
        
    }
} else {
    echo "Invalid MAC passed";
}
?>
