<?php
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
if(isset($_SESSION['usernameAdmin'])){
if(!empty($_FILES['photo']) && !empty($_POST['product_name']) && !empty($_POST['product_description']) && !empty($_POST['product_price'])
&& !empty($_POST['product_rating'])) {
        //Xu ly khi upload 
        for ($i=0; $i < count($_FILES['photo']['tmp_name']); $i++) { 
            $folderPath = 'public/images/' . $_FILES['photo']['name'][$i];
            if (!is_uploaded_file($_FILES['photo']['tmp_name'][$i]) || !move_uploaded_file($_FILES['photo']['tmp_name'][$i], $folderPath)) {
                echo "upload failed";
                exit();
            }
        }
    $productModel = new ProductModel();
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productPhoto = implode(',', $_FILES['photo']['name']);
    $productRating = $_POST['product_rating'];
    //Kiem tra ten san pham co trung hay khong
    $productList=$productModel->getProduct();
    $count=0;
    foreach($productList as $item){
        if($productName==$item['product_name']){
            $count=2;
        }
    }
   if($count==0){
    if($productModel->createProduct($productName, $productDescription, $productPrice, $productPhoto, $productRating)) {
        phpAlert(  "Product " . $productName . " added successfully"  );
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
   else{
    phpAlert(  "Duplicate product name"  );
   }
    
}
}
else{
    header('Location: http://localhost:89/DoAn/accountAdmin.php');
  }
//   $time = new DateTime('now');
//   $today = date("d/m/Y");
//   var_dump($today); exit;

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
        <h1>CREATE A PRODUCTS</h1>
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
             <div class="form-group">
                <label for="product_name">Product name</label>
                <input type="text" name="product_name" id="product_name" class="form-control"  aria-describedby="helpId" required>
            </div>
            <div class="form-group">
                <label for="product_description">Product description</label>
                <input type="text" name="product_description" id="product_description" class="form-control"  aria-describedby="helpId" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"  aria-describedby="helpId" required>
            </div>
            <div class="form-group">
                <label for="photo"></label>
                <input type="file" name="photo[]" id="photo" multiple>
            </div>
            <div class="form-group">
                <label for="product_rating">Rating</label>
                <input type="text" name="product_rating" id="product_ratings" multiple class="form-control"  aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        <a href="./mangageProducts.php"><button type="submit" class="btn btn-primary">Quay lại</button></a>
    </div>
</body>
</html>