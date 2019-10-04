<?
$GLOBALS['footer_text'] = 'BCS 2017 - all rights reserved';


function connectDB() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "eventvision";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	


		return $conn;

	
}

function getScreensNum( $evId=NULL) {
	
	$result = connectDB() ->query("SELECT count(*) as total from screens WHERE event_id='$evId'");
							while($row = $result->fetch_assoc()) {
								 return $row["total"];
							}
	
}
?>