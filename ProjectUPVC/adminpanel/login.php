﻿<?php
include("../functions/function.php");
include("../functions/connect.php");
session_start();
if (isset($_POST['submit'])) {
    $Username = $_POST['UserName'];
    $Password = $_POST['Password'];
    if (!$Username == "" && !$Password == "") {
$sql = "SELECT `UserName`,`Password` FROM `admin_users` 
        WHERE `UserName`=? AND `Password`=?";
        $result = $conn->prepare($sql);
        $result->bind_param("ss", $Username, $Password);
        $result->execute();
        $result->store_result();
        $rows = $result->num_rows;
        if ($result->num_rows == 1) {
            $_SESSION['userlogin']=true;
			$_SESSION['level']=$rows['level'];
            header("location:index.php");
            exit();
        
        } else {
            echo "<script>alert('حساب کاربری با مشخصات وارد شده وجود ندارد')</script>";
        }
    } 
    else {
        if ($Username == "") {
            echo "<script>alert('نام کاربری نمی‌تواند خالی باشد')</script>";
            //Redirect("login.php");
        }
        if ($Password == "") {
             echo "<script>alert('رمزعبور نمی‌تواند خالی باشد')</script>";
            //Redirect("login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.html">
<title>ورود به پنل مدیریت</title>

<!-- Bootstrap core CSS -->
<link href="template/css/bootstrap.min.css" rel="stylesheet">
<link href="template/css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="template/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="template/css/style.css" rel="stylesheet">
<link href="template/css/style-responsive.css" rel="stylesheet" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries --> 
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>

<body class="login-body">
<div class="container">
  <form class="form-signin" method='post'>
    <h2 class="form-signin-heading">همین حالا وارد شوید</h2>
    <div class="login-wrap">
      <input name="UserName" type="text" class="form-control" placeholder="نام کاربری" autofocus>
      <input name="Password" type="password" class="form-control" placeholder="کلمه عبور">
      <label class="checkbox">
        <input type="checkbox" value="remember-me">مرا به خاطر بسپار
         <span class="pull-right"> <a href="#"> کلمه عبور را فراموش کرده اید؟</a></span> </label>
      <button name="submit" class="btn btn-lg btn-login btn-block" type="submit">ورود</button>
    </div>
  </form>
</div>
</body>
</html>
