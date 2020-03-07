<?php
require ('../env.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from settings LIMIT 1') === FALSE)
{
	$sql = "CREATE TABLE settings (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	social_media VARCHAR(1000),
	sellable_properties VARCHAR(1000),
	rentable_properties VARCHAR(1000),
	bhk VARCHAR(1000),
	sites VARCHAR(1000),
	commercial_properties VARCHAR(1000),
	pot_bhk VARCHAR(1000),
	pot_sites VARCHAR(1000),
	pot_commercial_properties VARCHAR(1000),
	sell_prices VARCHAR(1000),
	rent_prices VARCHAR(1000),
	price_units VARCHAR(1000),
	land_units VARCHAR(1000),
	land_per_unit VARCHAR(1000),
	member_types VARCHAR(1000),
	member_works VARCHAR(1000),
	messages TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table settings created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}

	$sql = "INSERT INTO settings (social_media, sellable_properties, rentable_properties, bhk, sites, commercial_properties, sell_prices, rent_prices, price_units, land_units, member_types, member_works)
	VALUES ('[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]')";

	if ($conn->query($sql) === TRUE) {
	    echo "Default settings created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

}else{

	$sql = "ALTER TABLE settings 
	ADD COLUMN messages TEXT AFTER member_works
	";

	if ($conn->query($sql) === TRUE) {
	    echo "Table settings updated successfully<br>";
	} else {
	    echo "Error updating table settings: " . $conn->error."<br>";
	}
}

$conn->close();
?>