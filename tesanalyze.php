<?php
 //config file
   $host = "pujiyulitomowebappserver.database.windows.net";
    $user = "apayah90";
    $pass = "terserah90!";
    $db = "pujiyulitomowebapp";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	    echo "Berhasil koneksi";
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }  


		    $resep_id = $_GET['kd'];
		    echo $resep_id;

		
?>
<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<body>
    
<?php include "header.php"; ?>

	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">
 
			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-stats ico-white"></i>Analyze Gambar</h2>

			</div>
			<!-- end: Container  -->

		</div>	
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
				<a href="detailproduk.php?kd=<?php echo $data['kode'];?>" class="btn btn-lg btn-danger">Detail Resep</a>
			    <a href="tesanalyze.php?kd=<?php echo $data['kode'];?>" class="btn btn-lg btn-success">Analyze!</a> </div>
                    </div>
                </div>
                <?php   
                    }
              
              ?>
		</div>
	</div>
	<!-- end: Page Title -->


    <script type="text/javascript">
            $(document).ready(function () {
            // **********************************************
            // *** Update or verify the following values. ***
            // **********************************************
            // Replace <Subscription Key> with your valid subscription key.
            var subscriptionKey = "e5e2285734134c5fb6ec10377f644bed";
            // You must use the same Azure region in your REST API method as you used to
            // get your subscription keys. For example, if you got your subscription keys
            // from the West US region, replace "westcentralus" in the URL
            // below with "westus".
            //
            // Free trial subscription keys are generated in the "westus" region.
            // If you use a free trial subscription key, you shouldn't need to change
            // this region.
            var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
            // Request parameters.
            var params = {
                "visualFeatures": "Categories,Description,Color",
                "details": "",
                "language": "en",
            };
            // Display the image.
            var sourceImageUrl = "";
            document.querySelector("#sourceImage").src = sourceImageUrl;
            // Make the REST API call.
            $.ajax({
                url: uriBase + "?" + $.param(params),
                // Request headers.
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Content-Type","application/json");
                    xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subscriptionKey);
                },
                type: "POST",
                // Request body.
                data: '{"url": ' + '"' + sourceImageUrl + '"}',
            })
            .done(function(data) {
                // Show formatted JSON on webpage.
                $("#responseTextArea").val(JSON.stringify(data, null, 2));
                // console.log(data);
                // var json = $.parseJSON(data);
                $("#description").text(data.description.captions[0].text);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // Display error message.
                var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
                errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
                alert(errorString);
            });
        });
    </script>
	<!-- Wrapper -->
	<div id="wrapper" style="width:1020px; display:table;">
	<div id="jsonOutput" style="width:600px; display:table-cell;">

		<b>Response:</b>
		<br><br>
		<textarea id="responseTextArea" class="UIInput"
		style="width:580px; height:400px;" readonly=""></textarea>
	</div>
	<div id="imageDiv" style="width:420px; display:table-cell;">
		<b>Source Image:</b>
		<br><br>
		<img id="sourceImage" width="400" />
		<br>
		<h3 id="description">Loading description. . .</h3>
	</div>
</div>


</body>
</html>	
