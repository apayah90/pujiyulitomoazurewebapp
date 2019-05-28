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
 

 
// Processing form data when form is submitted
if (isset($_POST['submit']))
{

       try {
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];


        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, jenis, bahan, langkah) 
                        VALUES (?,?,?,?)";


            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $jenis);
            $stmt->bindParam(3, $bahan);
            $stmt->bindParam(4, $langkah);

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
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
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
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <textarea name="jenis" class="form-control"><?php echo $jenis; ?></textarea>
                            <span class="help-block"><?php echo $jenis_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bahan</label>
                            <input type="text" name="bahan" class="form-control" value="<?php echo $bahan; ?>">
                            <span class="help-block"><?php echo $bahan_err;?></span>
                        </div>
			<div class="form-group">
                            <label>Langkah</label>
                            <textarea name="langkah" class="form-control"><?php echo $langkah; ?></textarea>
                            <span class="help-block"><?php echo $langkah_err;?></span>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
