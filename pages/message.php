<?php
    session_start();
    ob_start();
    $title="Message";
?>
    <div class="w3-light-gray w3-padding w3-row">
        <div class="w3-bar">
            <button class="w3-button w3-bar-item w3-right" onclick="w3.toggleClass('#searchopt',' ','w3-hide',w3.toggleClass('#iconbtn',' fa-close w3-text-red','fa-search'))"><i class="fa fa-search" id="iconbtn"></i></button>

        </div>
        <div class="w3-margin w3-padding w3-large-round w3-border w3-white w3-hide" id="searchopt">
            <form method="post">
                <div class="w3-row">

                    <div class="w3-col m5 l4 w3-border-right">
                        <h3 class="w3-text-gray">Display Option</h3>
                        unread <input type="radio" name="statemsg" class="w3-radio" value="0" id="">
                        read <input type="radio" name="statemsg" class="w3-radio" value="1" id="">
                        respond <input type="radio" name="statemsg" class="w3-radio" value="2" id="">
                    </div>
                    <div class="w3-col m6 l8 w3-margin-left">
                        <h3 class="w3-text-gray">Search Option</h3>
                        by text <input type="radio" name="searchmsg" class="w3-radio" value="text" id="">
                        by Date <input type="radio" name="searchmsg" class="w3-check" id="">
                    </div>
                </div><br />
                <div class="w3-row w3-border w3-round">
                    <button type="submit" class="w3-button w3-col w3-right w3-round" style="width: 50px;">
                        <i class="fa fa-search"></i></button>
                    <div class="w3-col w3-center w3-padding w3-gray" style="width: 50px;">
                        <i class="fa fa-user"></i></div>
                    <div class="w3-rest ">
                        <input type="text" name="searchinput" id="" class="w3-input">
                    </div>
                </div>
            </form>
        </div>
        <div class="w3-margin w3-border w3-round w3-white " id="showmsg">
            <div class="w3-container w3-text-gray w3-border-bottom">
                <h3>Recieved Messages</h3>
            </div>
            
            <table class="w3-table-all w3-hoverable w3-border-0">
                <!-- <thead>
                    <tr class="w3-light-grey w3-text-gray">
                    <th></th>
                    <th ></th>                          
                    <th ></th> 
                    </tr>
                </thead> -->
                <tr onclick="w3.addClass('#showmsg',' w3-col s7 l7 m7',w3.removeClass('#resmsg','w3-hide'));" >
                    <td >
                        <div class="w3-center w3-image">
                            <img src="../img/avatar/face-01.jpg" alt="" class="profil-image w3-circle">
                        </div>
                    </td>
                    <td >
                        <div class="w3-small w3-text-gray w3-right">12-04-2019</div>
                        <div class="w3-xlarge">Jill Smith</div>
                        <div class="w3-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                    </td>                            
                    <td ><a class="w3-button w3-padding w3-xlarge w3-text-red "><i class="fa fa-trash"></i></a>
                    </td>
                </tr>                        
                <tr>
                    <td>
                        <div class="w3-center w3-image">
                            <img src="../img/avatar/face-2.jpg" alt="" class="profil-image w3-circle">
                        </div>
                    </td>
                    <td>
                        <div class="w3-small w3-text-gray w3-right">12-04-2019</div>
                        <div class="w3-xlarge  ">Drake smith</div>
                        <div class="w3-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                    </td>                            
                    <td ><a class="w3-button w3-padding s3 l3 m3 w3-xlarge w3-text-red "><i class="fa fa-trash"></i></a>
                    </td>
                </tr>                
            </table>
        </div>
        <div class="w3-margin w3-border w3-round w3-white w3-hide w3-col s4 l4 m4 w3-animate-right" id="resmsg">
            <div class="w3-bar w3-text-gray w3-border-bottom">
                <button class="w3-bar-item w3-button w3-hover-white w3-large w3-hover-text-red w3-right" onclick="w3.removeClass('#showmsg',' w3-col s7 l7 m7',w3.addClass('#resmsg','w3-hide'));"><i class="fa fa-close"></i>
                </button>
                <h3 class="w3-bar-item ">Respond Message</h3>
            </div>
            <div id="readmsg" class="w3-animate-opacity">
                <div class="w3-padding">
                    <div class="w3-border-bottom">
                        <p>Name:<b>Jill Smith</b></p>
                        <p>From:anonymous@drbot.com</p>
                        <p>Objet:lorem ipsum</p>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, incidunt. Vitae labore deserunt quia expedita corporis possimus tenetur, ipsa commodi! Obcaecati quisquam rem officiis accusantium explicabo aliquid maiores similique perferendis?</p>
                </div>
                <div class="w3-bar w3-light-gray w3-border-top w3-padding">
                    <button class=" w3-bar-item w3-button w3-green w3-right" onclick="w3.addClass('#readmsg',' w3-hide',w3.removeClass('#respondmsg','w3-hide'));">Respond</button>
                </div>
            </div>
            <div id="respondmsg" class="w3-hide w3-animate-opacity">
                <form method="POST">
                    <div class="w3-padding">                                
                        Name:<input type="text" disabled class="w3-input" value="Jill Smith"/><br/>
                        To:<input type="text" disabled class="w3-input" value="anonymous@drbot.com"/><br/>
                        Objet:<input type="text" disabled class="w3-input" value="lorem ipsum"/><br/>                                
                        <textarea class="w3-input w3-round w3-border"></textarea>
                    </div>
                <div class="w3-bar w3-light-gray w3-border-top w3-padding">
                    <button type="submit" class="w3-button w3-bar-item w3-blue w3-right"> Send <i class="fa fa-send"></i></button>
                    <input type="reset" class=" w3-bar-item w3-button w3-red" onclick="w3.removeClass('#readmsg',' w3-hide',w3.addClass('#respondmsg','w3-hide'));" value="cancel"/>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php

    $contentpages=ob_get_clean();
    include "./template.php";
?>