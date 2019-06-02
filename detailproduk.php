<?php
 // This config file
   $host = "pujiyulitomowebappserver.database.windows.net";
    $user = "apayah90";
    $pass = "terserah90!";
    $db = "pujiyulitomowebapp";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	    echo "Berhasil";
    } catch(Exception $e) {
        echo "Failed: " . $e;
    } ?>
<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
    
<?php include "header.php"; ?>
	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">
 
			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-stats ico-white"></i>Detail Menu Makanan</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	
      		<!-- start: Row -->
            
      		<div class="row">
            <div class="col-sm-6">
                    <?php
                    /* $sql_select = "SELECT * FROM Resep WHERE kode = '$_GET[kd]'";
                    $stmt = $conn->query($sql_select);
                    $data = $stmt->fetchAll();                  
*/
						?>
        		<!--<div class="span4">-->
          			<!--<div class="icons-box">-->
                    <div class="hero-unit"  style="margin-left: 200px;">
                    <table>
                    <tr>
                        <td rowspan="7"><img src="admin/<?php echo $data['gambar']; ?>" style="border: 2px solid grey; border-radius: 5px;" width="751" height="532" /></td>
                        </tr>

                        <!--<tr>
                        <td></td>
                        <td><h3>Satuan</h3></td>
                        <td><h3>:</h3></td>
                        <td><div><h3><?php //echo $data['br_satuan']; ?></h3></div></td>
                        </tr>-->
               

                               

                    </table>
                    </div>
                    <!--</div> -->
        		<!--</div> -->

      		</div>
		
					
				<!--end Row -->
				</div>	

				
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

    <!-- start: Footer Menu -->
	<div id="footer-menu" class="hidden-tablet hidden-phone">

		<!-- start: Container -->
		<div class="container">
			
			<!-- start: Row -->
			<div class="row">
				<table>
                    <tr>
         
                        </tr>
                        <tr>
                        <td colspan="4"><div class="title"><h2>"Nama"<br><br></h2></div></td>
                        </tr>
                        <tr>
                        <td></td>
                        <td size="200"><h3>Keterangan</h3></td>
                        <td><h3>:</h3></td>
						<td><div><h3><?php echo $data ["keterangan"]; ?></h3></div></td>
                        </tr>
                        <tr>
                        <td></td>
                        <td><h3>Bahan</h3></td>
                        <td><h3>:</h3></td>
                        <td><div><h3><?php echo $data ["bahan"]; ?></h3></div></td>
                        </tr>
                        <!--<tr>
                        <td></td>
                        <td><h3>Satuan</h3></td>
                        <td><h3>:</h3></td>
                        <td><div><h3><?php //echo $data['br_satuan']; ?></h3></div></td>
                        </tr>-->
                        <tr>
                        <td></td>
                        <td><h3>Langkah</h3></td>
                        <td><h3>:</h3></td>
                        <td><div><h3><?php echo $data['langkah']; ?></h3></div></td>
                        </tr>



                    </table>

			</div>
			<!-- end: Row -->
			
		</div>
		<!-- end: Container  -->	
</div>
</br>
</br>
</br>
</br>
			
	</div>	
	<!-- end: Footer Menu -->

    
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
