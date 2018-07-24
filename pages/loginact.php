<?php
session_start();
$error=''; // Variable pesan error
if (isset($_POST['submit'])) {
if (empty($_POST['nmpetugas']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Cari $username and $password
$username=$_POST['nmpetugas'];
$password=$_POST['password'];
$connection = mysql_connect("localhost", "root", "");
// Proteksi SQL Injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$db = mysql_select_db("klinik", $connection);

$query = mysql_query("SELECT * FROM dbpetugas WHERE password='$password' AND nmpetugas='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Inisial Session
header("location: index.php");
} else {
echo "<script>alert('Username dan Password Anda Salah!');window.location='login.php';</script>";
}
mysql_close($connection);
}
}
?>
