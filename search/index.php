<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cacheBuster = rand(999999999, 9999999999999); // Put on an image URL will help always show new when changed
$encrypted_nos = base64_encode("s6k3k4lsjdfsdsasf453fs"); //this will be used in deleting response
include ('../scripts/DB_connect.php');
include_once ("../scripts/user_session.php");
if (!isset($_SESSION['idx'])) {
    header('Location: ../');
}
if ($_POST) {
    $q = mysqli_escape_string($connection, $_POST['searchword']);
    $sql_res = mysqli_query($connection, "SELECT * from users where concat(username,' ',city,' ',state) like '%$q%' order by id LIMIT 8");
    $search_nums = mysqli_num_rows($sql_res); //TOTAL NUMBER OF RESULTS
    while ($row = mysqli_fetch_array($sql_res)) {
        $id = $row['id'];
        $user = $row['username'];
        $city = $row['city'];
        $state = $row['state'];
        /*$country=$row['country'];
        $email=$row['email'];
        */
        $re_user = '<b>' . $q . '</b>';
        $re_city = '<b>' . $q . '</b>';
        $final_user = str_ireplace($q, $re_user, $user);
        $final_city = str_ireplace($q, $re_city, $city);
        ///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
        $profile_pic_check = "../users/$id/pic.jpg";
        $default_profile_pic = "../users/0/pic.jpg";
        if (file_exists($profile_pic_check)) {
            $search_profile_pic = "<img style=\"width:80px;height:80px;\" class=\"img img-responsive pull-right\" id=\"search_profile_pic\" src=\"$profile_pic_check?$cacheBuster\"  />";
        } else {
            $search_profile_pic = "<img style=\"width:80px;height:80px;\" class=\"img img-responsive pull-right\" id=\"search_profile_pic\" src=\"$default_profile_pic\" />";
        }
?>
<div class="panel display_box" align="left" style="margin-top:8px;">
<a href="../home/?id=<?php echo $id; ?>">
<div class="row">
<div class="col col-md-2"><?php echo $search_profile_pic; ?></div>
<div class="col col-md-4">

<div id="search_qD" style="margin-top:8px;font-weight: bold;"><?php echo $final_user; ?>, <?php echo $final_city; ?></div>
<span style="font-size:9px; color:#999999"></span></a>
</div>
</a>
</div>




<?php
    }
} else {
    echo "<div id=\"search_results\" style=\"text-align:center;\" class=\"row\"><div class=\"col col-md-12\">No More Results !</div></div>";
}
if ($search_nums > 5) {
    echo '
<div id="more_search_results</div>">';
} else {
    echo "<div id=\"search_results\" style=\"text-align:center;\" class=\"row\"><div class=\"col col-md-12\">No More results are available, We hope you got what you have been looking for.</div>";
}
?>