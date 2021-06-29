<?php
session_start();
session_destroy();
header('Location: http://localhost:89/DoAn/accountAdmin.php');