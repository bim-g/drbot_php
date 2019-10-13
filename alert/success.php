<?php
  $message=success($_SESSION['sucess']);
  session_unset();
?> 
<div id="id01" class="w3-modal">
<div class="w3-modal-content w3-card-4">
    <div class="w3-card-4">
    <header class="w3-container w3-green">          
        <h1>Success</h1>
    </header>

    <div class="w3-container">
        <p>Lorem ipsum...</p>
    </div>

    <footer class="w3-container w3-center w3-padding w3-green">
        <button class="w3-btn w3-round w3-border" onclick="w3.hide('#id01')">Close</button>
    </footer>
    </div>
</div>
</div>
<script>
    (function(){
    w3.show('#id01');
    })();      
</script>