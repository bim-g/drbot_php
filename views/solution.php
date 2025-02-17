<?php
    session_start();
    ob_start();
    $title="Topic Solution";
    include "./sessioncontrol.php";
    require "../controller/solutionCtrl.php";
    
?>
    <div class="w3-row">
    <?php include "./control.php";?>
        
        <div class="w3-margin w3-border w3-round w3-white " id="showmsg">
            <div class="w3-container w3-text-gray w3-border-bottom">
                <h3>Topic Solution Registered</h3>
                <div class="w3-padding">
                    <input type="text" name="" id="" class="w3-input" placeholder="search" oninput="w3.filterHTML('#topiclist','.items',this.value)" style="width:50%;">
                </div>
            </div>
            
            <table class="w3-table-all w3-hoverable w3-border-0" id="topiclist">
                <thead>
                    <tr class="w3-light-grey w3-text-gray">
                        <th>No</th>
                        <th >Topic Name</th>                          
                        <th >Description</th> 
                        <th class='pointer' onclick="w3.sortHTML('#topiclist', '.items', 'td:nth-child(4)')">Step <i class="fa fa-sort-numeric-asc"></i></th> 
                        <th >Date Lastupdate</th> 
                        <th >Operations</th> 
                    </tr>
                </thead> 
                <?php
                    $i=1;
                    foreach($result as $item){                
                echo "<tr class='items'>
                    <td >$i</td>
                    <td >".$item['titletopic']."</td>
                    <td >".$item['description']."</td>
                    <td >".$item['step']."</td>
                    <td >".$item['datelastupdate']."</td>                           
                    <td class=\"w3-row\">
                        <button class=\"w3-button w3-padding w3-xlarge w3-hover-text-yellow w3-col s6 m6 l6\" onclick=\"gotopages('addsolution.php?solution=".$item['idsolution']."')\"><i class=\"fa fa-edit\"></i></button>
                        <button class=\"w3-button w3-padding s4 m4 l4 w3-xlarge w3-text-red \"  onclick=\"getId(".$item['idsolution'].",'training');w3.show('#deleteQ')\"><i class=\"fa fa-trash\"></i></button>        
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