<?php

require_once 'vendor/autoload.php';
    
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
 

 

$connectionString = "DefaultEndpointsProtocol=https;AccountName=apayahstorage;AccountKey=l5SpvHYLpKnyEZgyGKA1vuMmmL18jAvZFxGBZPyPxcUB7s0e10yaqSDVauos596TmhjUYH4chpMGUxXvIpK1TA==;";
$containerName = "blockblobsiuqbmh";
// Create blob client.
$blobClient = BlobRestProxy::createBlobService($connectionString);
if (isset($_POST['submit2'])) {
    $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
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

    }

elseif (isset($_POST['submit'])) {
    
    //sql
       try {
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];
            $keterangan = $_POST['keterangan'];
            $gambar = $_POST['gambar'];


        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, jenis, bahan, langkah, keterangan, gambar) 
                        VALUES (?,?,?,?,?,?)";


            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $jenis);
            $stmt->bindParam(3, $bahan);
            $stmt->bindParam(4, $langkah);
        $stmt->bindParam(5, $keterangan);
            $stmt->bindParam(6, $gambar);
            $stmt->execute();

           
       } catch (Exception $e) {
           echo "Failed". $e;
       }
        echo "<h3>Your're registered!</h3>";

    
    

 }


?>

<!DOCTYPE html>
<html lang="en">
   
<head>
    <meta charset="UTF-8">
    <title>Tulis Resep</title>


    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
</head>
<body>
    
  
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
                        <h2>Tulis Resep</h2>
                    </div>
                    <p>Please fill this form and submit to add recipe record to the database.</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">    
            <div class="form-group">
                            
                        <div class="form-group">
                            <label>Url</label>
                            <textarea name="jenis" class="form-control" checked readonly><?php echo $gambar; ?></textarea>
                      
                        </div>
                            
                            <label>Nama</label>
                            <textarea type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></textarea>
              
                
                        </div>
                
                   

                        <div class="form-group">
                            <label>Jenis</label>
                            <textarea name="jenis" class="form-control"><?php echo $jenis; ?></textarea>
                        
                        </div>
                        <div class="form-group">
                            <label>Bahan</label>
                            <textarea type="text" name="bahan" class="form-control" value="<?php echo $bahan; ?>"></textarea>
             
                        </div>
            <div class="form-group">
                            <label>Langkah</label>
                            <textarea name="langkah" class="form-control"><?php echo $langkah; ?></textarea>
               
                        </div>
                
             <div class="form-group">
                            <label>Keterangan</label>
                
                            <textarea type="text" name="keterangan" class="form-control" value="<?php echo $keterangan; ?>"></textarea>
               
                
                        </div>
                        <input type="submit" name="submit2" class="btn btn-primary" value="Submit">
                
                        <a href="menu.php" class="btn btn-default">Lihat Produk</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
