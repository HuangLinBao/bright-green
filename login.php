<?php session_start(); ?>
<?php require_once("./db.php"); ?>
<?php require_once("./essential.php"); ?>
<?php 
    $errFlag = null;
    $sql = null;
    if (isset($_POST['submit'])) {
        $user = trim($_POST['username']);
        $password = trim($_POST['pass']);
        $sql ="SELECT * FROM `accounts` WHERE `username` = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            ':username' => $user,
            
        ]);
        $count = $stmt -> rowCount();
        if ($count == 0) {
            $errFlag = true;
        }else if ($count > 1) {
            $errFlag = true;
        }else {
            $post = $stmt -> fetch(PDO::FETCH_ASSOC);
            $hashed_password = $post['user_password'];
            $user_name = $post['username'];
            $user_role = $post['role'];
            $user_full_name = $post['full_name'];
            if (password_verify($password,$hashed_password)) {
                console_log("success");
                $_SESSION['username'] = $user_name;
                $_SESSION['user_role'] = $user_role;
                $_SESSION['login'] ="success";
                $_SESSION['full_name'] = $user_full_name;
                header("Refresh:0.5;url =./dashboard.php");
            }else {
                $errFlag =true;
            }
        }
    }
    $sql = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5aca499382.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="loginUtil.css">
    <title>BG-Portal | login</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-b-160 p-t-50">
                <form class="login100-form validate-form" action="login.php" method="POST">
                    <span class="login100-form-title p-b-43">
						Account Login
					</span>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Username is required">
                        <input required class="input100" type="text" name="username">
                        <span class="label-input100">Username</span>
                    </div>


                    <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
                        <input required class="input100" type="password" name="pass">
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" name="submit" class="login100-form-btn">
							Sign in
						</button>
                    </div>

                    <div class="text-center w-full p-t-23">
                        <a href="#" class="txt1">
							Forgot password?
						</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>


(function ($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

})(jQuery);
</script>

</html>