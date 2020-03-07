<meta charset="utf-8">
<base href="/" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="/assets/img/favicon.png">
<title><?php echo $vname; ?> | Swastik Landsman</title>
<meta name="description" content="Swastik Landsman Reality">
<meta property="og:title" content="Swastik Landsman" />
<meta property="og:url" content="https://swastiklandsman.com/" />
<meta property="og:description" content="realestate site">
<meta property="og:image" content="https://swastiklandsman.com/assets/logo.jpg">
<meta property="og:type" content="article" />

<link rel="shortcut icon" href="/img/core-img/favicon.png" type="image/x-icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <script src="https://kit.fontawesome.com/78b77cd802.js" crossorigin="anonymous"></script> -->
<style>
	#logo_desktop_home{
	    height: 90px;
	}
	@media only screen and (max-width: 450px) {
	  #logo_desktop, #logo_desktop_home{
	    width: 100%;height: auto;
	  }
	}
	.social{
	  width: 30px;
	  height: 30px;
	}
	/* The container */
	.container {
	  display: flex;
	  position: relative;
	  padding-left: 35px;
	  margin-bottom: 12px;
	  width: 100%;
	  cursor: pointer;
	  -webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	/* Hide the browser's default radio button */
	.container input {
	  position: absolute;
	  opacity: 0;
	  cursor: pointer;
	}

	/* Create a custom radio button */
	.checkmark {
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 30px;
	  width: 100%;
	  background-color: #eee;
	  border-radius: 0%;
	  text-align: center;
	  line-height: 30px;
	  vertical-align: middle;
	}

	/* On mouse-over, add a grey background color */
	.container:hover input ~ .checkmark {
	  background-color: #ccc;
	}

	/* When the radio button is checked, add a blue background */
	.container input:checked ~ .checkmark {
	  background-color: #2196F3;
	}

	.btn_image1{
		position: relative;
		overflow: hidden;
	}
	.btn_image1:hover > img{
		transform: scale(1.2);transition:transform 0.5s;
	}
	.caption{
		position: absolute;bottom: 0px;left: 2px;font-weight: bold;font-size: 25px;color:white;background: #333;opacity: 0.8;padding-left: 10px;padding-right: 10px; 
	}

	@media only screen and (max-width: 450px) {
	  	.caption{
			font-size: 15px;
		}
		.padding0{
			padding: 0px;
		}
	}

	.error{
		color:red;
	}

	.form-control{
		border:1px solid #a6a6a6;
		background-color: #eae8e8 !important;
	}
</style>