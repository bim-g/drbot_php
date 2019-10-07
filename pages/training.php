<?php
    session_start();
    ob_start();
    $title="Training";
    include_once "../class/training.php";
    include "../config/connection.php";    
    include "./sessioncontrol.php";
    $train=new Training($connexion);
    $rows=$train->getTopics(null);
?>
    <div class="w3-light-gray w3-padding w3-row">
    <?php include "./control.php";?>
        <a class="w3-margin w3-border w3-round w3-white " id="showmsg">
            <div class="w3-container w3-text-gray w3-border-bottom">
                <a href="./topic.php" class="w3-right w3-button w3-blue "><i class="fa fa-plus"></i></a>
                <h3>Diplay Topic Registered</h3>
                <div class="w3-padding">
                    <input type="text" name="" id="" class="w3-input" placeholder="search" oninput="w3.filterHTML('#topiclist','.items',this.value)" style="width:50%;">
                </div>
            </div>            
            <table class="w3-table-all w3-hoverable w3-border-0" id="topiclist">
                <thead>
                    <tr class="w3-light-grey w3-text-gray">
                    <th>No</th>
                    <th >Topic Title</th>                          
                    <th >Summary</th> 
                    <th >Questions</th> 
                    <th >Intent</th> 
                    <th >Owner</th> 
                    <th >State</th> 
                    <th >Date Register</th> 
                    <th >Operations</th> 
                    </tr>
                </thead> 
                <?php
                    $i=1;
                    foreach($rows as $item){                
                echo "<tr class='items'>
                    <td >$i</td>
                    <td >".$item['titletopic']."</td>
                    <td >".$item['summary']."</td>
                    <td >".$item['questions']."</td>
                    <td >".$item['intent']."</td>
                    <td >".$item['username']."</td>
                    <td >".$item['statetopic']."</td>
                    <td >".$item['dateregister']."</td>                            
                    <td class=\"w3-row\">
                        <a class=\"w3-button w3-padding w3-xlarge w3-text-blue w3-col s4 m4 l4\" href=\"./addsolution.php?idtopic=".$item['idtopic']."&topic=".$item['titletopic']."\"><i class=\"fa fa-plus\"></i></a>
                        <a class=\"w3-button w3-padding w3-xlarge w3-text-blue w3-col s4 m4 l4\" href=\"./topic.php?training=detail&src=".$item['idtopic']."\"><i class=\"fa fa-stethoscope\"></i></a>
                        <a class=\"w3-button w3-padding w3-xlarge w3-text-red w3-col s4 m4 l4\" href=\"../controller/training.php?training=delete&src=".$item['idtopic']."\"><i class=\"fa fa-trash\"></i></a>                        
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