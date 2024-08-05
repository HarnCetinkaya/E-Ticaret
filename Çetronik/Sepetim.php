<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - Çetronik</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Sepetim.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="anasayfa.html">Çetronik</a>
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="anasayfa.php">Anasayfa</a>
            <a class="nav-item nav-link" href="Ürünler.php">Ürünler</a>
            <a class="nav-item nav-link" href="Hakkımızda.html">Hakkımızda</a>
            <a class="nav-item nav-link" href="Bize Ulaşın.html">İletişim</a>
            <a class="nav-item nav-link active" href="Sepetim.php">Sepetim</a>
        </div>
    </nav>
    
    <div class="container">
        <h2 class="my-4">Alışveriş Sepetim</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Fiyat</th>
                    <th>Miktar</th>
                    <th>Toplam</th>
                </tr>
            </thead>
<tbody>
    <?php
    session_start(); 
    require 'connection.php'; 
    $totalSum = 0;  

    
    $stmt = $conn->prepare("SELECT p.name, p.price, c.quantity, c.total FROM products p JOIN cart c ON p.id = c.product_id");
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    // Eğer sonuçta birden fazla satır varsa
    if ($result->num_rows > 0) {
        // Sonuç kümesindeki her satır için döngü
        while ($row = $result->fetch_assoc()) {
            // Ürün bilgilerini tablo satırı olarak ekler
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['price']) . " TL</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . number_format($row['total'], 3, '.', '') . " TL</td>
                  </tr>";
            $totalSum += $row['total'];  // Her ürünün toplamını toplam fiyata ekler
        }
    } else {
        
        echo '<tr><td colspan="4">Sepetiniz boş.</td></tr>';
    }
    $conn->close();
    ?>
</tbody>

<tfoot>
    <tr>
        <th colspan="3">Genel Toplam:</th>
        <th><?php echo number_format($totalSum, 3, '.', ''); ?> TL</th>  
    </tr>
</tfoot>
</table>
<button class="btn btn-danger" onclick="clearCart()">Sepeti Boşalt</button> 
<button class="btn btn-primary" onclick="checkout()">Ödeme Yap</button> 
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

<script>
   
    function clearCart() {
        if (confirm('Sepetinizi tamamen boşaltmak istediğinizden emin misiniz?')) { 
            $.ajax({
                url: 'remove_from_cart.php',  // PHP script'ine istek gönderir
                type: 'POST', // İstek türü POST
                data: { action: 'clearAll' },  // Tüm ürünleri silmek için bir parametre gönderir
                success: function(response) {
                    console.log('Response:', response); // Başarılı yanıtı konsola yazdırır
                    alert("Sepetiniz başarıyla boşaltıldı."); // Başarılı mesajını gösterir
                    location.reload();  
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Hata mesajını konsola yazdırır
                    alert("Bir hata oluştu, lütfen tekrar deneyin."); // Hata mesajını gösterir
                }
            });
        }
    }
</script>

<script>
    
    function checkout() {
        if (confirm('Ödeme yapmak istediğinizden emin misiniz?')) { 
            $.ajax({
                url: 'pay_to_cart.php',  // PHP script'ine istek gönderir
                type: 'POST', // İstek türü POST
                data: { action: 'clearAll' },  // Tüm ürünleri silmek için bir parametre gönderir
                success: function(response) {
                    console.log('Response:', response); // Başarılı yanıtı konsola yazdırır
                    alert("Ödemeniz başarıyla gerçekleştirilmiştir."); // Başarılı mesajını gösterir
                    location.reload();  
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Hata mesajını konsola yazdırır
                    alert("Bir hata oluştu, lütfen tekrar deneyin."); // Hata mesajını gösterir
                }
            });
        }
    }
</script>



	
	
	
</body>
</html>
