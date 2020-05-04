<?php
include_once "../class/users.php";
include_once "../class/control.php";
include "../config/connection.php";
$title = "Profile";
$avatar = null;
if (isset($_GET['user']) && !empty($_GET['user'])) {
    $iduser = $_GET['user'];
} else {
    if ($_SESSION['avatar'] != null) {
        $avatar =$_SESSION['avatar'];
    }
    $fullname = $_SESSION['fname'] . " " . $_SESSION['lname'];
    $iduser = $_SESSION['iduser'];
}
$fname = null;
$lname = null;
$sexe = null;
$birthday = null;
$username = null;
$company = null;
$grade = $post = null;
$adress = null;
$city = null;
$country = null;
$phonenumber = null;
$email = null;
$about = null;
//-------------
$user = new users($connexion);
$rows = $user->getusers($iduser);
$ctrl = new Control($connexion);
$domain = $ctrl->getDomain(-1);
$levels = $ctrl->getlevels();
foreach ($rows as $item) {
    $fname = $item['fname'];
    $lname = $item['lname'];
    $sexe = $item['sexe'];
    $birthday = $item['birthday'];
    $username = $item['username'];
    $company = $item['company'];
    $grade = $post = $item['grade'];
    $adress = $item['adress'];
    $city = $item['city'];
    $country = $item['country'];
    $phonenumber = $item['phonenumber'];
    $email = $item['email'];
    $about = $item['about'];
    $level = $item['level'];
    if ($item['avatar'] != null) {
        $avatar = "../" . $item['avatar'];
    }else{
        $avatar="../img/avatar/". $item['sexe'].".png";
    }
    $_SESSION['avatar']=$avatar;
}

?>