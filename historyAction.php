<?php
	  	function getAllinfo()
		 {
	 		$conn = connect();  
	 		$statement = $conn->prepare("SELECT * FROM history");
			$statement->execute(); 
			$records = $statement->get_result();
			return $records->fetch_all(MYSQLI_ASSOC); 
		}

		function getCatagory($Catagory)
		 {
	 		$conn = connect();  
	 		$statement = $conn->prepare("SELECT * FROM conversion WHERE Catagory = ?");
	 		$statement->bind_param("s", $Catagory);
			$statement->execute(); 
			$records = $statement->get_result();
			return $records->fetch_all(MYSQLI_ASSOC); // associative array.
		} 



 

		if(empty(trim($_GET['catagory'])))
			{
				$allInfo = getAllinfo();			
			}
		 	
			else 
			{
				$allInfo = getCatagory($_GET['catagory']);
   			}
	 ?>