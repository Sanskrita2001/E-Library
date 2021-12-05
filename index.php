<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bookdb";

//Create Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$flag = 0;
$message = 'hello';
$visibility = 'none';

// check for submit
if (isset($_POST['submit'])) {
    // echo 'submitted';
    // Get form data
    $user_id = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM login WHERE username LIKE '$user_id'";

    // get result
    $result = mysqli_query($conn, $query);

    // Fetch data
    $creds = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (empty($creds)) {
        # code...
        $flag = 'alert alert-dismissible alert-danger';
        $message = 'Invalid username';
    } else {
        # code...
        foreach ($creds as $cred) {
            if ($cred['username'] === "admin" && $cred['password'] === "admin")
                include("admin.php");
            if ($cred['password'] === $pass) {
                # code...
                $flag = 'alert alert-dismissible alert-success';
                $message = 'Welcome! Sucessful Login';
                include("input.php");
            } else {
                $flag = 'alert alert-dismissible alert-danger';
                $message = 'Incorrect Password';
            }
        }
    }
    $visibility = 'block';

    //Free the result
    mysqli_free_result($result);
}



// CLose Connection
mysqli_close($conn);

?>


<link rel="stylesheet" type="text/css" href="css/style.css" />
<div class="topnav">
    <a class="active" href="./index.php">Login</a>
    <a href="signup.php">Signup</a>
</div>
<div class="form-style-6" style="margin-top: 10%;">
    <div class="<?php echo $flag ?>" style="display : <?php echo $visibility ?>">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><?php echo $message; ?></strong>
    </div>
    <h1 class=" mx-2 my-2">Sign In</h1>
    <div class="card px-4 py-4 my-3">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset>
                <div class="form-group">
                    <label class="form-label mt-4">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label class="form-label mt-4">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                </div>
                <input type="submit" name="submit" value="Login" class="btn btn-success my-4">
            </fieldset>
        </form>
    </div>
</div>