<?php
 
	  include "dbconnection.php";

	  $UnitList getUnitRate($_GET['catagory']);
               foreach ($UnitList as $arr  )
				{
		  			foreach ($arr as $key => $keyValue)
		  			{
 		   				if($key == "Rate")
		   				{
  		  					echo $keyValue;
 		   				}
					}
		 		}


	function getUnitRate($Catagory)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM conversion WHERE Catagory = ?");
 		$statement->bind_param("s", $Catagory);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 
?>