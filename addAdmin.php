<?php
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
if(isset($_SESSION['usernameAdmin'])){
if(!empty($_FILES['photo']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['phone'])) {
    if (is_uploaded_file($_FILES['photo']['tmp_name']) && move_uploaded_file($_FILES['photo']['tmp_name'], 'public/images/' . time() . $_FILES['photo']['name'])){ 
    $accountModel = new Account();
    $photo = time() . $_FILES['photo']['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    if($accountModel->createAccount($photo, $username, $password, $phone)) {
        phpAlert(  "Account " . $username . " added successfully"  );
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
    }
}
}
}
else{
    header('Location: http://localhost:89/DoAn/accountAdmin');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<style>
    body{
        margin: 0;
    padding: 0;
    background-color: #ffd6d6;
    }
    h1{
        color: blue;    
        margin-left: 370px;
    }
</style>
    <div class="container">
        <!-- Xuất thông báo -->
        <?php
        if(!empty($notification)) {
        ?>
        <div class="alert alert-success" role="alert">
            <?php echo $notification; ?>
        </div>
        <?php
        }
        ?>

        <!-- Form thêm tai khoan -->
        <h1>CREATE A ACCOUNT</h1>
        <form action="addAdmin.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="photo"></label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control"  aria-describedby="helpId" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control"  aria-describedby="helpId" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"  aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        <a href="./manageAdmin.php"><button type="submit" class="btn btn-primary">Quay lại</button></a>
    </div>
</body>
</html>