<?php
//require_once './config/database.php';
spl_autoload_register(function($class_name){
    require './app/models/' . $class_name . '.php';
});
session_start();
$id = $_GET['id'];
$productModel = new ProductModel();
$totalRow = $productModel->getTotalRow();
$perPage = 4;
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

$productList = $productModel->getProductsByPage($perPage, $page);
$item = $productModel->getProductById($id);
$CategoryModel = new CategoryModel();
$CategoryList = $CategoryModel->getCategory();
$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['product_name'];?></title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
    <div class="navbar">
                <div class="logo">
                <?php if(isset($_SESSION['username2'])) {?>
            <div class="row">
               <div class="col-md-3" style="padding-bottom: 5px;"><a href="./changePassword"><img src="./public/images/<?php echo $_SESSION['photo2']?>" style="width:60px;" alt="..."></a></div>
               <div class="col-md-4">Hello <?php echo $_SESSION['username2']?></div>
               <div class="col-2"> <a href="logoutIndex.php" style="background-color: red; color: white; padding: 5px;">Log out</a></div>
               <div class="col-md-3"></div>
            </div>
            <?php  }  
              else if(isset($_SESSION['usernameF'])||isset($_SESSION['usernameFR'])){
               ?>
               <div class="row">
               <div class="col-md-2"><a href="./changePassword"><img src="./public/images/f1.png" style="width:60px;" alt="..."></a></div>
               <div class="col-md-4">Hello <?php echo $_SESSION['name']?></div>
               <div class="col-md-2"> <a href="logoutIndex.php" class="btn btn-danger">Log_out</a></div>
               <div class="col-md-4"></div>
            </div>
               <?php
            }
            else {?> 
                    <a href="index.php"><img src="./public/images/logo.png" width="125px"></a>
                    <?php }?>
                </div>
                <nav>
                    <ul id="MenuItems">
                    <?php
                    foreach ($CategoryList as $value) {
                        
                    ?>
                    <li><a href="<?php echo $value['category_link']; ?>"><?php echo $value['category_name']; ?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                </nav>
            <a href="cart1.php"><img src="./public/images/cart.png" width="30px" height="30px"></a>
            <img src="./public/images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
    </div>
    </div>

    <!-- ---------- single Products detail ----------- -->

    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <?php $photos = explode(',',$item['product_photo']);?>
                <img src="./public/images/<?php echo $photos[0] ?>" width="100%" id="productImg">
                <div class="small-img-row">
                <?php
                foreach ($photos as $photo) {
                    
                ?>
                    <div class="small-img-rol">
                        <img src="./public/images/<?php echo $photo; ?>" width="100%" class="small-img">
                    </div>
                <?php
                    }
                ?>
                </div> 
            </div>
            <div class="col-2">
    
    <?php 
         $count=$item['product_view'];
         if(!isset($_SESSION['pro'])){
             $count++;
             $productModel->updateView($count, $item['id']);
             $_SESSION['pro']=$item['id'];
         }
         else{
             if($_SESSION['pro']!=$item['id']){
             unset($_SESSION['pro']);
             }
         }
    ?>

      <h5><i class="fa fa-street-view" aria-hidden="true">View: <?php echo $item['product_view']?></i></h5>
            
                <h1><?php echo $item['product_name']; ?></h1>
                <h4><?php echo number_format($item['product_price']); ?>$</h4>
                    <form action="cart1.php?action=add" method="post">
                    <select>
                    <option>Select Size</option>
                    <option>XXL</option>
                    <option>XL</option>
                    <option>Large</option>
                    <option>Medium</option>
                    <option>Small</option>
                    </section>
                    <input type="number" value="1" name="qty[<?php echo $item['id'];?>]">
                    <button class="btn" type="submit">Add to cart</button>
                    </form>
                    <h3>Product Detail
                        <i class="fa fa-indent"></i>
                    </h3>
                    <br>
                    <p><?php echo $item['product_description']; ?></p>
            </div>
        </div>
    </div>

    <!-- ----- title------------- -->
    <div class="small-container">
        <div class="row row2">
            <h2>Relate Products</h2>
        </div>
    </div>

<!-- ---------------Products----------------- -->
    <div class="small-container">

        <div class="row">
            <?php
                foreach ($productList as $value) {
                
            ?>
            <div class="col-md-3 col-4">
            <?php $photo = explode(',',$value['product_photo']);?>
                <a href="products_detal2.php?id=<?php echo $value['id']; ?>"><img src="./public/images/<?php echo $photo[0]; ?>"></a>
                <h4><?php echo $value['product_name']; ?></h4>
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
                <p><?php echo $value['product_price']; ?></p>
            </div>
            <?php
                }
            ?>
        </div>
        
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
                    <p>Our Purpose Is To Sustainably Make the Pleasure and
                        Benefits of Sports Accessible to the Many</p>
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
                }
                else {
                    MenuItems.style.maxHeight = "0px";
                }
            }

        </script>

<!-- ------------------- JS for  product gallery------------------------         -->
        <script>
            var ProductImg = document.getElementById("productImg");
            var SmallImg = document.getElementsByClassName("small-img");

            SmallImg[0].onclick = function()
            {
                ProductImg.src = SmallImg[0].src;
            }
            SmallImg[1].onclick = function()
            {
                ProductImg.src = SmallImg[1].src;
            }
            SmallImg[2].onclick = function()
            {
                ProductImg.src = SmallImg[2].src;
            }
            SmallImg[3].onclick = function()
            {
                ProductImg.src = SmallImg[3].src;
            }

        </script>
</body>

</html>