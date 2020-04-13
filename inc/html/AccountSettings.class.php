<?php

class AccountSettings
{

public static function accountsettings_html()
{?>

<!doctype html>

<!-- REFRENCES:
1. Boostrap card view:  https://getbootstrap.com/docs/4.0/components/card/
2. Profile images: https://www.shareicon.net/data/2016/07/05/791224_man_512x512.png , https://www.shareicon.net/data/2016/07/05/791224_man_512x512.png
-->
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<title>Hello, world!</title>
<style>
body{
background-color: #f3f3f3;
}

*{ 
list-style: none;
margin: 0;
padding: 0;
box-sizing: unset;

font-family: sans-serif;
}

.wrapper{
position: absolute;
top: 50%;
text-align: center;
left: 50%;
transform: translate(-50%,-50%); /*moves card from left to right*/
width: 1100px;

display: flex;
box-shadow: 0 1px 20px 0 rgba(69,90,100,.08);
}

.wrapper .left{
width: 35%;
background-color: #353c4e;
padding: 30px 25px;
height: 500px;
border-top-left-radius: 5px;
border-bottom-left-radius: 5px;
text-align: center;
color: #fff;
}

.wrapper .left img{
border-radius: 9px;
margin-bottom: 10px;
}



.wrapper .left p{
font-size: 12px;
}

.wrapper .right{
width: 65%;
background: #fff;
padding: 30px 25px;
border-top-right-radius: 5px;
border-bottom-right-radius: 5px;
}

.wrapper .right .info{
margin-bottom: 25px;
}

.wrapper .right .info h3,
.wrapper .right .projects h3{
margin-bottom: 15px;
padding-bottom: 5px;
border-bottom: 1px solid #e0e0e0;
color: #353c4e;
text-transform: uppercase;
letter-spacing: 5px;
}

input .editbtn
{
margin: 12px;
}

</style>  
</head>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<script>
function myFunction() {
var x = document.getElementById("hidediv");
if (x.style.display === "block") {
x.style.display = "none";
} else {
x.style.display = "block"; 
}
}
</script>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
<!-- <a class="navbar-brand" href="#">Country<img src="./res/images/cexchange.png" /></a> -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">
<!-- <?php 

if(!empty($_SESSION['username'])){?> -->
<li class="nav-item">
<a class="nav-link"><?php echo "Hello ".$_SESSION['username'] ?></a>
</li>
<!-- <?php } ?> -->
<li class="nav-item active">
<a class="nav-link" href="#">Home
<span class="sr-only">(current)</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Profile</a>
</li>

<li class="nav-item">
<form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<input type="hidden" id="action" name="action" value="<?php echo ACTION_SHOW_SIGNIN;?>">
<input type="submit" id="signbtn" class="btn btn-primary" value="Sign in/Register"/>
</form>
</li>
<li class="nav-item">
<form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<input type="hidden" id="action" name="action" value="<?php echo ACTION_SIGN_OUT;?>">
<input type="submit" id="signoutbtn" class="btn btn-secondary" value="Sign Out"/>
</form>
</li>
</ul>
</div>
</div>
</nav>

<div class="wrapper">
<div class="left">
<img src="https://greendestinations.org/wp-content/uploads/2019/05/avatar-exemple.jpg" 
alt="https://www.shareicon.net/data/2016/07/05/791224_man_512x512.png" width="100">
<h4>Full Name</h4>
<p></p>
</div>
<div class="right">
<div class="info">
<h3>Edit Profile</h3>
<div class="info_data">
<div class="data">
<!--    private $username;
private $email;
private $password;
private $name_first;
private $name_last;
private $name_full;
private $addressing;-->

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">abc</span>
</div>
<input type="text" class="form-control" placeholder="FirstName" aria-label="FirstName"
aria-describedby="basic-addon1">
</div>  

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">abc </span>
</div>
<input type="text" class="form-control" placeholder="LastName" aria-label="LastName"
aria-describedby="basic-addon1">
</div> 

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">@</span>
</div>
<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div> 
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">|^|</span>
</div>
<input type="text" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="basic-addon1">
</div> 
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">***</span>
</div>
<input type="password" class="form-control" placeholder="New Password" aria-label="Password" aria-describedby="basic-addon1">
</div>    
<input  class="btn btn-success" type="submit" value="Edit">
<input  class="btn btn-primary" type="submit" value="Go Back">
</div>
</div>
</div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php }

}
?>