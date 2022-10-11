<?php 
    require 'Links.php'; 

    # check if the user coming from A request
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        # Assign variables
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING );
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $cellphone = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);
        $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        # Creating array of errors
        $formErrors = array();

        if(strlen($username) < 3) {

            $formErrors[] = 'Username Must be larger than <strong>3</strong> Chars';
        }

        if(strlen($msg) < 10) {

            $formErrors[] = 'Message Must be larger than <strong>10</strong> Chars';
        }
    }

    // Check if no errors is exists and send Email
    // mail(To, Subject, Message, headers, Parameters)

    $myEmail = 'ayoubbellaoui37@gmail.com';
    $subject = 'Contact Form';
    $headers = 'From: ' . $email . '\r\n';

    if(empty($formErrors)) {

        mail($myEmail, $subject , $msg, $headers);
    }



?>
<html>
    <body>
        <div class="container">
            <h1 class="text-center">Contact Me</h1>
            <form class="contact-form" action="<?PHP echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <?php  if(!empty($formErrors)) { ?>
                <div class="alert alert-danger alert-dismissible " role="alert">
                <?php
                    foreach($formErrors as $error) {
                        echo $error . '</br>'; 
                    }
                ?>
                </div>
                <?php } ?>
                <div class="form-group">
                    <input 
                        class="form-control" id="CLuser"
                        type="text" name="username" 
                        placeholder="Type your Username"
                        value="<?php if(isset($username)) { echo $username; } ?>" required/>
                        <i class="fa-solid fa-user"></i>
                </div>
                <div class="form-group">
                    <input 
                        class="form-control" id="CLemail"
                        type="email" name="email" 
                        placeholder="please Type a valid email" 
                        value="<?php if(isset($email)) { echo $email; } ?>" required/>
                        <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="form-group">
                    <input 
                        class="form-control" id="CLphone"
                        type="text" name="cellphone" 
                        placeholder="Type your cell phone" 
                        value="<?php if(isset($cellphone)) { echo $cellphone; } ?>"/>
                        <i class="fa-solid fa-mobile"></i>
                </div>
                <div class="form-group">
                    <textarea 
                        class="form-control" id="CLmsg"
                        placeholder="Type a brief message for me!" 
                        name="message" required>
                        <?php if(isset($msg)) { echo $msg; } ?></textarea>
                </div>
                <div class="form-group">
                <input class="btn btn-dark btn-block" 
                type="submit" value="Send Message"/> 
                </div>
            </form>
        </div>
    </body>
</html>