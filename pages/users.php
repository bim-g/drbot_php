<?php
    session_start();
    ob_start();
    $title="Users";
    include_once "../class/users.php";
    include "../config/connection.php";
    $user= new users($connexion);
    $rows=$user->getusers(null);
    $profil="../img/avatar/face-0.jpg";

?>
<script>activatemenu();</script>
    <div class="w3-margin w3-padding w3-large-round w3-border w3-white w3-hide" id="searchopt">
        <form method="post">
            <div class="w3-row">
                <div class="w3-col m6 l6 w3-border-right">
                    <h3 class="w3-text-gray">Display Option</h3>
                    type <input type="radio" name="statemsg" class="w3-radio" value="0" id="">
                    read <input type="radio" name="statemsg" class="w3-radio" value="1" id="">
                    respond <input type="radio" name="statemsg" class="w3-radio" value="2" id="">
                </div>
                <div class="w3-col m5 l5 w3-margin-left">
                    <h3 class="w3-text-gray">Search Option</h3>
                    by name <input type="radio" name="searchmsg" class="w3-radio" value="text" id="">
                    by Date <input type="radio" name="searchmsg" class="w3-check" id="">
                </div>
            </div><br />
            <div class="w3-row w3-border w3-round">
                <button type="submit" class="w3-button w3-col w3-right w3-round" style="width: 50px;">
                    <i class="fa fa-search"></i></button>
                <div class="w3-col w3-center w3-padding w3-gray" style="width: 50px;">
                    <i class="fa fa-user"></i></div>
                <div class="w3-rest ">
                    <input type="text" name="searchinput" id="" class="w3-input" placeholder="@username or em@il">
                </div>
            </div>
        </form>
    </div>
    <div class="w3-margin w3-border w3-round w3-white">
        <div class="w3-container w3-text-gray">
            <h3>List Of All Users Registed</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
        </div>
        <table class="w3-table-all w3-hoverable w3-border-0">
            <thead>
                <tr class="w3-light-grey w3-text-gray">
                <th></th>
                <th>Full Name</th>
                <th>Compagny</th>
                <th>City/Country</th>
                <th>Grade</th>
                <th>Status</th>
                <th>From</th>
                <th class="w3-center">Control</th>
                </tr>
            </thead>
            <?php
                foreach($rows as $item){
                    if($item['avatar']!=null){
                        $profil="../".$item['avatar'];
                    }
            ?>
            <tr>
                <td>
                    <div class="w3-center w3-image">
                        <?php echo "<img src=\"$profil\" alt=\"\" class=\"profil-image w3-circle\">";?>
                    </div>
                </td>
                <td>
                    <?php echo "<div class=\"w3-medium\">".$item['fname']." ".$item['lname']."</div>";
                     echo"<div class=\"w3-small\">register on ".$item['dateregister']."</div>";?>
                </td>
                <?php echo "<td>".$item['company']."</td>
                            <td>".$item['city']."/".$item['country']."</td>
                            <td>".$item['grade']."</td>
                            <td>".$item['level']."</td>";
                    if($item['src']!=null){
                        echo "<td><i class=\"fa fa-facebook-square w3-xlarge w3-text-blue\"></td>";
                    }else{
                        echo "<td><i class=\"fa fa-chrome w3-xlarge w3-text-green\"></td>";
                    }                
                ?>
                <td class="w3-row">
                    <a class="w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-indigo  "><i class="fa fa-unlock"></i></a>
                    <?php echo "<a href=\"./profil.php?user=".$item['iduser']."\" class=\"w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-teal   \"><i class=\"fa fa-user\"></i></a>";
                    if($item['iduser']!==$_SESSION['iduser']){
                    echo "<a class=\"w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-red \" href=\"../controller/users.php?user=deleteItem&iduser=".$item['iduser']."\"><i class=\"fa fa-trash\"></i></a>";}?>
                </td>
            </tr>                        
            <?php
                }
            ?>                   
        </table>
    </div>
            
            
<?php
$contentpages = ob_get_clean();
include "./template.php";
?>