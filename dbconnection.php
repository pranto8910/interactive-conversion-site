<?php 

function connect()
{
 	 $conn = new mysqli("localhost","Kamal","123","Lab_Final"); // host, user, user pass, database name.
	 if($conn->connect_errno)
	 {
	 	die ("Connection failed due to ". $conn->connect_error);
	 }
	 
	 // echo "Database connetion successful";
	 // $conn->close();

	 return $conn;
	}
?>