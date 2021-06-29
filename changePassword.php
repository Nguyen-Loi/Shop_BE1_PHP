<?php
//Tao session
session_start();
if(isset($_SESSION['username2'])){
    // header('Location: http://localhost:89:89/DoAn/manageAdmin');
}
spl_autoload_register(function($class_name){
    require './app/models/' . $class_name . '.php';
});
if (isset($_POST['password1'])&&!empty($_POST['password2']))  
{
    $p1 = $_POST['password1'];
    $p2 = $_POST['password2'];
    $accountModel = new Account();
    $accountList = $accountModel->getAccount();
    if($p1==$p2){
        //Xu ly cac loai tai khoan khi doi mat khau
        if(isset( $_SESSION['username2'])){
        if($accountModel->updatePassWord($p1,$_SESSION['username2'])){
            phpAlert("Password changed successfully"  );
            ?>
            <!-- --them thong bao khi dang ky thanh cong -->
            <script type="text/javascript">
            function delayer(){
                window.location = "http://localhost:89/DoAn/products";
            }
            //-->
            </script>
            </head>
            <body onLoad="setTimeout('delayer()', 0)">
            <?php
        }
        else{
            phpAlert( "Password change failed"  );
        }
    }
    else if(isset( $_SESSION['usernameF'])){
        if($accountModel->updatePassWord($p1,$_SESSION['usernameF'])){
            phpAlert("Password changed successfully"  );
            ?>
            <!-- --them thong bao khi dang ky thanh cong -->
            <script type="text/javascript">
            function delayer(){
                window.location = "http://localhost:89/DoAn/products";
            }
            //-->
            </script>
            </head>
            <body onLoad="setTimeout('delayer()', 0)">
            <?php
        }
        else{
            phpAlert( "Password change failed"  );
        }
    }
    else if(isset( $_SESSION['usernameFR'])){
        if($accountModel->updatePassWord($p1,$_SESSION['usernameFR'])){
            phpAlert("Password changed successfully"  );
            ?>
            <!-- --them thong bao khi dang ky thanh cong -->
            <script type="text/javascript">
            function delayer(){
                window.location = "http://localhost:89/DoAn/products";
            }
            //-->
            </script>
            </head>
            <body onLoad="setTimeout('delayer()', 0)">
            <?php
        }
        else{
            phpAlert( "Password change failed"  );
        }
    }
    else{
        phpAlert("Passwords are not the same"  );
    }
}
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
    crossorigin="anonymous">
    <!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/adminStyle.css">
</head>
<body>
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>

<div class="tit"><h3>Change password</h3></div><br><br>
        <div class="khung">
    <div class="container">
        <form action="changePassword.php" method="post" id="flogin">
            <div class="form-group">
                <label for="password1">New password</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="" aria-describedby="helpId" required>
            </div>

            <div class="form-group">
                <label for="password2">Cofirm password</label>
                <input type="password" name="password2" id="password2" class="form-control" placeholder="" aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-primary" value="login" name="login">Submit</button>
            <a href="products">Back</a>
        </form>
    </div>
        </div>
    <br>
  
    <script src="./public/js/admin.js"></script>
</body>
</html>