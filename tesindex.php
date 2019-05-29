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
 
//This conn blob file

    $connectionString = "DefaultEndpointsProtocol=https;AccountName=apayahstorage;AccountKey=l5SpvHYLpKnyEZgyGKA1vuMmmL18jAvZFxGBZPyPxcUB7s0e10yaqSDVauos596TmhjUYH4chpMGUxXvIpK1TA==";
    $containerName = "blobresep";
    // Create blob client.
    $blobClient = BlobRestProxy::createBlobService($connectionString);
 
// Processing form data when form is submitted
if (isset($_POST['submit']))
{

       try {

            $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
            $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
            // echo fread($content, filesize($fileToUpload));
            $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
    
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
            $ket = $_POST['ket'];
            $gambar = $_POST['gambar'];


        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, jenis, bahan, langkah, ket, gambar) 
                        VALUES (?,?,?,?,?,?)";


            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $jenis);
            $stmt->bindParam(3, $bahan);
            $stmt->bindParam(4, $langkah);
            $stmt->bindParam(5, $ket);
            stmt->bindParam(6, $gambar);

            $stmt->execute();

           
       } catch (Exception $e) {
           echo "Failed". $e;
       }
        echo "<h3>Your're registered!</h3>";

    
    

   
}
?>


 
<!DOCTYPE html>
<html lang="en">
	<?php include "head.php";?>
<head>
    <meta charset="UTF-8">
    <title>Create Recipe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
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
	
	<!-- Start Wrapper -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add recipe record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Nama</label>
                
                           <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
                <input type="submit" name="submit" value="Upload">
                
                        </div>


                        <div class="form-group">
                            <label>Nama</label>
				
                            <textarea type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></textarea>
                            <span class="help-block"><?php echo $nama_err;?></span>
			    
                        </div>
//
                        <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
                <input type="submit" name="submit" value="Upload">


			             <div class="form-group">
                            <label>Keterangan</label>
				
                            <textarea type="text" name="ket" class="form-control" value=""></textarea>
                            <span class="help-block"></span>
			    
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <textarea name="jenis" class="form-control"><?php echo $jenis; ?></textarea>
                            <span class="help-block"><?php echo $jenis_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bahan</label>
                            <textarea type="text" name="bahan" class="form-control" value="<?php echo $bahan; ?>"></textarea>
                            <span class="help-block"><?php echo $bahan_err;?></span>
                        </div>
			<div class="form-group">
                            <label>Langkah</label>
                            <textarea name="langkah" class="form-control"><?php echo $langkah; ?></textarea>
                            <span class="help-block"><?php echo $langkah_err;?></span>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
			<a href="menu.php" class="btn btn-default">Produk</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
