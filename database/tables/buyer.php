<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from buyer LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE buyer (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	view_rand VARCHAR(32),
	social_media VARCHAR(32),
	lead_cat VARCHAR(8),
	lead_type VARCHAR(8),
	date DATE,
	name VARCHAR(128),
	phone_no VARCHAR(16),
	whats_app_no VARCHAR(16),
	your_location VARCHAR(256),
	address VARCHAR(256),
	pin VARCHAR(16),
	br_type VARCHAR(4),
	property_category VARCHAR(64),
	property_type VARCHAR(64),
	dimension VARCHAR(32),
	dim_unit VARCHAR(16),
	min_price VARCHAR(16),
	max_price VARCHAR(16),
	comments TEXT,
	accept_terms boolean,
	status VARCHAR(16),
	status_date datetime,
	comments_array TEXT,
	comments1 VARCHAR(500),
	comments2 VARCHAR(500),
	comments3 VARCHAR(500),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table buyer created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE buyer 
	-- ADD COLUMN social_media VARCHAR(32) AFTER view_rand
	-- ADD COLUMN comments2 VARCHAR(500) AFTER comments1,
	-- ADD COLUMN comments3 VARCHAR(500) AFTER comments2
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table buyer updated successfully<br>";
	} else {
	    echo "Error updating table buyer: " . $conn->error."<br>";
	}
}

$conn->close();
?>