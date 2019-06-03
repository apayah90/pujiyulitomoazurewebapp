<?php
// This config file
   $host = "pujiyulitomowebappserver.database.windows.net";
    $user = "apayah90";
    $pass = "terserah90!";
    $db = "pujiyulitomowebapp";
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
            <!-- start: Row -->
            
            <div class="row">
                    <?php
                    $sql_select = "SELECT * FROM Resep";
                    $stmt = $conn->query($sql_select);
                    $datas = $stmt->fetchAll();
                    foreach($datas as $data) { 

                    ?>
                <div class="span4">
                    <div class="icons-box">
                        <img src="<?php echo $data['gambar']; ?>" style="border: 2px solid grey; border-radius: 5px; width: 250px; height: 200px;"  />
                        <div><h3><?php echo $data['nama']; ?></h3></div>
                    <!--    <p>
                        
                        </p> -->
			<div class="clear">
				<a href="detailproduk.php?kd=<?php echo $data['kode'];?>" class="btn btn-lg btn-danger">Detail Resep</a> ></div>
<a href="tesanalyze.php?kd=<?php echo $data['kode'];?>" class="btn btn-lg btn-success">Analyze!</a
                    </div>
                </div>
                <?php   
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
