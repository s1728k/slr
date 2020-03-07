<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from boxt_answers LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE boxt_answers (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	boxt_id VARCHAR(64),
	icon VARCHAR(255),
	image VARCHAR(255),
	text VARCHAR(255),
	info VARCHAR(255),
	nextStatus VARCHAR(255),
	queryFragment VARCHAR(255),
	value VARCHAR(255),
	tag VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table boxt_answers created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE boxt_answers 
	 ADD COLUMN image VARCHAR(255) AFTER icon
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table boxt_answers updated successfully<br>";
	} else {
	    echo "Error updating table boxt_answers: " . $conn->error."<br>";
	}
}

$conn->close();
?>