<?php
$fullname = $_SESSION['fname'] . " " . $_SESSION['lname'];
$avatar = "../" . $_SESSION['avatar'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/w3.css">
    <link rel="stylesheet" href="../style/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/index.css">
    <style></style>
    <?php echo "<title>$title</title>"; ?>
</head>

<body>
    <div class="containerDashBoard">
        <div class="w3-bar w3-white  top-bar" id="topbarMenu">
            <a href="#" class="w3-button w3-bar-item"><i class="fa fa-bars w3-xxxlarge"></i></a>
            <div class="w3-right">
                <a href="../controller/logout.php" class="w3-bar-item w3-text-blue btn w3-hover-text-red w3-large pointer">Logout</a>
                <?php
                echo "<div class=\"w3-bar-item w3-text-blue w3-large\">$fullname</div>";
                echo "<img src=\"$avatar\" alt=\"\" class=\"profil-image w3-margin-right w3-circle\" >"; ?>
            </div>
        </div>
        <div class="w3-sidebar w3-bar-block w3-light-grey w3-card dasheader dash-side-menu" id="sideMenu">
            <header class="tops-bar w3-padding ">
                <a href="../"><i class="fa fa-home w3-xxlarge"></i></a><span class="w3-xxlarge">Dr Bot</span></header>
            <?php include "./menu.php"; ?>
        </div>
        <div class="dash-containt w3-light-gray">
            <?php
            echo $contentpages;
            ?>
        </div>
        <div class="w3-border-top w3-center copyrightbar">
            <p class=""> <i class="fa fa-copyright w3-text-green w3-xlarge"></i> copyright DrBot <span id="mydate"></span></p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['error'])  || isset($_SESSION['success']) || isset($_SESSION['warning'])) {
        require '../alert/message.php';
    }
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        require '../alert/danger.php';
    }
    if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        require '../alert/success.php';
    }
    if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) {
        require '../alert/warning.php';
    }
    require '../alert/question.php';
    ?>
    <script src="../js/w3.js"></script>
    <script src="../js/index.js"></script>
    <script>
        // activatemenu();
    </script>
</body>

</html>