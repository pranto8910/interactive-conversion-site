<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<script src="homeValidation.js"></script>
	<style>
		.center  {
			margin-top: 8%;
			display: flex;
			flex-direction: row;
			justify-content: center;
		   }
		   h1{
		   	margin-top: 2%;
		   }


		   table, th, td {
	    	padding: 8px;
	    	font-size: 25px;
		}
 	</style>
</head>
<body>
	<?php
	  include('header.html');
	  include "dbconnection.php";


	function getUnitRate($Catagory)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM conversion WHERE Catagory = ?");
 		$statement->bind_param("s", $Catagory);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 



	function setHistory($Catagory, $Unit, $Rate)
	{
		$conn = connect(); // from include dbconnection
		$statement = $conn->prepare("INSERT INTO  history (Catagory,Unit,Rate)VALUES(?,?,?)"); 
	 	$statement->bind_param("sdd",$Catagory, $Unit, $Rate);
		return $statement->execute();
  	}


  	function getAllCatagory()
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM conversion");
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); 
	}
	 
 
  $isValid = true;

  $value = "";
  $Catagory = "";
  $TotalValue = "";
   

  $valueErr = "";
  $CatagoryErr = "";
   


 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{
	 
            $value = $_POST['value'];
            $Catagory = $_POST['Catagory'];
             
             if(empty($value) || !is_numeric($value))
               {
                  $valueErr = "value can not be empty or non numeric.";
                  $isValid = false;
               }
             
             if(empty($Catagory))
               {
                  $CatagoryErr = "Catagory can not be empty.";
                  $isValid = false;
               }
             
 
            $value=basic_validation($value);     
            $Catagory = basic_validation($Catagory);
             
            

 
             if($isValid)
             {
                 $UnitList = getUnitRate($Catagory);
                 foreach ($UnitList as $arr  )
				{
		  			foreach ($arr as $key => $keyValue)
		  			{
 		   				if($key == "Rate")
		   				{
  		  					$TotalValue = $keyValue * $value * $arr["Unit"]; //for unit value in db.
  		  					setHistory($Catagory, $value*$arr["Unit"], $TotalValue);
 		   				}
					}
		 		}
              
                }


        
    }

     function basic_validation($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

    ?>


    					
 
	<h1>Page 1[Home]</h1>
  

	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST"  name="HomeForm" onsubmit="return jsValid();" >
		<table class="center">
			<tbody>
				<tr>
		           <td>Select Catagory:</td>
		           <td>
		           <select name="Catagory" > 
		              <option value="" name="Catagory">---Select Catagory---</option> 
		               
		              <?php 
			              $CatagoryList = getAllCatagory();
			                foreach ($CatagoryList as $arr  )
							{
					  			foreach ($arr as $key => $keyValue)
					  			{
			 		   				if($key == "Catagory")
					   				{

				   					?>
				   					<option value="<?php echo $keyValue ?>" name="Catagory"  ><?php echo $keyValue ?></option>
				   					<?php
					   					 // echo $keyValue;	 
			 		   				}
								}
					 		}
				 		 ?>

		          </select>
		              
              
		              

		          <span style="color: red"> <?php echo $CatagoryErr; ?> </span>
		          <span id="CatagoryErr" style="color: red;"></span>
		     	 </td>
		       </tr>
				<tr>
		 			<td><label for="value">Unit Value :</label></td>
					<td><input type="text" id="value" name="value" value="<?php echo $value ?>">
					<span style="color: red"> <?php echo $valueErr; ?> </span>
					<span id="valueErr" style="color: red;"></span></td>
		 		</tr>
				<tr>
		 			<td><label for="result">Result :</label></td>
					<td><input type="text" id="result" name="result" value="<?php echo $TotalValue ?>" readonly></td> 
				</tr>
				 <tr>
				 	<td></td><td><input type="submit" name="submit" value="Submit" onclick="fetch()"></td>
				 </tr>
			</tbody>
		</table>




					
	</form>





	
		 		
	
</body>
</html>