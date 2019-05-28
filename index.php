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
 
// Define variables and initialize with empty values
$nama = $jenis = $bahan = $langkah = "";
$nama_err = $jenis_err = $bahan_err = $langkah_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Validate nama
    $input_name = trim($_POST["nama"]);
    if(empty($input_name)){
        $name_err = "Masukan Nama ";
    } elseif(!filter_var(trim($_POST["nama"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nama_err = 'Silahkan masukan nama yang valid';
    } else{
        $nama = $input_name;
    }
    
    // Validate email
    $input_jenis = trim($_POST["jenis"]);
    if(empty($input_jenis)){
        $jenis_err = 'Silahkan masukan jenis masakan : Makanan / Sayuran / Buah buahan';     
    } else{
        $jenis = $input_jenis;
    }
    
    // Validate poin
    $input_bahan = trim($_POST["bahan"]);
    if(empty($input_bahan)){
        $bahan_err = "Silahkan Masukan bahan";     
    } 
    else{
        $bahan = $input_bahan;
    }
	
	// Validate badge
	$input_langkah = trim($_POST["langkah"]);
	if(empty($input_langkah)) {
		$telp_err = "Silahkan Masukan Langkah ";
    }
    
		else {
            $langkah = $input_langkah;
            
		}
	
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($jenis_err) && empty($bahan_err) && empty($langkah_err)){
     
       try {
        $database = new Config();
        $dba = $database->openConnection();

        //Prepare an insert statement
 
        // Insert data
            $sql_insert = "INSERT INTO Resep (nama, jenis, bahan, langkah) 
                        VALUES (?,?,?,?)";

         $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $bahan = $_POST['bahan'];
            $langkah = $_POST['langkah'];

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
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($jenis_err)) ? 'has-error' : ''; ?>">
                            <label>Jenis</label>
                            <textarea name="jenis" class="form-control"><?php echo $jenis; ?></textarea>
                            <span class="help-block"><?php echo $jenis_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($bahan_err)) ? 'has-error' : ''; ?>">
                            <label>Bahan</label>
                            <input type="text" name="bahan" class="form-control" value="<?php echo $bahan; ?>">
                            <span class="help-block"><?php echo $bahan_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($langkah_err)) ? 'has-error' : ''; ?>">
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
