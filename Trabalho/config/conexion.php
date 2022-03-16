<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="teste_20k";
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert</title>
</head>
<body>

</body>
</html>