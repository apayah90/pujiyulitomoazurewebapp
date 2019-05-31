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
if (isset($_POST['submit'])) {
    $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
    $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
    
    $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
 $listBlobsOptions = new ListBlobsOptions();
      $listBlobsOptions->setPrefix("$fileToUpload");
      $result = $blobClient->listBlobs($containerName, $listBlobsOptions);

      do{
          
            foreach ($result->getBlobs() as $blob)
            {
                echo $blob->getUrl()."<br />";
                $var = $blob->getUrl();

            }
        
            $listBlobsOptions->setContinuationToken($result->getContinuationToken());
        } while($result->getContinuationToken());
        echo "<br />";
echo $var;
 }


     
/* This config file
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
*/
?>

<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://raw.githubusercontent.com/muhrizky/Smart-Parkir/master/parking_meter__2__Mrq_icon.ico">

    <title>Undip Smart Parkir</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>
<body>
            <form class="d-flex justify-content-lefr" action="analyze.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
                <input type="submit" name="submit" value="Upload">
            </form>
  </body>
</html>
