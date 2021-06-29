<?php
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});

$accountModel = new Account();
$id=$_GET['id'];

$item = $accountModel->getAccountById($id);

if(!empty($_FILES['photo']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['phone'])) {
    if (is_uploaded_file($_FILES['photo']['tmp_name']) && move_uploaded_file($_FILES['photo']['tmp_name'], 'public/images/' . time() . $_FILES['photo']['name'])){ 
    $photo = time() . $_FILES['photo']['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    if($accountModel->updateAccount($photo, $username, $password, $phone, $id)) {
        phpAlert(  "Update account " . $username . "sucessful"  );
        ?>
        <!-- --them thong bao khi dang ky thanh cong -->
        <script type="text/javascript">
        <!--
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
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
    <div class="container">

        <!-- Form thêm sản phẩm -->
        <h1>UPDATE A ACCOUNT</h1>
        <!--  -->
        <form action="updateAdmin.php?id=<?php echo $id; ?>"  method="post" enctype="multipart/form-data">
         <!-- Tao mot id san pham (an) -->
         <!-- <input type="hidden" name="id" value = "<php echo $item['id']?>"> -->
         <div class="form-group">
                <label for="photo"></label>
                <input type="file" name="photo" id="photo" required value="<?php echo $item['photo']?> ">
               <a href="#" value="<?php echo $item['photo']?>"></a>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required class="form-control"  aria-describedby="helpId" value="<?php echo $item['username']?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required class="form-control"  aria-describedby="helpId" value="<?php echo $item['password']?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"  aria-describedby="helpId" value="<?php echo $item['Phone']?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        <a href="./manageProducts.php"><button type="submit" class="btn btn-primary">Quay lại</button></a>
    </div>
</body>
</html>

