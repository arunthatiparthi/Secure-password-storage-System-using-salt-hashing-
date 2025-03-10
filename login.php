<?php
// require_once("connection.php");
session_start();
$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server, $username, $password, "salthashing");
if (!$con) {
    die("pk");
}
if (isset($_POST['mail']) && isset($_POST['password'])) {
    $email = $_POST['mail'];
    echo "<script type='text/javascript'> alert($email)</script>";
    $query = " select * from salt_hash where Name = (select name from signup where email='$email')";
    $result = mysqli_query($con, $query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salt hashing Web page</title>
    <script src="login.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="show.php" method="POST" id="searchForm">
                <div class="input-box">
                    <!-- <label id="email">Email</label> -->
                    <input name="mail" placeholder="Email" style="color: white;"required>
                </div>
                <div class="input-box">
                    <!-- <label >Password</label> -->
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot your password?</a>
                </div>
                <button type="submit" class="btn" id="submit">Login</button>

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
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const response = await fetch('/login', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const userData = await response.json();

                // Update the webpage with the fetched data
                document.getElementById('userData').textContent = `Welcome, ${userData.Name}! Email: ${userData.Hash}, Other Data: ${userData.otherData}`;
            } else {
                // Handle login failure
                console.error('Login failed');
            }
        });
    </script>


    <!-- <script>
    document.getElementById("searchForm").addEventListener("submit", function (event) {
     
        document.getElementById("searchForm").submit();
        window.location.href = "show.php";
    });
</script> -->
</body>

</html>