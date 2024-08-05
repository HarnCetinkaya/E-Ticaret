<?php
session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Çetronik"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error); 
}

$email = $_POST['email']; // Formdan gelen email bilgisini alır
$password = $_POST['password']; // Formdan gelen şifre bilgisini alır


$sql = "SELECT * FROM users WHERE email = ? AND password = ?"; 
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $email, $password); 
$stmt->execute(); 
$result = $stmt->get_result(); 

$admin_email = "test@example.com"; 
$admin_password = "password"; 


if ($email == $admin_email && $password == $admin_password) {
    
    header("Location: Admin.html");
    exit(); 
} else {
    
    echo "Hatalı email ya da şifre. Tekrar deneyiniz.";
}

// Kullanıcı bilgilerini kontrol etme
if ($result->num_rows > 0) {
  
  $_SESSION['user_email'] = $email; 
  header("Location: anasayfa.php"); 
} else {
  
  echo "<script>alert('Hatalı kullanıcı adı veya şifre!'); window.location='login.html';</script>"; 
}

$stmt->close(); 
$conn->close(); 
?>
