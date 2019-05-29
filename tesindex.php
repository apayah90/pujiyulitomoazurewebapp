<?php

require_once 'vendor/autoload.php';
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

 $connectionString = "DefaultEndpointsProtocol=https;AccountName=apayahstorage;AccountKey=l5SpvHYLpKnyEZgyGKA1vuMmmL18jAvZFxGBZPyPxcUB7s0e10yaqSDVauos596TmhjUYH4chpMGUxXvIpK1TA==;";
$containerName = "blockblobsiuqbmh";
// Create blob client.
$blobClient = BlobRestProxy::createBlobService($connectionString);
if (isset($_POST['submit2'])) {
    $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
    $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
    // echo fread($content, filesize($fileToUpload));
    $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
}
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

 
// Processing form data when form is submitted
if (isset($_POST['submit']))
{
       try {


            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
            $keterangan = $_POST['keterangan'];
          
        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, jenis, bahan, langkah, keterangan) 
                        VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $jenis);
            $stmt->bindParam(3, $bahan);
            $stmt->bindParam(4, $langkah);
            $stmt->bindParam(5, $keterangan);
   

            $stmt->execute();
           
       } catch (Exception $e) {
           echo "Failed". $e;
       }
        echo "<h3>Your're registered!</h3>";
    
    
   
}

$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$result = $blobClient->listBlobs($containerName, $listBlobsOptions);
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
                
                            <textarea type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></textarea>
                            <span class="help-block"><?php echo $nama_err;?></span>
                
                        </div>
                        


                        <div class="form-group">
                            <label>Keterangan</label>
                
                            <textarea type="text" name="keterangan" class="form-control" value="<?php echo $keterangan; ?>"></textarea>
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
