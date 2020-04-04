<?php
    session_start();
    $avatar="./img/avatar/face-0.jpg";
    if(isset($_SESSION['connexionStatus']) && $_SESSION['connexionStatus']=="ON"){
        if($_SESSION['avatar']!=null OR $_SESSION['avatar']!=""){
            $avatar=$_SESSION['avatar'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DorBot</title>
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/index.css">
    <script src="js/w3.js"></script>
    
</head>
<body>
    <div class="header w3-text-white" id="home">
        <div class="w3-bar">
            <div class="w3-right">                
                <a href="#" class="w3-btn w3-bar-item w3-round-xxlarge w3-white w3-margin" onclick="w3.show('#aboutus')">Abouts us</a>
            <?php if(isset($_SESSION['connexionStatus']) && $_SESSION['connexionStatus']=="ON"){ ?>
                <div class="w3-dropdown-hover w3-bar-item">
                    <?php echo "<img src=\"".$avatar."\" alt=\"\" class=\"profil-image w3-circle\">"; ?>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4 w3-rounf-large" style="right:0">
                        <button onclick="gotopages('dashboard.php')" class="w3-btn w3-bar-item" ><i class="fa fa-dashboard"> Dashboard</i></button>
                        <button onclick="gotopages('logout.php',1)" class="w3-btn w3-bar-item w3-text-red w3-light-gray w3-border-top" ><i class="fa fa-power-off w3-xlarge w3-margin-right"></i> Logout</button>
                    </div>
                </div>
            <?php }else{ ?>
                <button class="w3-btn w3-bar-item w3-round-xxlarge w3-white  w3-margin w3-text-red" onclick="w3.show('#login')">Login</button>
                <button class="w3-btn w3-bar-item w3-round-xxlarge w3-white  w3-margin w3-text-blue" onclick="w3.show('#registration')">Sign Up</button>
            <?php } ?>
            </div>
            
            <div class="w3-dropdown-hover w3-bar-item">
                <button class="w3-btn   w3-border-bottom "><i class="fa fa-bars"></i> Menu </button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="#contactUs" class="w3-btn w3-hover-text-green w3-bar-item" >Contact Us</a>
                    <a href="#" class="w3-btn w3-hover-text-green w3-bar-item">Term of use</a>
                </div>
            </div>
        </div>
        <div class="w3-center">
            <span class="title">dr bot</span>
            <span class="welcom">where ever you are</span>
        </div>
        <div class="w3-center btnStar">
            <a href="https://m.me/304271846878283" class="w3-btn w3-white w3-round-xxlarge w3-xlarge w3-hover-text-green btn-animated">Get Started</a>
            <a href="https://web.facebook.com/Drbot-304271846878283/" class="w3-button w3-round-xxlarge w3-padding w3-xlarge w3-white start w3-text-blue w3-hover-blue btn-animated-fb" ><i class="fa fa-facebook "></i></a>
        </div>
    </div>
    <div class="w3-row w3-margin">        
        <?php
            require './config/connection.php';
            require './class/training.php';

            $train=new Training($connexion);
            $topic = $train->randomtopic();

            foreach($topic as $item){
        ?>
        <div class="w3-col s6 l6 m6  " id="getstarted" >
            <div class="w3-card w3-margin">
                <div class="w3-black w3-padding">
                    <h3><?php echo $item['titletopic'];?></h3>
                </div>
                <img src="<?php echo $item['link'];?>" alt="demo picture" class="w3-image" style="width:100%;">
                <div class="w3-container">            
                    <p><?php echo $item['summary'];?></p>
                </div>
            </div>
        </div>
            <?php }?>
    </div>

<!-- contact us -->  
    <div class=" w3-container w3-padding contactUs ">
        <div class="w3-margin contactUsContent w3-light-gray w3-card w3-round" id="contactUs">
            <form method="POST" class="w3-padding " action="./controller/users.php">
                <h3>Contact Us</h3> 
                <input type="text" name="namesender" id="namesender" class="w3-input w3-border" placeholder="Enter Your name" require>
                <br/>
                <input type="email" name="emailsender" id="emailsender" class="w3-input w3-border" placeholder="Enter Email" require>
                <br/>
                <input type="text" name="objtmsg" id="objtmsg" class="w3-input w3-border" placeholder="Enter subject" require>
                <br/>
                <label class="w3-xlarge">Enter message</label><br/>
                <textarea name="contentmsg" id="contentmsg" cols="10" rows="5" class="w3-input w3-border w3-margin-bottom"></textarea>
                <button type="submit" class="w3-button w3-green" name="user" value="contact">Send Message <i class="fa fa-send"></i></button>
            </form>
        </div>
    </div> 
    <!-- modal connection -->
    <div class="w3-modal " id="login">
        <div class="w3-modal-content w3-card">
            <div class="w3-container w3-green w3-padding w3-center" >
                <span onclick="w3.hide('#login')" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <header class="w3-xlarge">Login</header>
            </div> 
            <div class="w3-center loginavtar"><br>
                <div class="w3-circle w3-light-gray  w3-padding w3-border" style="width: 100px;height:100px;">
                    <i class="fa fa-user-o w3-jumbo"></i>
                </div>
            </div>
            <form method="POST" action="controller/users.php">
                <div class="w3-margin">
                    <div class="w3-row w3-margin w3-light-gray w3-round-xxlarge">
                        <div class="w3-col w3-padding" style="width:50px;">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="w3-rest">
                            <input type="text" name="loginusername" id="loginusername" class="w3-input" placeholder="enter email" require>
                        </div>
                    </div>
                    <div class="w3-row w3-margin w3-light-gray w3-round-xxlarge">
                        <div class="w3-col w3-padding" style="width:50px;"><i class="fa fa-key"></i></div>
                        <div class="w3-rest">
                            <input type="password" name="loginpassword" id="loginpassword" class="w3-input" placeholder="enter password" require>
                        </div>
                    </div>
                </div>
                <div class="w3-bar w3-padding">
                    <button type="submit" class="w3-button w3-bar-item w3-green w3-right" name="user" value="connection">Connection</button>
                </div>
                <div class="w3-container  w3-light-gray w3-padding">
                    <a href="#" class=" w3-right" onclick="w3.hide('#login',w3.show('#registration'))">Don't have an account</a>
                    <button type="reset" class="w3-button w3-red" onclick="w3.hide('#login')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal About Us -->
    <div class="w3-modal" id="aboutus">
        <div class="w3-modal-content w3-card-4">
            <div class="w3-blue w3-container w3-padding">
                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright " onclick="w3.hide('#aboutus')">&times;</span>
                <header class="w3-center w3-xlarge">About us</header>
            </div>
            <div class="w3-padding">
                <h3>Introduction</h3>
                <p>Dr Bot is a chatbot application, witch assiste pacient to do their consultation online using messenger.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia nostrum sapiente, commodi qui dolore vel praesentium impedit beatae, cumque, nihil perspiciatis? Accusamus voluptates fugit impedit numquam? Minus tenetur culpa repellendus.</p>
                <p>
                This App hase been develloped by </p>
                <div class="w3-row w3-center">
                    <div class="w3-col s6 m6 l6">
                        <img src="img/avatar/face-1.jpg" alt="" class="about-image w3-circle" >
                        <p class="w3-xlarge w3-text-blue">Ibrahim Mussa Boss</p>
                    </div>
                    <div class="w3-col s6 m6 l6 ">
                        <img src="img/avatar/face-01.jpg" alt="" class="about-image w3-circle" >
                        <p class="w3-xlarge w3-text-green">Nyanja Idriss Pacifique </p> 
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Registration -->
    <div class="w3-modal" id="registration">
        <div class="w3-modal-content w3-card-4">
            <form method="POST" action="./controller/users.php">
                <header class="w3-padding w3-green w3-border-bottom">
                    <h3>Registration</h3>
                </header>
                <div class="w3-padding ">                
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="text" name="fname" id="fname" class="w3-input " placeholder="First Name">
                        </div>
                    </div>                            
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="text" name="lname" id="lname" class="w3-input " placeholder="Last Name">
                        </div>
                    </div>                            
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="date" name="birthday" id="birtday" class="w3-input " placeholder="Birthday">
                        </div>
                    </div>                            
                    <div class="w3-row w3-border-bottom w3-margin-bottom">
                        <div class="w3-padding"><i class="fa fa-intersex w3-text-blue w3-xlarge"></i> Sexe</div>
                        <div class="w3-col  s6 w3-padding">
                            Male <i class="fa fa-male w3-xlarge"></i> <input type="radio" value="male" name="sexe" class="w3-radio" required>
                        </div>
                        <div class="w3-col  s6 w3-padding">                               
                            Female <i class="fa fa-female w3-xlarge"></i> <input type="radio" value="female" name="sexe" class="w3-radio" required>
                        </div>
                    </div>                                                        
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="phone" name="phonenumber" id="phonenumber" class="w3-input " placeholder="Phone Number" required>
                        </div>
                    </div>
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="text" name="username" id="username" class="w3-input " placeholder="Enter your username" required>
                        </div>
                    </div>                            
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="email" name="email" id="email" class="w3-input " placeholder="Enter email" required>
                        </div>
                    </div>                            
                    <div class="w3-row w3-light-gray w3-round-xxlarge w3-margin-bottom">
                        <div class="w3-col w3-padding inputIcon">
                            <i class="fa fa-key"></i>
                        </div>
                        <div class="w3-rest">                                
                            <input type="password" name="password" id="password" class="w3-input " placeholder="password" required>
                        </div>
                    </div>                
                </div>
                <div class="w3-bar w3-padding ">
                    <button type="submit" class="w3-button w3-green w3-right " name="user" value="adduser">Register <i class="fa fa-legal w3-xlarge"></i></button>
                </div>
                <div class="w3-light-gray  w3-padding">
                    <a href="#" class="w3-right" onclick="w3.hide('#registration',w3.show('#login'))">I have a count</a>
                    <button type="reset" class="w3-button w3-red " onclick="w3.hide('#registration')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Erreur Connexion -->
    <?php
        if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            require './class/message.php';
            require './alert/danger.php';
        }
        // if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        //     require './class/message.php';
        //     require './alert/danger.php';
        // }
    ?>
    <!-- <div class="w3-modal" id="error">
        <div class="w3-modal-content w3-card-4">
            <p class="w3-text-red w3-jumbo">Error connexion</p>
        </div>
    </div> -->
    <div class="w3-border-top w3-light-gray w3-center w3-padding" style="position: relative;">
        <p class=""> <i class="fa fa-copyright w3-text-green w3-xlarge"></i> copyright DrBot <span id="mydate"></span></p>
        <a href="#home" class="w3-circle w3-gray btn-go-up w3-padding w3-border" ><i class="fa fa-angle-up w3-xxlarge w3-hover-text-green"></i></a>
    </div>
    <!-- bouton go up -->
    
    <script>
        
        w3.show('#errorModal');
        _();
        function changeCadre(val){
            _();
            w3.removeClass("."+val,'w3-hide')
        }
        function _(){
            w3.addClass('.controlHide','w3-hide');
        }
        //starting
        
        w3.getElements('#mydate')[0].innerHTML=new Date().getFullYear();
    </script>
    <script type="text/javascript" src="js/index.js"></script>
</body>
</html>