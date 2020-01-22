<?php
require_once('writeconnect.php');
if(!empty($_POST['teamset'])) {
    foreach($_POST['teamset'] as $check) {
        $result_explode = explode('|', $check);
        if(isset( $result_explode[1])){
            $sql = mysqli_query($writeconn, "SELECT * FROM solo_unplaced WHERE uid LIKE");
            
        }
    }
}
?>
