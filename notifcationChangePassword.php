<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
phpAlert( "You must login to change your password" );
?>
<!-- --them thong bao khi dang ky thanh cong -->
<script type="text/javascript">

function delayer(){
    window.location = "http://localhost:89/DoAn/account.php";
}
//-->
</script>
</head>
<body onLoad="setTimeout('delayer()', 0)">
