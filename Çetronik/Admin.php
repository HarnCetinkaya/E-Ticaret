<?php
include 'connection.php'; 

$action = isset($_POST['action']) ? $_POST['action'] : ''; 

if ($action == 'add') { // Eğer 'action' parametresi 'add' ise
    $productName = $_POST['productName']; // Formdan gelen ürün adını alır
    $productDescription = $_POST['productDescription']; // Formdan gelen ürün açıklamasını alır
    $productPrice = $_POST['productPrice']; // Formdan gelen ürün fiyatını alır
    $productImage = $_FILES['productImage']['name']; // Formdan gelen ürün resim dosyasının adını alır
    $target_dir = "uploads/"; // Resmin yükleneceği dizini belirler
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif'); // İzin verilen dosya türlerini tanımlar
    $file_extension = pathinfo($productImage, PATHINFO_EXTENSION); // Dosyanın uzantısını alır

    
    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('Hatalı dosya tipi. Sadece JPG, JPEG, PNG, & GIF dosyalarından birini kullanınız.'); window.location.href = 'Admin.html';</script>";
        exit; 
    }

    // Dosya adını güvenli hale getirir
    $safe_filename = preg_replace("/[^a-zA-Z0-9_-]/", "", pathinfo($productImage, PATHINFO_FILENAME));
    $new_filename = $safe_filename . '.' . $file_extension; // Yeni dosya adını oluşturur
    $target_file = $target_dir . $new_filename; // Hedef dosya yolunu oluşturur

    // Eğer yükleme dizini yoksa, dizini oluşturur
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Dosyayı yükleme işlemini gerçekleştirir
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        // SQL sorgusu ile ürünü veritabanına ekler
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$productName', '$productDescription', '$productPrice', '$new_filename')";

        
        if ($conn->query($sql) === TRUE) {
            $insertMessage = "Ürün başarıyla eklendi!"; 
        } else {
            $insertMessage = "Error: " . $sql . "<br>" . $conn->error; 
        }

        
        echo "<script>alert('$uploadMessage\\n$insertMessage'); window.location.href = 'Admin.html';</script>";
    } else {
        
        echo "<script>alert('Dosya yüklenirken hata oluştu..'); window.location.href = 'Admin.html';</script>";
    }
} elseif ($action == 'delete') { 
    $productId = $_POST['productId']; 
    $sql = "DELETE FROM products WHERE id = $productId"; 

    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ürün başarıyla silindi.');</script>"; 
    } else {
        
        echo "<script>alert('Ürün silinirken hata oluştu: " . $conn->error . "');</script>";
    }

    
    echo "<script>window.location.href = 'Admin.html';</script>";
}

$conn->close(); 
?>
