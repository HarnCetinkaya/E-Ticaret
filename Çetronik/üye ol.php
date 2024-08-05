<?php
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




$sql = "INSERT INTO users (email, password) VALUES (?, ?)"; // Kullanıcı bilgilerini veri tabanına ekledik.


$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $email, $password); 
$stmt->execute(); 

if ($stmt->affected_rows > 0) {
  echo "Yeni kayıt başarıyla oluşturuldu."; 
} else {
  echo "Hata: " . $stmt->error; 
}

$stmt->close(); 
$conn->close(); 
?>
