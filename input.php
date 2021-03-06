<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div class="topnav">
		<a class="active" href="./index.php">Home</a>
		<a href="displaydata.php">E-Library</a>
		<a href="./index.php" style="float: right;">Logout</a>
	</div>
	<div class="form-style-6">
		<h1>E-Library Book Input Portal</h1>
		<form method="POST" action="connection.php" enctype="multipart/form-data" onsubmit="return validate(this)" style="border-radius:5%">
			<input type="text" id="name" name="bookname" placeholder="Book Name*" required />
			<textarea cols="25" rows="4" name="bookdesc" placeholder="Book Description*" required></textarea>
			<input type="text" id="password" name="bookauthor" placeholder="Book Author*" / required>
			<select name="booklang" required>
				<option selected disabled>Select Book Language*</option>
				<option value="English">English</option>
				<option value="Hindi">Hindi</option>
				<option value="Bengali">Bengali</option>
				<option value="German">German</option>
				<option value="French">French</option>
				<option value="Other">Other Language</option>
			</select>
			<div style="padding-bottom: 6px">
				<label>Select Book* (Only Pdf, Doc & Docx files are allowed)</label>
			</div>
			<input type="file" name="bookfile" id="bookfile" required />
			<input type="text" id="name" name="uploadername" placeholder="Uploaders Name*" required />
			<input type="email" id="name" name="uploaderemail" placeholder="Uploaders Email*" required />
			<input type="submit" id="submit" name="submit" />
		</form>
	</div>
</body>

</html>
<script>
	function validate() {
		var val = document.getElementById('bookfile').value.toLowerCase()
		var regex = new RegExp('(.*?)\.(docx|doc|pdf)$')
		if (!regex.test(val)) {
			document.getElementById('bookfile').value = ''
			alert('Please select correct file format.')
			return false
		}
		return true
	}
</script>