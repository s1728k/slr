<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from boxt_questions LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE boxt_questions (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	boxt_id VARCHAR(64),
	text TEXT,
	subtitle TEXT,
	additionalInfo TEXT,
	helpText VARCHAR(255),
	helpTemplate VARCHAR(255),
	template VARCHAR(255),
	tag VARCHAR(255),
	productType VARCHAR(255),
	ignoreIfAnswered VARCHAR(255),
	dependentAnswers VARCHAR(255),
	answers VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table boxt_questions created successfully<br>";
	} else {
	    echo "Error creating table: " . $conn->error."<br>";
	}
}else{
	// sql to update table
	$sql = "ALTER TABLE boxt_questions 
	 ADD COLUMN additionalInfo TEXT AFTER subtitle
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table boxt_questions updated successfully<br>";
	} else {
	    echo "Error updating table boxt_questions: " . $conn->error."<br>";
	}
}

$conn->close();
?>