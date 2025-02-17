<?php
    session_start();
    ob_start();
    $title="Users";
    include_once "../class/users.php";
    include "../config/connection.php";
    include "./sessioncontrol.php";
    $user= new users($connexion);
    $rows=$user->getusers(null);
    $profil=null;

?>
  
    <div class="w3-margin w3-border w3-round w3-white">
        <div class="w3-container w3-text-gray">
            <div class="w3-bar" >
                <h3 class="w3-bar-item">List Of All Users Registed</h3> 
                <button type="submit" class="w3-button w3-bar-item w3-right w3-white"  onclick=" w3.toggleClass('#researchForm','w3-hide')">
                    <i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="w3-margin w3-hide" id="researchForm">
            <p class="w3-text-gray">Your research</p>
            <input type="text" style="width:30%;"  class="w3-input w3-border w3-round w3-animate-input" placeholder="Search for names.." oninput="w3.filterHTML('#usersList', '.useritem', this.value)">
        </div>
        <div class="w3-padding w3-border-bottom w3-margin-bottom " style="width:450px;">
            <form >
                <label class="w3-margin-left">All</label>
                <input type="radio" name="filterBy" id="" value="" class="w3-radio" onclick="w3.filterHTML('#usersList', '.useritem', this.value)" checked>
                <label class="w3-margin-left">Operatuer</label>
                <input type="radio" name="filterBy" id="" value="regular" class="w3-radio" onclick="w3.filterHTML('#usersList', '.useritem', this.value)">
                <label class="w3-margin-left">Contreleur</label>
                <input type="radio" name="filterBy" id="" value="admin" class="w3-radio" onclick="w3.filterHTML('#usersList', '.useritem', this.value)">
            </form>
        </div>
        <table class="w3-table-all w3-hoverable w3-border-0" id="usersList">
            <thead>
                <tr class="w3-light-grey w3-text-gray">
                <th></th>
                <th onclick="w3.sortHTML('#usersList','.useritem', 'td:nth-child(1)')"class="pointer">Full Name</th>
                <th onclick="w3.sortHTML('#usersList','.useritem', 'td:nth-child(2)')"class="pointer">Compagny</th>
                <th >City/Country</th>
                <th >Grade</th>
                <th>Status</th>
                <th>From</th>
                <th class="w3-center">Control</th>
                </tr>
            </thead>
            <?php
                foreach($rows as $item){
                    if($item['avatar']!=null){
                        $profil="../".$item['avatar'];
                    }else{
                        $profil = "../img/avatar/" . $item['sexe'].".png";
                    }
            ?>
            <tr class="useritem">
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
                            <td id=\"level\">".$item['level']."</td>";
                    if($item['src']!=null){
                        echo "<td><i class=\"fa fa-facebook-square w3-xlarge w3-text-blue\"></td>";
                    }else{
                        echo "<td><i class=\"fa fa-chrome w3-xlarge w3-text-green\"></td>";
                    }                
                ?>
                <td class="w3-row">
                    <button class="w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-indigo  "><i class="fa fa-unlock"></i></button>
                    <?php echo "<button onclick=\"gotopages('profil.php?user=".$item['iduser']."')\" class=\"w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-teal   \"><i class=\"fa fa-user\"></i></button>";
                    if($item['iduser']!==$_SESSION['iduser']){
                    echo "<button class=\"w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-red \"  onclick=\"getId(".$item['iduser'].",'users');w3.show('#deleteQ')\"><i class=\"fa fa-trash\"></i></button>"?>
                    <?php }?>
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