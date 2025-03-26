
<?php
require_once("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $ps=$_POST["password"];
    // $password = password_hash($ps, PASSWORD_BCRYPT);
    $cmd=escapeshellcmd("python salting.py ". escapeshellarg($username). " " .escapeshellarg($email). " " .escapeshellarg($ps));
    
    $out=shell_exec($cmd);
    list($salt,$password)=explode(",",trim($out),2);
    $stmt = $conn->prepare("INSERT INTO users (username, email,salt, hashed_password) VALUES (?, ?,?, ?)");
    $stmt->bind_param("ssss", $username, $email,$salt, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: Could not register'); window.history.back();</script>";
    }
    // echo "<script>alert(" . json_encode($out) . "); window.location.href='login.html';</script>";
    // echo "<script>alert(" . json_encode($cmd) . "); window.location.href='login.html';</script>";
    // var_dump($out);
    // if(shell_exec($cmd)){
    // } else {
    //     echo "<script>alert('Error: Could not register'); window.history.back();</script>";
    // }
}
?>
