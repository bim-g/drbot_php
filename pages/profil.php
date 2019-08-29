<?php
    session_start();
     ob_start();
    include_once "../class/users.php";
    include_once "../class/control.php";
    include "../config/connection.php";
    
    $title="Profile"; 
    $avatar="../img/avatar/face-0.jpg";
    if(isset($_GET['user']) && !empty($_GET['user'])){
        $iduser=$_GET['user'];
    } else{
        if($_SESSION['avatar']!=null){
            $avatar="../".$_SESSION['avatar'];
        }
        $fullname=$_SESSION['fname']." ".$_SESSION['lname'];
        $iduser=$_SESSION['iduser'];
    }
    $fname=null;
    $lname=null;
    $sexe=null;
    $birthday=null;
    $username=null;
    $company=null;
    $grade=$post=null;
    $adress=null;
    $city=null;
    $country=null;
    $phonenumber=null;
    $email=null;
    $about=null; 
    //-------------
    $user = new users($connexion);
    $rows = $user->getusers($iduser);
    $ctrl = new Control($connexion);
    $domain = $ctrl->getDomain(-1);
    foreach($rows as $item){
        $fname=$item['fname'];
        $lname=$item['lname'];
        $sexe=$item['sexe'];
        $birthday=$item['birthday'];
        $username=$item['username'];
        $company=$item['company'];
        $grade=$post=$item['grade'];
        $adress=$item['adress'];
        $city=$item['city'];
        $country=$item['country'];
        $phonenumber=$item['phonenumber'];
        $email=$item['email'];
        $about=$item['about'];
        if($item['avatar']!=null){
            $avatar="../".$item['avatar'];
        }
    }
    
?>

    <script>activatemenu();</script>
    
    <div class="w3-light-gray w3-paddding">
        <div class="w3-row">
            <form method="POST" action="../controller/users.php">
                <div class="w3-margin w3-padding w3-white w3-round w3-col s8 w3-border">
                    <h3>Edit Profil</h3>
                    <?php echo "<input type=\"hidden\" class=\"w3-input w3-border w3-round\" name=\"iduser\" value=\"$iduser\">";?>                          
                    <div class="w3-row-padding">                            
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">FIRST NAME </label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"fname\" value=\"$fname\">";?>
                        </div>
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">LAST NAME </label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"lname\" value=\"$lname\">"; ?>
                        </div>
                    </div> <br>
                    <div class="w3-row-padding">
                        <div class="w3-col s12 m12 l12">
                            <label class="w3-text-gray w3-small">USERNAME</label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"username\" placeholder=\"@drbot\" value=\"$username\">";?>
                        </div>
                    </div><br>
                    <div class="w3-row-padding">
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">COMPANY </label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"company\" value=\"$company\">";?>
                        </div>
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">POST OCCUPIED </label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"post\" value=\"$post\">";?>
                        </div>
                    </div> <br/>                            
                    <div class="w3-row-padding">
                        <div class="w3-col s12 m12 l12">
                            <label class="w3-text-gray w3-small">ADRESS</label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" placeholder=\"Town   /   Street   /   plot\" value=\"$adress\" name=\"address\">";?>
                        </div>
                    </div><br>                
                    <div class="w3-row-padding">
                        <div class="w3-col s4 l4 m4">
                            <label class="w3-text-gray w3-small">CITY</label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"city\" value=\"$city\" >";?>
                        </div>
                        <div class="w3-col s4 l4 m4">
                            <label class="w3-text-gray w3-small">COUNTRY</label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" name=\"country\" value=\"$country\" >";?>
                        </div>
                        <div class="w3-col s4 l4 m4">
                            <label class="w3-text-gray w3-small">CODE POSTAL</label><br>
                            <?php echo "<input type=\"text\" class=\"w3-input w3-border w3-round\" placeholder=\"code postal\" value=\"\">";?>
                        </div>
                    </div>  <br/>
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="w3-rest">
                            <select class="w3-select " name="grade" id="usercadre" onchange="changeCadre(usercadre.value)">                                
                                <?php echo "<option class=\"w3-large\" disabled selected>Grade</option>";
                                if($grade!=null) echo "<option class=\"w3-large\" value=\"$grade\" disabled selected>$grade</option>";?>
                                <option value=" ">None</option>
                                <option value="doctor">Doctor</option>
                                <option value="specialist">Specialist</option>
                                <option value="nurse">Nurse</option>
                            </select>
                        </div>
                    </div>                           
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom controlHide specialist" >
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="w3-rest">
                            <select class="w3-select " name="domain" id="domain"> 
                                <option class="w3-large" value="" disabled selected>Specialization</option>
                                <?php
                                    foreach($domain as $dmn){
                                        echo "<option value=\"".$dmn['idomain']."\" >".$dmn['designation']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom controlHide specialist doctor" >
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-id-card-o"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="number" name="nationalId" id="nationalId" class="w3-input " placeholder="Nationnal Id" >
                        </div>
                    </div>                            
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom controlHide nurse">
                            <div class="w3-col w3-padding inputIcon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="w3-rest">
                                <select class="w3-select " name="levelStudies" id="levelStudies">                                
                                    <option class="w3-large" value="" disabled selected>Level Stadies</option>
                                    <option value="a1" >Graduate A1</option>
                                    <option value="a2">Diploma A2</option>
                                    <option value="a3">Diploma A3</option>
                                </select>
                            </div>
                        </div>
                    <div class="w3-row-padding">                            
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">PHONE NUMBER</label><br>
                            <?php echo"<input type=\"text\" name=\"phonenumber\" class=\"w3-input w3-border w3-round\" value=\"$phonenumber\">";?>
                        </div>
                        <div class="w3-col s6 l6 m6">
                            <label class="w3-text-gray w3-small">EMAIL ADRESS</label><br>
                            <?php echo"<input type=\"email\" name=\"email\" class=\"w3-input w3-border w3-round\" value=\"$email\">";?>
                        </div>
                    </div><br>
                    <div class="w3-row-padding">
                        <div class="w3-col s12 l12 m12">
                            <label class="w3-text-gray w3-small">ABOUT</label><br>
                            <?php echo "<textarea name=\"about\" cols=\"30\" rows=\"6\" class=\"w3-input w3-round w3-col s12 m12 l12 w3-border\" value=\"$about\"></textarea>";?>
                        </div>
                    </div>
                    <div class="w3-bar w3-margin">
                        <input type="submit" class="w3-button w3-blue w3-round" name="user" value="updateuser">
                    </div>
                </div>
            </form>
            <div class="w3-margin w3-padding w3-white w3-round w3-col s3 w3-center w3-border">
                <div class="w3-display-container " style="min-width:150px;">
                    <?php echo "<img src=\"$avatar\" alt=\"\" class=\"w3-image w3-circle w3-border \" style=\"width:150px;\">"; ?>
                    <form method="POST">
                        <label class="w3-display-right w3-padding w3-text-blue w3-hover-text-red pointer" ><i class="fa fa-camera w3-xxlarge"></i>
                        <?php echo "<input type=\"file\" name=\"profilePricture\" id=\"profilePricture\" value=\"$iduser\" hidden></label>";?>                    
                </div>
                <?php echo "<h3 class=\"w3-text-gray\">$fname $lname</h3>";?>
                <p class="w3-text-gray">It & Webdevelloper at JusticeBot.com</p>
                <hr class="w3-margin-top">
                <div class="w3-bar">
                    <input type="submit" value="Update Picture" class="w3-green w3-button">
                </div>
            </form>
            </div>
        </div>
    </div>
<?php
$contentpages = ob_get_clean();
include "./template.php";
?>
    