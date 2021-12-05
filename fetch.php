<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "root", "bookdb");
$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "
  SELECT * FROM book 
WHERE bookname LIKE '%" . $search . "%'
OR bookdesc LIKE '%" . $search . "%' 
OR bookauthor LIKE '%" . $search . "%' 
OR booklang LIKE '%" . $search . "%' 
OR uploadername LIKE '%" . $search . "%'
OR uploaderemail LIKE '%" . $search . "%'
";
} else {
    $query = "
  SELECT * FROM book ORDER BY bookid
";
}
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
    <table width="100%" cellspacing="0" cellpadding="18">
    <div class="header">
        <th>Book Name</th>
        <th>Book Description</th>
        <th>Book Author</th>
        <th>Book Language</th>
        <th>Download Link</th>
        <th>Uploader Name</th>
        <th>Uploader Email</th>
    </div>
';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
<tr>
    <td>' . $row['bookname'] . '</td>
    <td>' . $row['bookdesc'] . '</td>
    <td>' . $row['bookdesc'] . '</td>
    <td>' . $row['bookname'] . '</td>
    <td><a href="http://localhost/phpsandbox/E-Library-master/files/' . $row['bookfile'] . '"><b>Download E-Book</b></a></td>
    <td>' . $row['uploadername'] . '</td>
    <td>' . $row['uploaderemail'] . '</td>
</tr>';
    }
    echo $output;
} else {
    $msg='<h2>Data  NOT  Found</h2>';
    echo $msg;
}
