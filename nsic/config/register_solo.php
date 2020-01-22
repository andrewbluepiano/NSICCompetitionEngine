<?php
require_once('writeconnect.php');
$addcomments = mysqli_real_escape_string( $writeconn, $_POST['solocomments']);
$diet = mysqli_real_escape_string( $writeconn, $_POST['solodiet']);
$asl = mysqli_real_escape_string( $writeconn, $_POST['soloasl']);
$netskill = mysqli_real_escape_string( $writeconn, $_POST['netskill']);
$sysskill = mysqli_real_escape_string( $writeconn, $_POST['sysskill']);

$fname = mysqli_real_escape_string( $writeconn, $_POST['solofname']);
$lname = mysqli_real_escape_string( $writeconn, $_POST['sololname']);
$email = mysqli_real_escape_string( $writeconn, $_POST['soloemail']);
$shirt = mysqli_real_escape_string( $writeconn, $_POST['soloshirt']);

if($stmt = $writeconn->prepare("INSERT INTO solo_unplaced (fname, lname, email, addcomments, diet, asl, shirtsize, networkingskill, sysadminskill) VALUES (?,?,?,?,?,?,?,?,?)")){
    if($stmt->bind_param("sssssisii", $fname, $lname, $email, $addcomments, $diet, $asl, $shirt, $netskill, $sysskill)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement (Solo): " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement (Solo): " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement (Solo): " . mysqli_error($writeconn));
}
$writeconn->close();

// JS That uses an iFrame to load the getCal file that downloads the calendar file.
echo '<iframe id="my_iframe" style="display:none;"></iframe>';
echo '<script>';
echo "document.getElementById('my_iframe').src = \"getCal.php\";";
echo '</script>';

// Redirects to the store to pay registration. Refresh must at least be 1.
header('Refresh: 1;url=https://campusgroups.rit.edu/store?store_id=562');
?>
