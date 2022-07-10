<?php

session_start();
if (isset($_POST) & !empty($_POST)){
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] == $_SESSION['csrf_token']){
            $messages[] = "CSRF Token Validation Success";
        }
        else{
            $errors[] = "Problem with CSRF Token Verification";
        }
    }

    $max_time = 60*60*24;
    if(isset($_SESSION['csrf_token_time'])){
        $token_time = $_SESSION['csrf_token_time'];
        if(($token_time + $max_time) >= time()){
        }
        else{
            unset($_SESSION['csrf_token_time']);
            unset($_SESSION['csrf_token_time']);
            $errors[] = "CSRF Token Expired";
        }
    }

    if(empty($errors)){
        $messages[] = "Proceed with Next Steps";
    }
}
echo $token = md5(uniqid(rand(),true));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

print_r($_SESSION);