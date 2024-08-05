<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çetronik Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="anasayfa.html">Çetronik</a>
       
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="anasayfa.php">Anasayfa</a>
            <a class="nav-item nav-link" href="Ürünler.php">Ürünler</a>
            <a class="nav-item nav-link" href="Hakkımızda.html">Hakkımızda</a>
            <a class="nav-item nav-link" href="Bize Ulaşın.html">İletişim</a>
            <a class="nav-item nav-link" href="Sepetim.php">Sepetim</a>
        </div>
    </nav>
		<div class="container mt-4">
			
			<h2>Ürünler</h2>
			<div class="row">
				<?php
					include 'connection.php'; 
					$sql = "SELECT * FROM products"; // Veritabanından tüm ürünleri seçtik
					$result = $conn->query($sql); 

					
					if ($result->num_rows > 0) {
						// Sonuç kümesindeki her satır için döngü
						while($row = $result->fetch_assoc()) {
							echo '<div class="col-md-3 mb-4">'; // Her ürün için bir sütun oluşturur
							echo '<div class="card">'; // Ürünü temsil eden kart div'i
							// Ürün resmini kartın üst kısmına ekler
							echo '<img class="card-img-top" src="uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
							echo '<div class="card-body">'; // Kartın gövdesini açar
							// Ürün adını kart başlığı olarak ekler
							echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
							// Ürün açıklamasını kart metni olarak ekler
							echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
							// Ürün fiyatını kart metni olarak ekler
							echo '<p class="card-text">Fiyat: ' . htmlspecialchars($row['price']) . ' TL</p>';

							// Sepete ekle formunu oluşturur
							echo '<form class="add-to-cart-form" action="Add_to_cart.php" method="post">';
							// Ürün ID'sini gizli alan olarak ekler
							echo '<input type="hidden" name="productId" value="' . $row['id'] . '">';
							// Adet seçimi için sayı girişi ekler
							echo '<input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px; margin-right: 10px;">';
							// Sepete ekle butonunu ekler
							echo '<button type="submit" class="btn btn-primary">SEPETE EKLE</button>';
							echo '</form>';

							echo '</div>'; 
							echo '</div>'; 
							echo '</div>'; 
						}
					} else {
						
						echo "<div class='alert alert-warning' role='alert'>Ürün bulunamadı. Yeni ürünler eklemeyi deneyin!</div>";
					}

					$conn->close(); 
				?>
			</div>
		</div>


    <footer class="footer bg-dark text-white pt-4 pb-4">
        <div class="footer">
            <div class="row">
                <div class="col-md-3">
                    <h5>Çetronik</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Biz Kimiz</a></li>
                        <li><a href="#">Kariyer</a></li>
                        <li><a href="#">İletişim</a></li>    
                        <li><a href="#">Güvenli Alışveriş</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kampanyalar</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Aktif Kampanyalar</a></li>
                        <li><a href="#">Hediye Fikirleri</a></li>
                        <li><a href="#">Çetronik Fırsatları</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Yardım</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Sıkça Sorulan Sorular</a></li>
                        <li><a href="#">Canlı Yardım</a></li>
                        <li><a href="#">Nasıl İade Edebilirim</a></li>
                        <li><a href="#">İşlem Rehberi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
    $(document).ready(function() {
        $('form.add-to-cart-form').submit(function(e) {
            e.preventDefault();  // Normal form gönderimini engelle

            var formData = $(this).serialize();  // Form verilerini al

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    alert("Ürün başarıyla sepete eklendi!");
                    
                },
                error: function() {
                    alert("Ürün sepete eklenirken bir hata oluştu.");
                }
            });
        });
    });
    </script>
</body>
</html>
