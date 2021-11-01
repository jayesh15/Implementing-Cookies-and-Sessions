<?php  
session_start();
if(isset($_SESSION["admin_name"]))
{
 header("location:home.php");
}
$connect = mysqli_connect("localhost", "root", "", "jayesh");  
if(isset($_POST["login"]))   
{  
 if(!empty($_POST["member_name"]) && !empty($_POST["member_password"]))
 {
  $name = mysqli_real_escape_string($connect, $_POST["member_name"]);
  $password = mysqli_real_escape_string($connect, $_POST["member_password"]);
  $sql = "Select * from admin_login where admin_name = '" . $name . "' and admin_password = '" . $password . "'";  
  $result = mysqli_query($connect,$sql);  
  $user = mysqli_fetch_array($result);  
  if($user)   
  {  
   if(!empty($_POST["remember"]))   
   {  
    setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
    $_SESSION["admin_name"] = $name;
   }  
   else  
   {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","");  
    }  
    if(isset($_COOKIE["member_password"]))   
    {  
     setcookie ("member_password","");  
    }
	$_SESSION["admin_name"] = $name;
   }  
   header("location:home.php"); 
  }  
  else  
  {  
   $message = "Invalid Login";  
  } 
 }
 else
 {
  $message = "Both are Required Fields";
 }
}  
 ?>  
<html>  
 <head>  
  <title>LOGIN</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <style>  
  body  
  {  
   margin:0;  
   padding:0;  
   background-color:#f1f1f1;  
  }  
        .box  
        {  
   width:700px;  
   padding:20px;  
   background-color:#fff;  
  }  
  </style>  
 </head>  
 <body>  
  <div class="container box">  
   <form action="" method="post" id="frmLogin"> 
    <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div>  
    <div class="form-group">  
     <label for="login">Username</label>  
     <input name="member_name" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="form-control" />  
    </div>  
    <div class="form-group">  
     <label for="password">Password</label>  
     <input name="member_password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="form-control" />   
    </div>  
    <div class="form-group">  
     <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />  
     <label for="remember-me">Remember me</label>  
    </div>  
    <div class="form-group">  
     <div><input type="submit" name="login" value="Login" class="btn btn-success"></span></div>  
    </div>   
   </form>  
   <br />  
  </div>  
 </body>  
</html>