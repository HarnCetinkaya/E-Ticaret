<?php
session_start(); 
require 'connection.php'; 

$productId = $_POST['productId']; // Formdan gelen ürün ID'sini alır
$quantity = $_POST['quantity']; // Formdan gelen ürün miktarını alır


$stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
$stmt->bind_param("i", $productId); // Sorguya ürün ID'sini parametre olarak bağlar
$stmt->execute(); 
$result = $stmt->get_result(); // Sonuçları alır
$row = $result->fetch_assoc(); // Sonuçları bir dizi olarak alır
$price = $row['price']; // Ürün fiyatını alır
$total = $price * $quantity; // Toplam fiyatı hesaplar


// Eğer aynı ürün sepette zaten varsa miktar ve toplam fiyatı günceller
$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, total) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity), total = total + VALUES(total)");
$stmt->bind_param("iiid", $userId, $productId, $quantity, $total); // Sorguya parametreleri bağlar: kullanıcı ID'si, ürün ID'si, miktar ve toplam fiyat
$stmt->execute(); 

$conn->close(); 
header('Location: Sepetim.php'); 
exit(); 
?>
