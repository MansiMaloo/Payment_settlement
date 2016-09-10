<?php
class DB {

	private $host;
	private $user;
	private $pass;
	private $db;
	private	$con;
	public function __construct($host, $user , $pass , $db) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
	}

	public function connect() {

		if(!empty($this->host) && !empty($this->user) && !empty($this->pass) && !empty($this->db) )	
			$this->con = mysqli_connect( $this->host, $this->user , $this->pass , $this->db );

		if (mysqli_connect_errno())
		{
		 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
		
		return TRUE;
	}
	public function closeConnection(){
		return mysqli_close($this->con);
	}

	public function runQuery($query){
		return mysqli_query($this->con,$query);
	}
}

?>
<script type="text/javascript">
	if(window.location.pathname == "/db.php")
	{	
		window.location='/index.php';			// To redirect if attempt made to directly access the file from browser
	}	
</script>	