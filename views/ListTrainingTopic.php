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
    <div class=" w3-row">
    <?php include "./control.php";?>
        <div class="w3-margin w3-border w3-round w3-white " id="showmsg">
            <div class="w3-container w3-text-gray w3-border-bottom">
                <button onclick="gotopages('topicTraining.php')" class="w3-right w3-button w3-blue "><i class="fa fa-plus"></i></button>
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
                    <td >".($item['statetopic']==1?'published':'edited')."</td>
                    <td >".$item['dateregister']."</td>                            
                    <td class=\"w3-row\">
                        <button class=\"w3-button w3-padding w3-xlarge w3-text-blue s4 m4 l4\" onclick=\"gotopages('addsolution.php?idtopic=".$item['idtopic']."&topic=".$item['titletopic']."')\"><i class=\"fa fa-plus\"></i></button>
                        <button class=\"w3-button w3-padding w3-xlarge w3-text-blue s4 m4 l4\" onclick=\"gotopages('topicTraining.php?training=detail&src=".$item['idtopic']."')\"><i class=\"fa fa-edit\"></i></button>
                        <button class=\"w3-button w3-padding s4 m4 l4 w3-xlarge w3-text-red \"  onclick=\"getId(".$item['idtopic'].",'training');w3.show('#deleteQ')\"><i class=\"fa fa-trash\"></i></button>              
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