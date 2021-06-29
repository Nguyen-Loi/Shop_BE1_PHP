<?php
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
if(isset($_SESSION['usernameAdmin'])){
    $accountModel = new Account();

    $notifi='';
    if(isset($_POST['deleteAccount'])){
        //input
        $id= $_POST['id'];
        $accountModel->deleteAccount($id);
        header('Location: http://localhost:89/DoAn/manageAdmin');
    
        $notifi="Delete account successful";
    }
    $accountList = $accountModel->getAccount();

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
<div class="container">
        <div class="row" style="padding-top: 50px;">
           <div class="col-md-8"></div>
           <div class="col-md-1"><h4><?php echo $_SESSION['usernameAdmin']?></h4></div>
           <div class="col-md-3"><a href="logout.php" class="btn btn-danger" >Log_out</a></div>
        </div>        
</div>
<style>
    body{
        margin: 0;
    padding: 0;
    background-color: #ffd6d6;
    }
    h1{
        color: blue;    
        
    }
</style>
     
    <div class="container">
     <!-- Xuất thông báo -->
     
    

        <div class="row">
            <div class="col-6">
                <h1>Manage Account</h1>
            </div>
           
            <div class="col-6 text-right">
                <a href="addAdmin.php" class="btn btn-success" style="margin-top: 60px">CREATE ACCOUNT</a>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <td>ID</td>
                <td>Photo</td>
                <td>Username</td>
                <td>Password</td>
                <td>Phone</td>
            </thead>
            <?php
            foreach ($accountList as $item) {
            ?>
            <tr>
            
                <td><?php echo $item['id'] ?></td>
                <td><img src="./public/images/<?php echo $item['photo'] ?>" style="width:60px;" alt="..."></td>
                <td><?php echo $item['username'] ?></td>
                <td><?php echo $item['password'] ?></td>
                <td><?php echo $item['Phone'] ?></td>
                <!-- Get cua updatepAcount lay tu day -->
                <td><a href="updateAdmin.php?id=<?php echo $item['id'] ?>" class="btn btn-info">UPDATE</a></td>
           
                   <td><form action="manageAdmin.php" method="post" onsubmit = "return confirm ('Do you want delete account?')">
                    <input type="hidden" name="id" value=" <?php echo $item['id'] ?>">
                    <button type="submit" name="deleteAccount" class="btn btn-danger">DELETE</button>
                   </form>
           </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div class="container">
           <div class="row">
              <div class="col-md-6"><a href="./manageProducts"><button type="button" class="btn btn-primary btn-lg" style="margin-top: 10px" class="btn btn-info">Management product</button></a></div>
              <div class="col-md-6"><a href="./index"><button type="button" class="btn btn-primary btn-lg xyz" style="margin-top: 10px;">Home</button></a></div>

              
              <style>
               .xyz{
                margin-left: 284px;
               }
              </style>
           </div>
        </div>
        

    </div>
</body>
</html>