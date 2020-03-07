<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from admins LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE admins (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	avatar VARCHAR(1000),
	name VARCHAR(60) NOT NULL,
	email VARCHAR(70),
	phone VARCHAR(15),
	password VARCHAR(64),
	role VARCHAR(32),
	favorites VARCHAR(1000),
	last_logged_in datetime,
	p1 boolean,
	p2 boolean,
	p3 boolean,
	p4 boolean,
	p5 boolean,
	p6 boolean,
	p7 boolean,
	p8 boolean,
	p9 boolean,
	p10 boolean,
	p11 boolean,
	p12 boolean,
	p13 boolean,
	p14 boolean,
	p15 boolean,
	p16 boolean,
	p17 boolean,
	p18 boolean,
	p19 boolean,
	p20 boolean,
	p21 boolean,
	p22 boolean,
	p23 boolean,
	p24 boolean,
	p25 boolean,
	p26 boolean,
	p27 boolean,
	p28 boolean,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table admins created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}

	$passwd = password_hash("admin@123", PASSWORD_DEFAULT);

	$sql = "INSERT INTO admins (name, email, phone, role, password)
	VALUES ('Root Admin', 'admin@nomail.com', '9900990099', 'Admin', '$passwd')";

	if ($conn->query($sql) === TRUE) {
	    echo "Default admin created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE admins 
	ADD COLUMN last_logged_in datetime AFTER favorites,
	ADD COLUMN p1 boolean AFTER last_logged_in,
	ADD COLUMN p2 boolean AFTER p1,
	ADD COLUMN p3 boolean AFTER p2,
	ADD COLUMN p4 boolean AFTER p3,
	ADD COLUMN p5 boolean AFTER p4,
	ADD COLUMN p6 boolean AFTER p5,
	ADD COLUMN p7 boolean AFTER p6,
	ADD COLUMN p8 boolean AFTER p7,
	ADD COLUMN p9 boolean AFTER p8,
	ADD COLUMN p10 boolean AFTER p9,
	ADD COLUMN p11 boolean AFTER p10,
	ADD COLUMN p12 boolean AFTER p11,
	ADD COLUMN p13 boolean AFTER p12,
	ADD COLUMN p14 boolean AFTER p13,
	ADD COLUMN p15 boolean AFTER p14,
	ADD COLUMN p16 boolean AFTER p15,
	ADD COLUMN p17 boolean AFTER p16,
	ADD COLUMN p18 boolean AFTER p17,
	ADD COLUMN p19 boolean AFTER p18,
	ADD COLUMN p20 boolean AFTER p19,
	ADD COLUMN p21 boolean AFTER p20,
	ADD COLUMN p22 boolean AFTER p21,
	ADD COLUMN p23 boolean AFTER p22,
	ADD COLUMN p24 boolean AFTER p23,
	ADD COLUMN p25 boolean AFTER p24,
	ADD COLUMN p26 boolean AFTER p25,
	ADD COLUMN p27 boolean AFTER p26,
	ADD COLUMN p28 boolean AFTER p27
	";
    
	if ($conn->query($sql) === TRUE) {
	    echo "Table admins updated successfully<br>";
	} else {
	    echo "Error updating table admins: " . $conn->error."<br>";
	}
}

$conn->close();
?>