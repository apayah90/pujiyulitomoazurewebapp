<html><html>
 <head>
 <Title>Registration Form</Title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
 <style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 6em; }
    h2 { font-size: 5.25em; }
    h3 { font-size: 3.6em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Register here!</h1>
  <a href="http://pujiyulitomowebapp.azurewebsites.net" class="btn btn-success pull-right">Tambah Pembeli Baru</a>
 <h3>Fill in your name and email address, then click <strong>Submit</strong> to register.</h3>
   <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>No.Telp</label>
                            <input type="text" name="notelp" class="form-control" id="notelp">
                            <span class="help-block"></span>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <input type="submit" name="load_data" class="btn btn-default"value="Load Data">
                    </form>
                </div>
            </div>        
        </div>
    </div>
 <?php
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
 </body>
 </html>
