<?php
    session_start();
    ob_start();
    $title="Topic Solution";
    include_once "../class/training.php";
    include "../config/connection.php";
    
    if(isset($_GET['training']) && !empty($_GET['training']) && $_GET['training']=="detailS" && is_integer($_GET['src'])){
        $train=new Training($connexion);
        $rows=$train->getSolutions($_GET['src']);
    }else{
        $train=new Training($connexion);
        $rows=$train->getSolutions(null);
    }
    
?>
    <div class="w3-light-gray w3-padding w3-row">
    <?php include "./control.php";?>
        
        <div class="w3-margin w3-border w3-round w3-white " id="showmsg">
            <div class="w3-container w3-text-gray w3-border-bottom">
                <a href="#" class="w3-bar-item w3-button w3-blue w3-right"><i class="fa fa-plus"></i></a>
                <h3>Topic Solution Registered</h3>
            </div>
            
            <table class="w3-table-all w3-hoverable w3-border-0">
                <thead>
                    <tr class="w3-light-grey w3-text-gray">
                        <th>No</th>
                        <th >Topic Name</th>                          
                        <th >Description</th> 
                        <th >Step</th> 
                        <th >Date Lastupdate</th> 
                        <th >Operations</th> 
                    </tr>
                </thead> 
                <?php
                    $i=1;
                    foreach($rows as $item){                
                echo "<tr >
                    <td >$i</td>
                    <td >".$item['titletopic']."</td>
                    <td >".$item['description']."</td>
                    <td >".$item['step']."</td>
                    <td >".$item['datelastupdate']."</td>                            
                    <td class=\"w3-row\">
                        <a class=\"w3-button w3-padding w3-xlarge w3-hover-text-yellow w3-col s6 m6 l6\"><i class=\"fa fa-heartbeat\"></i></a>
                        <a class=\"w3-button w3-padding w3-xlarge w3-text-red w3-col s6 m6 l6\"><i class=\"fa fa-trash\"></i></a>                        
                    </td>
                </tr>";
                 $i++;
                    }
                ?>        
            </table>
        </div>
    </div>
<?php
    $contentpages=ob_get_clean();
    include "./template.php";
?>