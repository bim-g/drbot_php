<?php
  $mssage=new Message();
  $message=$mssage->success($_SESSION['success']);
  $_SESSION['success']=null;
?> 
<div id="succesModal" class="w3-modal">
    <div class="w3-modal-content w3-card-4">
        <div class="w3-card-4">
        <header class="w3-container w3-green">          
        <h1><?php echo $message['type'];?></h1>
        </header>
        <div class="w3-container">
            <h1><?php echo $message['text'];?></h1>
        </div>
        <footer class="w3-container w3-center w3-padding w3-green">
            <button class="w3-btn w3-round w3-border" onclick="w3.hide('#succesModal')">Close</button>
        </footer>
        </div>
    </div>
</div>