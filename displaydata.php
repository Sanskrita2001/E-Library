<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bookdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//fetch from database
$sql = "SELECT * from book";
$result = $conn->query($sql);
$msg;
if (isset($_GET['del'])) {
	$del_id=$_GET['del'];
	$delete = "DELETE FROM book WHERE bookid='$del_id'";
	if(mysqli_query($conn,$delete)===true){
		$msg .= "Record has been sucessfully deleted!";
	}
	else{
		$msg .= "Failed, Please try again!";
	}
}
?>
<html>
</head>
<title>E-Library Display Section</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/display.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="topnav">
		<a href="./input.php">Home</a>
		<a class="active" href="displaydata.php">E-Library</a>
		<input type="text" name="search_text" id="search_text" placeholder="Search by book name">
		<a href="./index.php">Logout</a>
	</div>
	<div style="overflow-x:auto;">
		<h1>Books Available for Free Download</h1>
		<!-- <h3><?php echo $msg;?></h3> -->
		<div id="result"></div>
	</div>
</body>
<script>
	$(document).ready(function() {

		load_data();

		function load_data(query) {
			$.ajax({
				url: "fetch.php",
				method: "POST",
				data: {
					query: query
				},
				success: function(data) {
					$('#result').html(data);
				}
			});
		}
		$('#search_text').keyup(function() {
			var search = $(this).val();
			console.log(search)
			if (search != '') {
				load_data(search);
			} else {
				load_data();
			}
		});
	});
</script>

</html>