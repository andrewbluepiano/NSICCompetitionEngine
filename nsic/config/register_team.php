<?php
// Author: Andrew Afonso
// Registers a team
require_once('writeconnect.php');
$teamname = mysqli_real_escape_string( $writeconn, $_POST['teamname']);
$teamschool = mysqli_real_escape_string( $writeconn, $_POST['school']);
$addcomments = mysqli_real_escape_string( $writeconn, $_POST['addcomments']);
$diet = mysqli_real_escape_string( $writeconn, $_POST['diet']);
$asl = mysqli_real_escape_string( $writeconn, $_POST['asl']);
$loginid = mysqli_real_escape_string( $writeconn, $_POST['loginid']);

$fnameone = mysqli_real_escape_string( $writeconn, $_POST['fnameone']);
$lnameone = mysqli_real_escape_string( $writeconn, $_POST['lnameone']);
$emailone = mysqli_real_escape_string( $writeconn, $_POST['emailone']);
$shirtone = mysqli_real_escape_string( $writeconn, $_POST['shirtone']);

$fnametwo = mysqli_real_escape_string( $writeconn, $_POST['fnametwo']);
$lnametwo = mysqli_real_escape_string( $writeconn, $_POST['lnametwo']);
$emailtwo = mysqli_real_escape_string( $writeconn, $_POST['emailtwo']);
$shirttwo = mysqli_real_escape_string( $writeconn, $_POST['shirttwo']);

$fnamethree = mysqli_real_escape_string( $writeconn, $_POST['fnamethree']);
$lnamethree = mysqli_real_escape_string( $writeconn, $_POST['lnamethree']);
$emailthree = mysqli_real_escape_string( $writeconn, $_POST['emailthree']);
$shirtthree = mysqli_real_escape_string( $writeconn, $_POST['shirtthree']);

$fnamefour = mysqli_real_escape_string( $writeconn, $_POST['fnamefour']);
$lnamefour = mysqli_real_escape_string( $writeconn, $_POST['lnamefour']);
$emailfour = mysqli_real_escape_string( $writeconn, $_POST['emailfour']);
$shirtfour = mysqli_real_escape_string( $writeconn, $_POST['shirtfour']);

$fnamefive = mysqli_real_escape_string( $writeconn, $_POST['fnamefive']);
$lnamefive = mysqli_real_escape_string( $writeconn, $_POST['lnamefive']);
$emailfive = mysqli_real_escape_string( $writeconn, $_POST['emailfive']);
$shirtfive = mysqli_real_escape_string( $writeconn, $_POST['shirtfive']);

if($stmt = $writeconn->prepare("INSERT INTO teams (tname, school, addcomments, diet, asl) VALUES (?,?,?,?,?)")){
    if($stmt->bind_param("ssssi", $teamname, $teamschool, $addcomments, $diet, $asl)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement (Team): " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement (Team): " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement (Team): " . mysqli_error($writeconn));
}

$teamid = mysqli_insert_id($writeconn);

if($stmt = $writeconn->prepare("INSERT INTO users (compuser, teamid, trust, enabled) VALUES (?,?,0,0)")){
    if($stmt->bind_param("si", $loginid, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement (Team): " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement (Team): " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement (Team): " . mysqli_error($writeconn));
}


if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
    if($stmt->bind_param("ssssi", $emailone, $fnameone, $lnameone, $shirtone, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}

if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
    if($stmt->bind_param("ssssi", $emailtwo, $fnametwo, $lnametwo, $shirttwo, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}

if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
    if($stmt->bind_param("ssssi", $emailthree, $fnamethree, $lnamethree, $shirtthree, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}

if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
    if($stmt->bind_param("ssssi", $emailfour, $fnamefour, $lnamefour, $shirtfour, $teamid)){
        if(!$stmt->execute()){
            die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
    }
}else{
    die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
}

if($fnamefive != ""){
    if($stmt = $writeconn->prepare("INSERT INTO participants (email, fname, lname, shirtsize, teamid) VALUES (?,?,?,?,?)")){
        if($stmt->bind_param("ssssi", $emailfive, $fnamefive, $lnamefive, $shirtfive, $teamid)){
            if(!$stmt->execute()){
                die("ERR: Issue executing prepared statement: " . mysqli_error($writeconn));
            }
        }else{
            die("ERR: Issue binding prepared statement: " . mysqli_error($writeconn));
        }
    }else{
        die("ERR: Issue preparing statement: " . mysqli_error($writeconn));
    }
}

// JS That uses an iFrame to load the getCal file that downloads the calendar file.
echo '<iframe id="my_iframe" style="display:none;"></iframe>';
echo '<script>';
echo "document.getElementById('my_iframe').src = \"getCal.php\";";
echo '</script>';

// Redirects to the store to pay registration. Refresh must at least be 1.
header('Refresh: 1;url=https://campusgroups.rit.edu/store?store_id=562');
?>
