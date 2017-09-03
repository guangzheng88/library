<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<title>登录系统</title>
<!-- Custom Theme files -->
<link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<!--Google Fonts-->
<!-- <link href='http://fonts.useso.com/css?family=Roboto:500,900italic,900,400italic,100,700italic,300,700,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'> -->
<!-- <link href='http://fonts.useso.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'> -->
<!--Google Fonts-->
</head>
<body>
<div class="login">
    <h2>IDP教育集团图书仓库管理系统</h2>
    <div class="login-top">
        <h1>LOGIN FORM</h1>
        <form method="post" action="/Login/submit">
            <input type="text" name="username" value="" placeholder="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Id';}">
            <input type="password" name="password" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" placeholder="password">
            <div class="forgot">
                <a href="#" style="display:none;">forgot Password</a>
                <input type="submit" value="Login" >
            </div>
        </form>
    </div>
    <div class="login-bottom"  style="display:none;">
        <h3>New User &nbsp;<a href="#">Register</a>&nbsp Here</h3>
    </div>
</div>  
<div class="copyright">
    <p>Copyright &copy; 2017.Company name All rights reserved.<a target="_blank" href="#"></a> - More<a href="#" target="_blank" title="IDP教育集团">IDP教育集团</a></p>
</div>


</body>
</html>