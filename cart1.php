<?php
//require_once './config/database.php';
spl_autoload_register(function ($class_name) {
    require './app/models/' . $class_name . '.php';
});
session_start();
//Dieu kien muon su dung gio hang phai dang nhap
if(isset($_SESSION['username2'])||isset($_SESSION['usernameF'])||isset($_SESSION['usernameFR'])){
//$id = isset($_GET['id']) ? $_GET['id'] : '';
if (!isset($_SESSION["cart1"])) {
    $_SESSION["cart1"] = array();
}
$productModel = new ProductModel();
$CategoryModel = new CategoryModel();
$CategoryList = $CategoryModel->getCategory();
$error = false;
if (isset($_GET['action'])) {
    function updateCart($add = false)
    {
        foreach ($_POST['qty'] as $id => $qty) {
            if ($qty <= 0) {
                unset($_SESSION["cart1"][$id]);
                //var_dump($_SESSION["cart1"]); exit;
            } else {
                if ($add) {
                    $_SESSION["cart1"][$id] += $qty;
                } else {
                    $_SESSION["cart1"][$id] = $qty;
                }
            }
        }
    }
    switch ($_GET['action']) {
        case "add":
            updateCart(true);
            //var_dump($_SESSION["cart1"]); exit;
            header("Location: http://localhost:89/DoAn/cart1.php");
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION["cart1"][$_GET['id']]);
            }
            header("Location: http://localhost:89/DoAn/cart1.php");
            break;
        case "submit":
            if (isset($_POST['update_Click'])) {
                updateCart();
            } elseif (isset($_POST['order_Click'])) {
                if (empty($_POST['hoTen'])) {
                    $error = "Bạn chưa nhập họ tên";
                } elseif (empty($_POST['SDT'])) {
                    $error = "Bạn chưa nhập số điện thoại";
                } elseif (empty($_POST['diaChi'])) {
                    $error = "Bạn chưa nhập địa chỉ";
                } elseif (empty($_POST['qty'])) {
                    $error = "Giỏ hàng rỗng";
                }
                //var_dump($error);exit;
                if ($error == false && !empty($_POST['qty'])) {
                    $total = 200000;
                    $productOrderCart = $productModel->getOrderCart();
                    foreach ($productOrderCart as $item) {
                        $total += $item['product_price'] * $_POST['qty'][$item['id']];
                    }
                    // $productModel->createOrder($_POST['hoTen'],$_POST['SDT'],$_POST['diaChi'],$_POST['ghiChu'],$total,time(),time());
                    $con = new mysqli('localhost', 'root', '', 'sportsshop',3309);
                    $insert = mysqli_query($con,"INSERT INTO `order` (`id` ,`name`, `phone`, `address`, `note`, `total`, `create_time`, `last_update`) VALUES (NULL,'".$_POST['hoTen']."', '".$_POST['SDT']."', '".$_POST['diaChi']."', '".$_POST['ghiChu']."', '".$total."', '".time()."', '".time()."')");
                    $orderID = $con->insert_id;
                    $valueString = "";
                    foreach ($productOrderCart as $key => $value) {
                        $valueString .= "(NULL, '".$orderID."', '".$value['id']."', '".$_POST['qty'][$value['id']]."', '".$value['product_price']."', '".time()."', '".time()."')";
                        if($key != count($productOrderCart) - 1){
                            $valueString .= ",";
                        }
                    }
                    $insert = mysqli_query($con, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `create_time`, `last_update`) VALUES ".$valueString."");
                    header("Location: http://localhost:89/DoAn/ordercompelete.php");
                    unset($_SESSION['cart1']);
                }
            }
            break;
    }
}

if (!empty($_SESSION['cart1'])) {
    //var_dump(implode(",", array_keys($_SESSION["cart1"]))); exit;
    $productListCart = $productModel->getCart();
}
}
//Neu khong dang nhap thi se chuyen huong qua account
else{
    phpAlert(  "You must login to use shopping cart"  );
    ?>
    <!-- --them thong bao khi dang ky thanh cong -->
    <script type="text/javascript">
    function delayer(){
        window.location = "http://localhost:89/DoAn/account";
    }
    //-->
    </script>
    </head>
    <body onLoad="setTimeout('delayer()', 0)">
    <?php
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - SportStore</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>  
<style>.closexx{
         margin-left: 400px;
         margin-top: 40px
     } 
     img:hover {
  /* Start the shake animation and make the animation last for 0.5 seconds */
  animation: shake 0.5s;

  /* When the animation is finished, start again */
  animation-iteration-count: infinite;
}

@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}
     </style>
   <?php
   function phpAlert($msg) {
     echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
   ?>
    <div class="container">
        <?php if (!empty($error)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $error; ?>.<a href="javascript:history.back()"> Quay lại</a>
            </div>
        <?php } else { ?>
            <div class="navbar">
                <div class="logo">
                <?php if(isset($_SESSION['username2'])) {?>
            <div class="row">
               <div class="col-md-3"><a href="./changePassword"><img src="./public/images/<?php echo $_SESSION['photo2']?>" style="width:60px;" alt="..."></a></div>
               <div class="col-md-4">Hello <?php echo $_SESSION['username2']?></div>
               <div class="col-md-2"> <a href="logoutIndex.php" class="btn btn-danger">Log_out</a></div>
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
                   <?php }
            else{ ?>
            
                <a href="index.php"><img src="./public/images/logo.png" width="125px"></a>
            <?php } ?>
                   
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
                <a href="<?php echo "cart1.php"; ?>"><img src="./public/images/cart.png" width="30px" height="30px"></a>
                <img src="./public/images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>


            <!-- -----------------cart item details------------------- -->
            <form action="cart1.php?action=submit" method="post">
                <div class="small-container cart-page">
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php if (!empty($productListCart)) {
                            $total = 0;
                        ?>
                            <?php
                            foreach ($productListCart as $value) {

                            ?>
                                <tr>
                                    <td>
                                        <div class="cart-info">
                                        <?php $photo = explode(',',$value['product_photo']);?>
                                            <img src="./public/images/<?php echo $photo[0];?>">
                                            <div>
                                                <p><?php echo $value['product_name'] ?></p>
                                                <small>Price: <?php echo number_format($value['product_price']); ?>$</small>
                                                <br>
                                                <a href="cart1.php?action=delete&id=<?php echo $value['id']; ?>">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 40px;"><input type="text" name="qty[<?php echo $value['id']; ?>]" id="qty" value="<?php echo $_SESSION['cart1'][$value['id']] ?>"></td>
                                    <td><?php echo number_format($value['product_price'] * $_SESSION['cart1'][$value['id']]); ?>$</td>
                                </tr>
                            <?php
                            $total += $value['product_price'] * $_SESSION['cart1'][$value['id']];
                            }
                            ?>
                            <div class="total-price">
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>175,000$</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>25,00$</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?php echo number_format($total + 200000) ; ?>$</td>
                                    </tr>
                                </table>
                            </div>
                        <?php
                        }
                        ?>
                    </table>

                    <input style="width: 100px;" type="submit" name="update_Click" value="Update Cart" >

                    <div style="width: 400px; padding-left: 50px;"><label for="">Họ và tên</label> <input type="text" name="hoTen" value=""></div>
                    <div style="width: 400px;padding-left: 50px;"><label for="">số điện thoại</label> <input type="text" name="SDT" value=""></div>
                    <div style="width: 400px;padding-left: 50px;"><label for="">Địa chỉ</label> <input type="text" name="diaChi" value=""></div>
                    <div style="width: 400px;padding-left: 50px;"><label for="">Ghi chú</label> <textarea name="ghiChu" id="" cols="40" rows="5"></textarea></div>
                    <input type="submit" value="Đặt hàng" name="order_Click" style="width: 100px;">
                </div>
            </form>
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
        <?php } ?>

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