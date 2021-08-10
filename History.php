 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>History</title>
	<script src="homeValidation.js"></script>
	<style>
		/*.center  {
			margin-top: 8%;
			display: flex;
			flex-direction: row;
			justify-content: center;
 		   }*/
		   h1{
		   	margin-top: 2%;
		   }
		   table, th, td {
		   	margin-top: 8%;
			border: 1px solid black;
			border-collapse: collapse;
			text-align: center;
			table-layout: auto;
			margin-left: auto;
	    	margin-right: auto;
	    	padding: 8px;
	    	font-size: 25px;

		}
	</style>
</head>
<body>
	<?php
	  include('header.html');
	  include "dbconnection.php";


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



		$allInfo = getAllinfo();


		if(empty(trim($_GET['catagory'])))
			{
				$allInfo = getAllinfo();			
			}
		 	
			else 
			{
				$allInfo = getCatagory($_GET['catagory']);
				$catagory = $_GET['catagory'];
  			}
	 ?>
	<h1>Page 3 [History]</h1>


	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" mathod = "GET" name="HistoryForm" onsubmit="return jsValid();">
 		<input type="text" name="catagory" value="<?php echo $catagory  ?>">
 		<input type="submit" name="search" value="Search" onclick="fetch()"><br><br><br>
 	</form>



	<table class="center">
		<tr>
			<th>ID</th>
			<th>Catagory</th>
			<th>Total Unit</th> 
			<th>Total Rate</th>
		</tr>

		 <?php

	 		foreach ($allInfo as $arr  )
			{
	  			foreach ($arr as $key => $value)
	  			{
	  				echo  "<td>".$value."</td>";
	   				if($key == "Rate")
	   				{
	  					echo"<tr>";
	   				}
				}
	 		}
		?>


	</table>
 	
</body>
</html>