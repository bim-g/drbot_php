<?php
    session_start();
    ob_start();
    $title="Security";
    include "./sessioncontrol.php";

?>
    <div class="" >   
        <div class="w3-container w3-padding" style="width:750px;">  
            <div class="w3-margin w3-white w3-round w3-border">
                <form method="POST" >
                    <div class="w3-blue w3-padding">
                        <h3>Confidentiality Profil</h3>  
                    </div>
                    <div class=" w3-padding">
                        <p class="w3-text-gray w3-large">Change Password</p>                          
                        <div class="">                            
                            <div class="">
                                <label class="w3-text-gray w3-small">ACTIVE PASSWORD</label><br>
                                <input type="password" class="w3-input w3-border w3-round">
                            </div>
                            <div class="">
                                <label class="w3-text-gray w3-small">NEW PASSWORD</label><br>
                                <input type="password" class="w3-input w3-border w3-round">
                            </div>
                            <div class="">
                                <label class="w3-text-gray w3-small">CONFIRM PASSWORD</label><br>
                                <input type="password" class="w3-input w3-border w3-round">
                            </div>
                        </div>
                    </div>
                    <div class="w3-bar w3-padding w3-light-gray w3-border-top">
                        <input type="submit" value="Update password" class="w3-button w3-bar-item w3-blue w3-round">
                    </div>                
                </form>
            </div>  
        </div>  
    </div>
<?php
    $contentpages=ob_get_clean();
    include "./template.php";
?>