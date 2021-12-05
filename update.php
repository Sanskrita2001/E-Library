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

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    // echo $edit_id;
    $select = "SELECT * FROM book where bookid=$edit_id";
    $run = mysqli_query($conn, $select);
    $row = mysqli_fetch_array($run);
    $book_id = $row['bookid'];
    $book_name = $row['bookname'];
    $book_desc = $row['bookdesc'];
    $book_author = $row['bookauthor'];
    $book_lang = $row['booklang'];
    $book_file = $row['bookfile'];
    $uploader_name = $row['uploadername'];
    $uploader_email = $row['uploaderemail'];
}

if (isset($_POST['submit'])) {
    $nbook_name = $_POST['bookname'];
    $nbook_desc = $_POST['bookdesc'];
    $nbook_author = $_POST['bookauthor'];
    $nbook_lang = $_POST['booklang'];
    $nuploader_name = $_POST['uploadername'];
    $nuploader_email = $_POST['uploaderemail'];

    $update = "UPDATE book SET  bookname='$nbook_name',bookdesc='$nbook_desc',bookauthor='$nbook_author',booklang='$nbook_lang',uploadername='$nuploader_name',uploaderemail='$nuploader_email' WHERE bookid=$edit_id";

    $run_update = mysqli_query($conn, $update);
    if ($run_update === true) {
        $msg = "Record has been sucessfully updated!";
    } else {
        $msg .= "Failed, Please try again!";
    }
}

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <div class="topnav">
        <a href="./index.php">Home</a>
        <a href="displaydata.php">E-Library</a>
        <a class="active" href="update.php">Update</a>
        <a href="./index.php" style="float: right;">Logout</a>
    </div>
    <div class="form-style-6">
        <h1>E-Library Book Edit Portal</h1>
        <h3><?php echo $msg;?></h3>
        <form method="POST" action="" enctype="multipart/form-data" style="border-radius:5%">
            <input type="text" id="name" name="bookname" placeholder="Book Name*" value="<?php echo $book_name ?>" required />
            <textarea cols="25" rows="4" name="bookdesc" placeholder="Book Description*" value="<?php echo $book_desc; ?>" required></textarea>
            <input type="text" id="password" name="bookauthor" placeholder="Book Author*" value="<?php echo $book_author; ?>" / required>
            <select name="booklang" value="<?php echo $book_lang; ?>" required>
                <option selected disabled>Select Book Language*</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Bengali">Bengali</option>
                <option value="German">German</option>
                <option value="French">French</option>
                <option value="Other">Other Language</option>
            </select>
            <input type="text" id="name" name="uploadername" placeholder="Uploaders Name*" value="<?php echo $uploader_name; ?>" required />
            <input type="email" id="name" name="uploaderemail" placeholder="Uploaders Email*" value="<?php echo $uploader_email; ?>" required />
            <input type="submit" id="submit" name="submit" />
        </form>
    </div>
    <?php
    
    ?>

</body>

</html>