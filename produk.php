 
 <?php
 	//This Config FIle 
 	$host = "ASUS\SQLEXPRESS";
    $user = "root";
    $pass = "";
    $db = "pujidatabase";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    
    ?>


<!DOCTYPE html>
<html lang="en">
<?php include "head.php";?>
<body>
    
	<?php include "header.php"; ?>
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2>Menu Makanan Buka Puasa</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!--start: Container -->
    	<div class="container"> 
        <!--<div class="title"><h3>Keranjang Anda</h3></div>
            <div class="hero-unit">
            </div> -->            
      		<!-- start: Row -->
            
      		<div class="row">
	
				<?php
                 
                //diubah
                $sql = "SELECT * FROM Resep";
            	$stmt = $conn->query($sql);
            	
				
				if(count($data) == 0){
				
					echo "Tidak ada produk!";
				}
				
				else{
						while{ ($data = $stmt->fetchAll());
                    
                    ?>
        		<div class="span4">
          			<div class="icons-box">
                        <div class="title"><h3><?php echo $data['nama']; ?></h3></div>
                        <img src="admin/<?php echo $data['bahan']; ?>" style="border: 2px solid grey; border-radius: 5px; width: 250px; height: 200px;"/>
						<div><h3>Rp.<?php echo number_format($data['jenis'],2,",",".");?></h3></div>
					<!--	<p>
						
						</p> -->
						<div class="clear"><a href="detailproduk.php?hal=detailbarang&kd=<?php echo $data['kode'];?>" class="btn btn-lg btn-danger">Detail</a>  <a href="index.html" class="btn btn-lg btn-success">Beli &raquo;</a></div>

                    </div>
        		</div>
                <?php   
              }
              }
              
              ?>
<!---->
      		</div>
			<!-- end: Row -->
					
					
				</div>	
				
					
				</div>
				
			</div>
			<!--end: Row-->
	
		</div>
		<!--end: Container-->
				
		<!--start: Container -->
    	<div class="container">	
      		
			<hr>
		
			<!-- start Clients List	
			<div class="clients-carousel">
		
				<ul class="slides clients">
					<li><img src="img/logos/1.png" alt=""/></li>
					<li><img src="img/logos/2.png" alt=""/></li>	
					<li><img src="img/logos/3.png" alt=""/></li>
					<li><img src="img/logos/4.png" alt=""/></li>
					<li><img src="img/logos/5.png" alt=""/></li>
					<li><img src="img/logos/6.png" alt=""/></li>
					<li><img src="img/logos/7.png" alt=""/></li>
					<li><img src="img/logos/8.png" alt=""/></li>
					<li><img src="img/logos/9.png" alt=""/></li>
					<li><img src="img/logos/10.png" alt=""/></li>		
				</ul>
		
			</div>
			end Clients List -->
		
		
		
		</div>
		<!--end: Container-->	

	</div>
	<!-- end: Wrapper  -->			

  <?php
   $host = "ASUS\SQLEXPRESS";
    $user = "root";
    $pass = "";
    $db = "pujidatabase";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    if (isset($_POST['submit'])) {
        try {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];
            $notelp = $_POST['notelp'];
            // Insert data
            $sql_insert = "INSERT INTO Customers (nama, email, alamat, notelp) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $nama);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $alamat);
            $stmt->bindValue(4, $notelp);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Customers";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Daftar Nama Customer</h2>";
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr><th>Nama</th>";
                echo "<th>Email</th>";
                echo "<th>Alamat</th>";
                echo "<th>Notelp</th></tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['nama']."</td>";
                    echo "<td>".$registrant['email']."</td>";
                    echo "<td>".$registrant['alamat']."</td>";
                    echo "<td>".$registrant['notelp']."</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo " Failed conn: " . $e;
        }
    }
 ?>
<!-- start: Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.8.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.cslider.js"></script>
<script src="js/slider.js"></script>
<script def src="js/custom.js"></script>
<!-- end: Java Script -->

</body>
</html>	