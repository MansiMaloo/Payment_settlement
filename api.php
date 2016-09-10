<?php 
	require_once('db.php');

	class FILE_HANDLER{
		
		public function putfile($name,$db,$set) {
			$db->connect();
			$handle = fopen("file/$name","r");

			$row = 0;
			while( $data = fgetcsv($handle,2000,",") ) {
				
				$row++;
				if($row == 1)
					$date1 = $data[0];
				if($row == 2)
					$date2 = $data[0];
				if( $row>2 ) {
					$data[0] = (int)$data[0]; 
					$data[5] = (float)$data[5];
					if( strtotime($date1)<strtotime($data[4]) && strtotime($data[4])<strtotime($date2) && $data[3] == 'OP' ) {
						
						$com = (($set->commission)/100)*$data[5];

						if( $data[1][0] == 'I' ) {
							$ser = (($set->servicetax2)/100)*$data[5];
						}else
						{

							$ser = (($set->servicetax1/100)*$data[5];
						}
						if( $data[2] == 'CN' ) {
							$data[5] = -$data[5];

						}
						$tamount = $data[5]-$com-$ser;
					    $query = "INSERT INTO `transactions`(id,vid,samount,commission,scharge,tamount) VALUES ($data[0],'$data[1]',$data[5],$com,$ser,$tamount)";
					    $result = $db->runQuery($query);
						if(!$result)
							echo "Error : 1";
					}	
				}
			}
			
			fclose($handle);
			$db->closeConnection();
			}

		public function getfile($db) {
			$db->connect();

			$query = "SELECT vid,SUM(samount),SUM(commission),SUM(scharge),SUM(tamount) FROM `transactions` GROUP BY vid";
		    $result = $db->runQuery($query);
			if(!$result)
				echo "Error : 2";
			$a = fopen("out.csv","w");
			$arr = array('VenueId', 'Net Settlement Amount', 'Commission', 'Service Charge', 'Net Transferred Amount');
			fputcsv($a, $arr);
			while ($row=mysqli_fetch_array($result)) {
					
				$arr = array($row[0],$row[1],$row[2],$row[3],$row[4]);

				fputcsv($a, $arr);
			}
			if(fclose($a)) {

				$query1 = "TRUNCATE TABLE `transactions`";
				$result1 = $db->runQuery($query1);
						if(!$result1)
						echo "Error : ";
			}

			$db->closeConnection();

			return "out.csv";
		}
	}

	class SETVALUE {

		public $servicetax1;
		public $servicetax2; 
		public $commission;

		public function __construct( $servicetax1 , $servicetax2, $commission )
		{
			$this->servicetax1 = $servicetax1;
			$this->servicetax2 = $servicetax2;
			$this->commission = $commission;
		}

	}
?>
<script type="text/javascript">
	if(window.location.pathname == "/api.php")
	{	
		window.location= '/index.php';			// To redirect if attempt made to directly access the file from browser
	}	
	</script>