<?php
require_once("db_connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, hashed_password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION["user_id"] = $id;
        echo "<script>alert('Login successful!'); window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Invalid email or password!'); window.history.back();</script>";
    }
}
?>
