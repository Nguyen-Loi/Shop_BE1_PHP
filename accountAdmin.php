<?php
//Tao session
session_start();
if(isset($_SESSION['username2'])){
    header('Location: http://localhost:89/DoAn/manageAdmin');
}
spl_autoload_register(function($class_name){
    require './app/models/' . $class_name . '.php';
});
if (isset($_POST['login'])&&!empty($_POST['username']) && !empty($_POST['password']))  
{
    //lay du lieu tu form goi len
    $u = $_POST['username'];
    $p = $_POST['password'];
  
    $accountModel = new Account();
    $accountListAdmin = $accountModel->getAccountAdmin();
    $level=0;
    foreach($accountListAdmin as $itemAdmin){
        if(($u==$itemAdmin['username'])&&($p==$itemAdmin['password'])){
            $level = 2;
            break;
      }
    }
    if($level==2){
        $_SESSION['usernameAdmin'] = $u;
        phpAlert(  "Hello " . $u  );
        ?>
        <!-- --them thong bao khi dang ky thanh cong -->
        <script type="text/javascript">
        function delayer(){
            window.location = "http://localhost:89/DoAn/manageAdmin";
        }
        //-->
        </script>
        </head>
        <body onLoad="setTimeout('delayer()', 0)">
        <?php
    } else {
        phpAlert(  "Incorrect account or password"  );
    }
}
else{
    
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

<div class="tit"><h3>Product Management</h3></div><br><br>
        <div class="khung">
    <div class="container">
        <form action="accountAdmin.php" method="post" id="flogin">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="" aria-describedby="helpId">
                <div class="invalid-feedback">Username is greater than 6 characters and contains no special characters</div>
                <!-- <small id="helpId" class="text-muted">Username bắt buộc nhập</small> -->
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                <div class="invalid-feedback">Password must be greater than 6 characters and must contain at least 1 uppercase letter and 1 numeric character</div>
                <!-- <small id="helpId" class="text-muted">Password bắt buộc nhập</small> -->
            </div>

            <button type="submit" class="btn btn-primary" value="login" name="login">Log in</button>
        </form>
    </div>
        </div>
    <br>
  
    <script src="./public/js/admin.js"></script>
</body>
</html>