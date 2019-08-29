<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/w3.css">
    <link rel="stylesheet" href="../style/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/index.css">
    <style></style>
    <title>Document</title>
</head>
<body>
    <div class="">
        <div class="w3-sidebar w3-bar-block w3-light-grey w3-card dasheader dash-side-menu" >
            <header class="top-bar w3-padding "><i class="fa fa-home w3-xxlarge"></i> <span class="w3-xxlarge">Dr Bot</span></header>
            <div class="w3-padding">
                <div class="w3-bar-block w3-text-white">
                    <div class="w3-bar-block w3-text-white ">
                        <a href="profil.html" class="w3-bar-item dasHover w3-round "><i class="fa fa-user-md w3-xlarge w3-margin-right"></i><span class="w3-center"> Profil</span></a>
                        <a href="list.html" class="w3-bar-item dasHover w3-round"><i class="fa fa-user w3-xlarge w3-margin-right"></i><span class="w3-center"> Notification</span></a>
                        <a href="message.html" class="w3-bar-item dasHover w3-round"><i class="fa fa-envelope w3-xlarge w3-margin-right"></i><span class="w3-center"> Message</span></a>
                        <a href="list.html" class="w3-bar-item dasHover w3-round "><i class="fa fa-address-card w3-xlarge w3-margin-right"></i><span class="w3-center"> List</span></a>
                        <a href="list.html" class="w3-bar-item dasHover w3-round"><i class="fa fa-user w3-xlarge w3-margin-right"></i><span class="w3-center"> Statistics</span></a>
                        <a href="training.html" class="w3-bar-item dasHover w3-round"><i class="fa fa-user w3-xlarge w3-margin-right"></i><span class="w3-center"> Training</span></a>
                        <a href="security.html" class="w3-bar-item dasHover w3-round active"><i class="fa fa-expeditedssl w3-xlarge w3-margin-right"></i><span class="w3-center"> security</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash-containt">
            <div class="w3-bar w3-white  top-bar" style="padding-right:20px;">
                <a href="#" class="w3-button w3-bar-item"><i class="fa fa-bars w3-xxxlarge"></i></a>
                <div class="w3-right"> 
                    <a href="./../index.html" class="w3-bar-item w3-text-blue btn w3-hover-text-red w3-large pointer">LogOut</a>
                    <div class="w3-bar-item w3-text-blue w3-large"> Ibrahim</div>
                    <img src="../img/avatar/face-1.jpg" alt="" class="profil-image w3-circle" >  
                </div>                
            </div>
            <div class="w3-light-gray w3-paddding" >   
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
                        <div class="w3-bar w3-padding w3-light-gray">
                            <input type="submit" value="Update password" class="w3-button w3-bar-item w3-blue w3-round">
                        </div>
                    
                </form>
            </div>  
            </div>
            <div class="w3-border-top w3-center" style="height: 50px;">
                <p class=""> <i class="fa fa-copyright w3-text-green w3-xlarge"></i> copyright DrBot <span id="mydate"></span></p>
            </div>
        </div>
    </div>
</body>
</html>