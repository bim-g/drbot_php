<?php
session_start();
ob_start();
$title = "Training";
include_once "../class/training.php";
include "../config/connection.php";
include "./sessioncontrol.php";
$train = new Training($connexion);
$rows = $train->getTopics(null);
?>
<div class="w3-light-gray w3-padding w3-row">
    <?php include "./control.php"; ?>
    <div class="w3-margin w3-border w3-round w3-white " id="showmsg">
        <div class="w3-container w3-text-gray w3-border-bottom">
            <a href="./topicTraining.php" class="w3-right w3-button w3-blue "><i class="fa fa-plus"></i></a>
            <h3>Diplay Topic Registered</h3>
            <div class="w3-padding">
                <input type="text" name="" id="" class="w3-input" placeholder="search" oninput="w3.filterHTML('#topiclist','.items',this.value)" style="width:50%;">
            </div>
        </div>
        <table class="w3-table-all w3-hoverable w3-border-0" id="topiclist">
            <thead>
                <tr class="w3-light-grey w3-text-gray">
                    <th>No</th>
                    <th class="w3-center">Topic Title</th>
                    <th>Link</th>
                    <th>Alert</th>
                </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($rows as $item) {
                echo "<tr class='items'>
                    <td style=\"width:50px;\">$i</td>
                    <td style=\"width:100%;\" class=\"w3-center\">" . $item['titletopic'] . "</td>                    
                    <td style=\"width:50px;\"><button class=\"w3-button w3-padding s4 m4 l4 w3-xlarge w3-text-green w3-padding\"><i class=\"fa fa-code-fork\"></i></button></td>                            
                    <td class=\"w3-row\" style=\"width:50px;\">
                        <button class=\"w3-button w3-padding s4 m4 l4 w3-xlarge w3-text-blue-gray \"  onclick=\"\"><i class=\"fa fa-bullhorn\"></i></button>              
                    </td>
                </tr>";
                $i++;
            }
            ?>
        </table>
    </div>
</div>
<?php
$contentpages = ob_get_clean();
include "./template.php";
?>