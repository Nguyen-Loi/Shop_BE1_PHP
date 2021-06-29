<?php
//require_once './config/database.php';
spl_autoload_register(function($class_name){
    require './app/models/' . $class_name . '.php';
});
$kq="";
if(empty($_POST['name']) == false)
{
    $name = $_POST['name'];
    
}
else
{
    echo 'Không Có Sản Phẩm';
    
}
$productModel = new ProductModel();
if($productList = $productModel->searchProduct($name)){
    $kq = "Kết quả tìm kiếm của sản phẩm có tên <h1 style= 'text-align: center; color: red;'>'$name'</h1>";
}
else {
    $kq = "Không tìm thấy sản phẩm có tên <h1 style= 'text-align: center; color: red;'>'$name'</h1>";
}
$CategoryModel = new CategoryModel();
$CategoryList = $CategoryModel->getCategory();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - SportStore</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="./public/images/logo.png" width="125px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                <?php
                    foreach ($CategoryList as $value) 
                    {                       
                    ?>
                    <li><a href="<?php echo $value['category_link']; ?>"><?php echo $value['category_name']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <a href="<?php echo "cart1.php"; ?>"><img src="./public/images/cart.png" width="30px" height="30px"></a>
            <img src="./public/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
    </div> 

    <div class="small-container">
    <h1 style="padding-top: 100px; text-align: center; "><?php echo $kq ?></h1>
        <div class="row row-2">
            <h2>All Products</h2>
        </div>
        <div class="row">
        <?php
            foreach ($productList as $value) {          
        ?>
            <div class="col-md-3 col-4">
            <?php $photo = explode(',',$value['product_photo']);?>
            <a href="products_detal.php?id=<?php echo $value['id']; ?>"><img class="img-fluid" src="./public/images/<?php echo $photo[0]; ?>"></a>
                <a href="#">
                    <?php if($name == $value['product_name']){ ?>
                    <h4 style="color: red;"><?php echo $value['product_name']; ?></h4>
                    <?php }else {?>
                        <h4><?php echo $value['product_name']; ?></h4>
                    <?php } ?>
                </a>
                <?php $today = new DateTime('now');
                      $created_at = date_create($value['created_at']);
                      if(date_diff($today, $created_at)->format('%d') <= 3)
                      echo '<span class="badge badge-danger">New</span>';
                ?>
                <div class="rating">
                <?php if($value['product_rating'] == 0) {?>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    <?php }?>
                    <?php if($value['product_rating'] == 1) {?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    <?php }?>
                    <?php if($value['product_rating'] == 2){?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    <?php }?>
                    <?php if($value['product_rating'] == 3){?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    <?php }?>
                    <?php if($value['product_rating'] == 4){?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    <?php }?>
                    <?php if($value['product_rating'] == 5){?>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    <?php }?>
                </div>
                <p><?php echo number_format($value['product_price']);?>$</p>
            </div>
        <?php
            }
        ?>       
    </div>
    <!-- ------------footer----------- -->

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone</p>
                    <div class="app-logo">
                        <img src="./public/images/play-store.png">
                        <img src="./public/images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="./public/images/logo-white.png">
                    <p>Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube </li>
                    </ul>
                </div>
        </div>
            <hr>
            <p class="Copyright">Copyright 2020 - By QuocHuy</p>
    </div>
        <!-- ------------------- js for toggle menu-------------- -->
        <script>
            var MenuItems = document.getElementById("MenuItems");

            MenuItems.style.maxHeight = "0px";

            function menutoggle() {
                if (MenuItems.style.maxHeight == "0px") {
                    MenuItems.style.maxHeight = "200px";
                } else {
                    MenuItems.style.maxHeight = "0px";
                }
            }
        </script>
</body>
</html>