<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Conversion Rate</title>
	<script src="ConversionRateValidation.js"></script>
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
	 
	
	function SetConversionRate($Catagory, $Unit, $Rate)
	{
		$conn = connect(); // from include dbconnection
		$statement = $conn->prepare("INSERT INTO  conversion (Catagory,Unit,Rate)VALUES(?,?,?)"); 
	 	$statement->bind_param("sid",$Catagory, $Unit, $Rate);
		return $statement->execute();
  	}



	  $isValid = true;

	  $Catagory = "";
	  $Unit = "";
	  $Rate = "";
	   

	  $CatagoryErr = "";
	  $UnitErr = "";
	  $RateErr = "";
	  $insertFailed = $insertSuccess = "";
	  


 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{
	 
            $Catagory = $_POST['Catagory'];
            $Unit = $_POST['Unit'];
            $Rate = $_POST['Rate'];
             
             if(empty($Catagory))
               {
                  $CatagoryErr = "Catagory can not be empty.";
                  $isValid = false;
               }
             
             if(empty($Unit) || !is_numeric($Unit))
               {
                  $UnitErr = "Unit can not be empty or non numeric";
                  $isValid = false;
               }
             
             if(empty($Rate) || !is_numeric($Rate))
               {
                  $RateErr = "Rate can not be empty or non numeric.";
                  $isValid = false;
               }
             
 
            // empty validation for required field
            $Catagory = basic_validation($Catagory);
            $Unit = basic_validation($Unit);
            $Rate=basic_validation($Rate);     
             
            

 
             if($isValid)
             {
                  // Set by AJAX
                 // $res = SetConversionRate($Catagory, $Unit, $Rate);
              
                  if($res) 
                     {
                      	$insertSuccess = "Successfully saved info";  
                     }

                 else{ $insertFailed = "Failed to save info";}
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
	<h1>Page 2 [Conversion Rate]</h1>



	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST"  name="ConversionRateForm" onsubmit="return jsValid();" >
		<table class="center">
			<tbody>
				<tr>
		           <td><label for="Catagory">Catagory :</label></td>
					<td><input type="text" id="Catagory" name="Catagory" value="<?php echo $Catagory ?>">
					<span style="color: red"> <?php echo $CatagoryErr; ?> </span>
					<span id="CatagoryErr" style="color: red;"></span></td>
		     	 </td>
		       </tr>
				<tr>
		 			<td><label for="Unit">Unit :</label></td>
					<td><input type="text" id="Unit" name="Unit" value="<?php echo $Unit ?>">
					<span style="color: red"> <?php echo $UnitErr; ?> </span>
					<span id="UnitErr" style="color: red;"></span></td>
		 		</tr>
				<tr>
		 			<td><label for="Rate">Rate :</label></td>
					<td><input type="text" id="Rate" name="Rate" value="<?php echo $Rate ?>">
					<span style="color: red"> <?php echo $RateErr; ?> </span>
					<span id="RateErr" style="color: red;"></span></td>
				</tr>
				 <tr>
				 	<td></td><td><input type="submit" name="submit" value=" Submit " onclick="fetch()">
				 	<span style="color: green;"> <?php echo $insertSuccess; ?> </span>
				 	<span style="color: red"> <?php echo $insertFailed; ?> </span></td>
				 </tr>
			</tbody>
		</table>
	</form>
 	
</body>
</html>