<?php
	require_once( 'db.php' );
	require_once( 'api.php' );

	$host = "127.0.0.1";
	$user = "root";
	$pass = "";
	$db = "athleto";


	$servicetax1 = 5;
	$servicetax2 = 15; 
	$commission = 10;

	$db = new DB( $host, $user, $pass, $db );
	$yes = new FILE_HANDLER();
	$set = new SETVALUE( $servicetax1 , $servicetax2, $commission );
	

	if(( empty($_REQUEST["submit"]) )) {
	echo "<html>
		<head></head>
		<body>
		<form action='index.php' method='post' enctype='multipart/form-data'>
		<table align='center'>
		<tr><br><br><td>Select input csv file file:</td>
		<td><input type='file' name='browse'></td>
		</tr>
		<tr><td colspan=2 align='center'><br><br><input type='submit' value='Select' name='submit'></td></tr>
		</table>
		</form>
		</body>
		</html>";
	}	
	else {

		$r = move_uploaded_file($_FILES["browse"]["tmp_name"],"file/".$_FILES["browse"]["name"]);
		$a = $_FILES["browse"]["name"];
		
		$yes->putfile($a,$db,$set);

		$fname = $yes->getfile($db);

		echo "<h3 align='center'><br><br><a style='color:black;' href='$fname' download>Download the settlement report</a></h3>";
	}
?>