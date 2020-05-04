<?php
    session_start();
    ob_start();
    $title="Notifications";
    $iduser=null;
    include_once "../class/users.php";
    include "../config/connection.php";

    if ($_SESSION['level']!="admin"){
        $iduser=$_SESSION['iduser'];
    }
    $workingon=null;
    $resolv=null;
    $user= new users($connexion);
    $rows=$user->getNotification($iduser);
    $profil="../img/avatar/face-0.jpg";
    $case = count($rows);
    function statecase($case){
        if($case==0){           
            return "Waiting";
        }
        elseif($case==1){           
            return "Working On";
        }
        elseif($case==2){
            return "Resolved";
        }
        elseif($case==-1){
            return "reject";
        }
    }

    function state($case){
        if($case=="Working On"){           
            return "disabled";
        }
        elseif($case=="Resolved"){
            return "disabled";
        }
        elseif($case=="Reject"){
            return "disabled";
        }
    }
?>
<script>activatemenu();</script>
    <div class="w3-margin w3-padding w3-large-round w3-border w3-white w3-hide" id="searchopt">
    </div>
    <div class="w3-margin w3-border w3-round w3-white">
        <div class="w3-container w3-text-gray">
            <h3>List Of All Users Registed</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
        </div>
        <table class="w3-table-all w3-hoverable w3-border-0">
            <thead>
                <tr class="w3-light-grey w3-text-gray">
                    <th>No</th>
                    <th>Pacients</th>
                    <?php
                        if ($_SESSION['level']=="admin"){
                            echo "<th>Doctor</th>";
                        }
                    ?>                    
                    <th>state Case</th>
                    <th>Date Assign</th>                
                    <th>operation</th>
                </tr>
            </thead>
            <?php
            $n=1;
                foreach($rows as $item){                    
            ?>
            <tr>                
                <td>
                    <?php echo "<div class=\"w3-medium\">$n</div>";?>
                </td>
                <td>
                    <?php echo "<div class=\"w3-medium\">".$item['pacient']."</div>";?>
                </td>
                <?php 
                    if ($_SESSION['level']=="admin"){
                        echo "<td>".$item['specialist']."</td>";
                    }
                    echo "<td>".statecase($item['statecase'])."</td><td>".$item['dateassign']."</td>";
                ?>
                <td class="w3-row">
                <?php 
                    if($item['statecase']==1 || $item['statecase']==2){
                        echo "<button class=\"w3-button w3-padding s6 l6 m6 w3-xlarge w3-text-green\" href=\"../controller/users.php?user=updatecase&type=WorkingOn&case=".$item['idcase']."\" ".state(statecase($item['statecase']))."><i class=\"fa fa-stethoscope\"></i></button>";
                    }else{
                    echo "<a class=\"w3-button w3-padding s6 l6 m6 w3-xlarge w3-text-green\" href=\"../controller/users.php?user=updatecase&type=WorkingOn&case=".$item['idcase']."\" ".state(statecase($item['statecase']))."><i class=\"fa fa-stethoscope\"></i></a>";
                }
                    if($item['statecase']==2){
                        echo "<button class=\"w3-button w3-padding s6 l6 m6 w3-xlarge w3-text-blue\" href=\"../controller/users.php?user=updatecase&type=Resolved&case=".$item['idcase']."\" ".state(statecase($item['statecase']))."><i class=\"fa fa-thumbs-up\" ></i></button>";
                    }else{
                    echo "<a class=\"w3-button w3-padding s6 l6 m6 w3-xlarge w3-text-blue\" href=\"../controller/users.php?user=updatecase&type=Resolved&case=".$item['idcase']."\" ".state(statecase($item['statecase']))."><i class=\"fa fa-thumbs-up\" ></i></a>";
                }
                ?>                  
                </td>
            </tr>                        
            <?php
                    $n++;
                }
            ?>                   
        </table>
    </div>
            
            
<?php
    $contentpages = ob_get_clean();
    include "./template.php";
?>