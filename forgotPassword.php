<?php
//Tao session

spl_autoload_register(function($class_name){
    require './app/models/' . $class_name . '.php';
});
if (isset($_POST['usernamex'])&&!empty($_POST['phone']))  
{
    $u = $_POST['usernamex'];
    $p = $_POST['phone'];
    $accountModel = new Account();
    // if($accountList = $accountModel->forgotPassWord($u,$p)){
    //     // phpAlert( 'Mat khau cua ban la: '  $accountList['password'] );
    //     var_dump($accountList['photo']);
    // }
    // else{
    //     phpAlert( "THAT BAI" );
    // }
    $count = 0;
    $accountList = $accountModel-> getAccount();
    foreach($accountList as $item){
        if($u==$item['username']&&$p==$item['Phone']){
            $username=$u;
            phpAlert( 'Your password is: '. $item['password'] );
            $count = 1;
            break;
        }
    }
    if($count==0) {
        phpAlert( 'Username or phone number incorrect');
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

<div class="tit"><h3>Forgot password</h3></div><br><br>
        <div class="khung">
    <div class="container">
        <form action="forgotPassword.php" method="post" id="flogin">
            <div class="form-group">
                <label for="usernamex">Username</label>
                <input type="text" name="usernamex" id="usernamex" class="form-control" placeholder="" aria-describedby="helpId" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="" aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-primary" value="login" name="login">Submit</button>
            <a href="index">Back</a>
        </form>
    </div>
        </div>
    <br>
  
    <script src="./public/js/admin.js"></script>
</body>
</html>