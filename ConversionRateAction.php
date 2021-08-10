
<?php

SetConversionRate($_GET['Catagory'],$_GET['Unit'],$_GET['Rate'])
function SetConversionRate($Catagory, $Unit, $Rate)
	{
		$conn = connect(); // from include dbconnection
		$statement = $conn->prepare("INSERT INTO  conversion (Catagory,Unit,Rate)VALUES(?,?,?)"); 
	 	$statement->bind_param("sid",$Catagory, $Unit, $Rate);
		return $statement->execute();
  	}

?>
