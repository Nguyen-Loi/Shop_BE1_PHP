<?php
session_start();
    include './Facebook/autoload.php';
    include('./fbconfig.php');
    spl_autoload_register(function($class_name){
        require './app/models/' . $class_name . '.php';
    });

$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

//Lấy thông tin của người dùng trên Facebook
try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,email', $accessToken->getValue());
    // var_dump($response);exit;

} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$user = $response->getGraphUser();
$accountModel = new Account();
$accountList = $accountModel->getAccount();
//Kiem tra tai khoan da ton tai hay chua -> Login
$username=NULL;
$_SESSION['name']=$user['name'];
foreach($accountList as $itemCustomer){
    if(($user['email']==$itemCustomer['username'])){   
        $_SESSION['usernameF']=$user['email'];
       
        break;
    }
    else{
        $_SESSION['usernameFR']=$user['email'];
    }
}
//Xu ly cac thong bao
if(isset($_SESSION['usernameF'])){
    phpAlert("Login with facebook successful");
    ?>
    <!-- --them thong bao khi dang ky thanh cong -->
    <script type="text/javascript">
    function delayer(){
        window.location = "http://localhost:89/DoAn/index";
    }
    //-->
    </script>
    </head>
    <body onLoad="setTimeout('delayer()', 0)">
    <?php
    exit;
}
if(isset($_SESSION['usernameFR'])){
    if($accountModel->createAccountWithFacebook($_SESSION['usernameFR'])){
        phpAlert("You have successfully logged in                                                             New Password: 12345 and Phone number:12345");
        ?>
        <!-- --them thong bao khi dang ky thanh cong -->
        <script type="text/javascript">
        function delayer(){
            window.location = "http://localhost:89/DoAn/index";
        }
        //-->
        </script>
        </head>
        <body onLoad="setTimeout('delayer()', 0)">
        <?php
    }
}


//Tao thong bao
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
