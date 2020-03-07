<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from members LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE members (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	view_rand VARCHAR(32),
	social_media VARCHAR(32),
	referred_by INT(6) UNSIGNED,
	date DATE,
	name VARCHAR(128),
	phone_no VARCHAR(16),
	whats_app_no VARCHAR(16),
	email VARCHAR(128),
	address VARCHAR(256),
	member_type VARCHAR(16),
	property_category VARCHAR(64),
	comments TEXT,
	accept_terms boolean,
	status VARCHAR(16),
	status_date datetime,
	comments_array TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table members created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE members 
	ADD COLUMN referred_by INT(6) UNSIGNED AFTER social_media
	-- ADD COLUMN comments2 VARCHAR(500) AFTER comments1,
	-- ADD COLUMN comments3 VARCHAR(500) AFTER comments2
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table members updated successfully<br>";
	} else {
	    echo "Error updating table members: " . $conn->error."<br>";
	}
}

$conn->close();
?>