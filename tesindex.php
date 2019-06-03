


 
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
<?php
    
require_once 'vendor/autoload.php';
require_once './random_string.php';
    
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
    
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
 
 //blob
    $connectionString = "DefaultEndpointsProtocol=https;AccountName=apayahstorage;AccountKey=l5SpvHYLpKnyEZgyGKA1vuMmmL18jAvZFxGBZPyPxcUB7s0e10yaqSDVauos596TmhjUYH4chpMGUxXvIpK1TA==;";
    $containerName = "blockblobsiuqbmh";
// Create blob client.
    $blobClient = BlobRestProxy::createBlobService($connectionString);
 
// Processing form data when form is submitted
if (isset($_POST['submit']))
{

    //sql
       try {
            $nama = $_POST['nama'];
            $gambar = $_POST['gambar'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
        $keterangan = $_POST['keterangan'];
        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, gambar, bahan, langkah, keterangan) 
                        VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $gambar);
            $stmt->bindParam(3, $bahan);
            $stmt->bindParam(4, $langkah);
        $stmt->bindParam(5, $keterangan);
            $stmt->execute();
           
       } catch (Exception $e) {
           echo "Failed". $e;
       }
        header("Location: tesmenu.php");

}
//Upload blob   

if (isset($_POST['submit2'])) {
        $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]).generateRandomString();
    $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
    
    $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
 $listBlobsOptions = new ListBlobsOptions();
      $listBlobsOptions->setPrefix("$fileToUpload");
      $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
      do{
          
            foreach ($result->getBlobs() as $blob)
            {
               
                $var = $blob->getUrl();
            
            }
        
            $listBlobsOptions->setContinuationToken($result->getContinuationToken());
        } while($result->getContinuationToken());
        echo "<br />";
 }

?>

    <!-- start: Page Title -->
    <div id="page-title">

        <div id="page-title-inner">

            <!-- start: Container -->
            <div class="container">

                <a href="https://pujiyulitomowebapp.azurewebsites.net/menu.php"><h2>Menu Makanan Buka Puasa</h2></a>

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
                        <h2>Tulis Resep</h2>
                    </div>
                        <p>Upload Gambar terlebih dahulu, lalu submit untuk menambahkan resep ke database</p>
            
                        
                    <form class="d-flex justify-content-lefr" action="tesindex.php" method="post" enctype="multipart/form-data">
                
                        <div class="form-group">
                            <label>Upload</label>
                            <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required=""> 
                            <input type="submit" name="submit2" value="Upload Gambar">
              
                
                        </div>
 
     
                    </form>

                       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                      <div class="form-group">

                        <label>Url gambar</label>
                        <textarea type="text" name="gambar" class="form-control" value="<?php echo $gambar; ?>" checked readonly><?php echo $var; ?></textarea>   
                    </div>   
                        <div class="form-group">
             
                            <label>Nama</label>
                              <textarea type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></textarea>
                
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
                
                       <div class="form-group">
                            <label>Keterangan</label>
                
                            <textarea type="text" name="keterangan" class="form-control" value="<?php echo $keterangan; ?>"></textarea>
                            <span class="help-block"><?php echo $bahan_err;?></span>
                
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">

                    </form>
                </div>
            </div>        
        </div>
    </div>

</body>
</html>
