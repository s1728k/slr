<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from linkshares LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE linkshares (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	shared_props VARCHAR(255),
	shared_to_id INT(6) UNSIGNED,
	shared_to_cat VARCHAR(8),
	urlcode VARCHAR(64),
	category VARCHAR(16),
	whats_app_no VARCHAR(16),
	contact_info BOOLEAN,
	location_info BOOLEAN,
	status_info BOOLEAN,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table linkshares created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE linkshares 
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table linkshares updated successfully<br>";
	} else {
	    echo "Error updating table linkshares: " . $conn->error."<br>";
	}
}

$conn->close();
?>