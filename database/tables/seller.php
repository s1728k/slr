<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from seller LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE seller (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	view_rand VARCHAR(32),
	social_media VARCHAR(32),
	lead_cat VARCHAR(8),
	lead_type VARCHAR(8),
	date DATE,
	name VARCHAR(128),
	phone_no VARCHAR(16),
	whats_app_no VARCHAR(16),
	address VARCHAR(256),
	pin VARCHAR(16),
	villege VARCHAR(128),
	landmark VARCHAR(128),
	file_paths TEXT,
	sr_type VARCHAR(4),
	property_category VARCHAR(64),
	property_type VARCHAR(64),
	dimension VARCHAR(32),
	dim_unit VARCHAR(16),
	tprice INT(6) UNSIGNED,
	price DECIMAL(8,2),
	advance VARCHAR(256),
	goodwill VARCHAR(256),
	p_unit VARCHAR(16),
	p_dim VARCHAR(16),
	comments TEXT,
	accept_terms boolean,
	status VARCHAR(16),
	status_date datetime,
	comments_array TEXT,
	comments1 VARCHAR(500),
	comments2 VARCHAR(500),
	comments3 VARCHAR(500),
	latitude DECIMAL(9,6),
	longitude DECIMAL(9,6),
	place_link VARCHAR(256),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table seller created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}

}else{
	// sql to update table
	
	$sql = "ALTER TABLE seller 
	ADD COLUMN advance VARCHAR(256) AFTER price,
	-- DROP COLUMN price,
	ADD COLUMN goodwill VARCHAR(256) AFTER advance
	-- ADD COLUMN longitude DECIMAL(9,6) AFTER latitude
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table seller updated successfully<br>";
	} else {
	    echo "Error updating table seller: " . $conn->error."<br>";
	}
}

$conn->close();
?>