<?php
session_start();
require 'connection.php'; 


if (isset($_POST['action']) && $_POST['action'] == 'clearAll') {
    
    $stmt = $conn->prepare("DELETE FROM cart");
    
    if ($stmt->execute()) {
        echo 'Sepet başarıyla temizlendi!'; 
    } else {
        echo 'Sepet temizlenirken hata oluştu!'; 
    }

    
    $conn->close();
}
?>
