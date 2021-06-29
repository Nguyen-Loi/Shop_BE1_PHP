<?php
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
$productModel=new ProductModel();
$totalRow = $productModel->getTotalRow();
$perPage = 5;
$page = 1;
if(isset($_GET['page'])) 
{
    $page = $_GET['page'];
}
$productList = $productModel->getProductsByPage($perPage, $page);
if(isset($_SESSION['usernameAdmin'])){
if(isset($_POST['deleteProduct'])){
    //input
    $id= $_POST['id'];
    if($productModel->deleteProductById($id)){
    phpAlert(  "Delete this product successful"  );
    ?>
    <!-- --them thong bao khi dang ky thanh cong -->
    <script type="text/javascript">

    function delayer(){
        window.location = "http://localhost:89/DoAn/manageProducts.php";
    }
    //-->
    </script>
    </head>
    <body onLoad="setTimeout('delayer()', 0)">
    <?php
}
}
//$productList = $productModel->getProduct();
}
else{
    header('Location: http://localhost:89/DoAn/accountAdmin.php');
  }
  $pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
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
        
    }
</style>
<div class="container">
          <div class="row" style="padding-top: 50px;">
           <div class="col-md-8"></div>
           <div class="col-md-1"><h4><?php echo $_SESSION['usernameAdmin']?></h4></div>
           <div class="col-md-3"><a href="logout.php" class="btn btn-danger" >Log_out</a></div>
        </div>        
</div>
     <!-- Tao ham thong bao -->
     <?php
    function phpAlert($msg) {
       echo '<script type="text/javascript">alert("' . $msg . '")</script>';
   }
   ?>
   
    <div class="container">
     <!-- Xuất thông báo -->
        <div class="row">
            <div class="col-6">
                <h1>Manage Product</h1>
            </div>
            <div class="col-6 text-right">
                <a href="addProduct.php" class="btn btn-success" style="margin-top: 60px">CREATE PROCDUCT</a>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <td>ID</td>
                <td>Product photo</td>
                <td>Product name</td>
                <td>Product description</td>
                <td>Product price</td>
                <td>Product rating</td>
            </thead>
            <?php
            foreach ($productList as $item) {
            ?>
            <tr>
            
                <td><?php echo $item['id'] ?></td>
                <?php
                     $mainPhoto = explode(',',$item['product_photo']);
                ?>
                <td><img src="./public/images/<?php echo $mainPhoto[0];?>" style="width:60px;" alt="..."></td>
                <td><?php echo $item['product_name'] ?></td>
                <td><?php echo $item['product_description'] ?></td>
                <td><?php echo $item['product_price'] ?></td>
                <td><?php echo $item['product_rating'] ?></td>
                <!-- Get cua updatepAcount lay tu day -->
                <td><a href="updateProduct.php?id=<?php echo $item['id'] ?>" class="btn btn-info">UPDATE</a></td>
           
                   <td><form action="manageProducts.php" method="post" onsubmit = "return confirm ('Do you want delete this product?')">
                    <input type="hidden" name="id" value=" <?php echo $item['id'] ?>">
                    <button type="submit" name="deleteProduct" class="btn btn-danger">DELETE</button>
                   </form>
           </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php echo $pageLinks; ?>
        <div class="container">
           <div class="row">
              <div class="col-md-6"><a href="./manageAdmin"><button type="button" class="btn btn-primary btn-lg" style="margin-bottom: 30px" class="btn btn-info">Management account</button></a></div>
              <div class="col-md-6"><a href="./index"><button type="button" class="btn btn-primary btn-lg xyz" style="margin-bottom: 30px;">Home</button></a></div>
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