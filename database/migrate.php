<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require ('tables/admins.php');
	require ('tables/buyer.php');
	require ('tables/seller.php');
	require ('tables/linkshares.php');
	require ('tables/members.php');
	require ('tables/settings.php');
	require ('tables/boxt_answers.php');
	require ('tables/boxt_questions.php');
}
?>