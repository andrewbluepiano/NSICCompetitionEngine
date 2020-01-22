<?php
require_once('writeconnect.php');
$addcomments = mysqli_real_escape_string( $writeconn, $_POST['vol_comments']);
$asl = mysqli_real_escape_string( $writeconn, $_POST['vol_asl']);

$fname = mysqli_real_escape_string( $writeconn, $_POST['vol_fname']);
$lname = mysqli_real_escape_string( $writeconn, $_POST['vol_lname']);
$email = mysqli_real_escape_string( $writeconn, $_POST['vol_email']);
$shirt = mysqli_real_escape_string( $writeconn, $_POST['vol_shirt']);


$netskill = mysqli_real_escape_string( $writeconn, $_POST['netskill']);
$sysskill = mysqli_real_escape_string( $writeconn, $_POST['sysskill']);

$area_ser = serialize($_POST['vol_area']);
$days_ser = serialize($_POST['vol_days']);

if($stmt = $writeconn->prepare("INSERT INTO volunteers (fname, lname, email, addcomments, asl, shirtsize, areas, days) VALUES (?,?,?,?,?,?,?,?)")){
    if($stmt->bind_param("ssssisss", $fname, $lname, $email, $addcomments, $asl, $shirt, $area_ser, $days_ser)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}
$writeconn->close();

// JS That uses an iFrame to load the getCal file that downloads the calendar file.
echo '<iframe id="my_iframe" style="display:none;"></iframe>';
echo '<script>';
echo "document.getElementById('my_iframe').src = \"getCal.php\";";
echo '</script>';

// Redirects to home. Refresh must at least be 1.
header('Refresh: 1;url=../');
?>
