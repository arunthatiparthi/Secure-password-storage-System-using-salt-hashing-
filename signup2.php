<?php
   session_start();
   $server="localhost";
   $username="root";
   $password="";
   $con=mysqli_connect($server,$username,$password,"salthashing");
   if(!$con){
    die("pk");
   }

   if($_SERVER['REQUEST_METHOD']=="POST")
   {
       $email=$_POST['mail'];
       $password=$_POST['pass'];
       $name=$_POST['name'];
       if(!empty($email) && !empty($password) && !is_numeric($email) && !empty($name)){
           $query="select * from signup where email='$email' limit 1";
           $result=mysqli_query($con,$query);
           if($result){
               if($result && mysqli_num_rows($result)>0){
                   echo "<script type='text/javascript'> alert('User already exists')</script>";
                }
        else{
            echo "<script type='text/javascript'> alert('pk2')</script>";
        $query="insert into signup(name,email,password) values ('$name','$email','$password')";
        mysqli_query($con,$query);
        echo "<script type='text/javascript'> alert('successful')</script>";
        header("location:login.php");
        }
    }
    }
    else{
        echo "<script type='text/javascript'> alert('unsuccessful')</script>";

    }

   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="signup2-box">
            <h2>signup</h2>
            <form  method="POST">
                <div class="input-box">
                    <input type="Enter Name" name="name" required>
                    <label>Enter Name</label>
                </div>
                <div class="input-box">
                    <input type="email" name="mail" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="pass" required>
                    <label>Password</label>
                </div>
               <button type="submit" class="btn" >Signup</button>
                <div class="signup-link">
                    <a href="login.php">Login</a>
                </div>
            </form>
        </div>
        <span style="--i:0;"></span>
        <span style="--i:1;"></span>
        <span style="--i:2;"></span>
        <span style="--i:3;"></span>
        <span style="--i:4;"></span>
        <span style="--i:5;"></span>
        <span style="--i:6;"></span>
        <span style="--i:7;"></span>
        <span style="--i:8;"></span>
        <span style="--i:9;"></span>
        <span style="--i:10;"></span>
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:13;"></span>
        <span style="--i:14;"></span>
        <span style="--i:15;"></span>
        <span style="--i:16;"></span>
        <span style="--i:17;"></span>
        <span style="--i:18;"></span>
        <span style="--i:19;"></span>
        <span style="--i:20;"></span>
        <span style="--i:21;"></span>
        <span style="--i:22;"></span>
        <span style="--i:23;"></span>
        <span style="--i:24;"></span>
        <span style="--i:25;"></span>
        <span style="--i:26;"></span>
        <span style="--i:27;"></span>
        <span style="--i:28;"></span>
        <span style="--i:29;"></span>
        <span style="--i:30;"></span>
        <span style="--i:31;"></span>
        <span style="--i:32;"></span>
        <span style="--i:33;"></span>
        <span style="--i:34;"></span>
        <span style="--i:35;"></span>
        <span style="--i:36;"></span>
        <span style="--i:37;"></span>
        <span style="--i:38;"></span>
        <span style="--i:39;"></span>
        <span style="--i:40;"></span>
        <span style="--i:41;"></span>
        <span style="--i:42;"></span>
        <span style="--i:43;"></span>
        <span style="--i:44;"></span>
        <span style="--i:45;"></span>
        <span style="--i:46;"></span>
        <span style="--i:47;"></span>
        <span style="--i:48;"></span>
        <span style="--i:49;"></span>
    </div>
</body>
</html>