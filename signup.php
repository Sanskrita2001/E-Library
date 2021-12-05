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

    $flag = 0;
    $message = 'hello';
    $visibility = 'none';

    // check for submit
    if(isset($_POST['submit'])){
        // echo 'submitted';
        // Get form data
        $user_id = mysqli_real_escape_string($conn ,$_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        // $hash = password_hash($pass, PASSWORD_DEFAULT);

        $query = "SELECT * FROM login WHERE username LIKE '$user_id'";

        // get result
        $result = mysqli_query($conn , $query);

        // Fetch data
        $creds = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (empty($creds)) {
            # code...
            $flag = 'alert alert-dismissible alert-success';
            
            $query = "INSERT INTO login(username,password) VALUES('$user_id','$pass')";

            if(mysqli_query($conn,$query)){
                $message = 'Profile Successfully Created';
            }
            else {
                echo 'ERROR: '. mysqli_error($conn);
            }

        } else {
            # code...
            $flag = 'alert alert-dismissible alert-danger';
            $message = 'Profile already exists';
        }
        $visibility = 'block';

        //Free the result
        mysqli_free_result($result);
    }
    
    

    // CLose Connection
    mysqli_close($conn);

?>

<link rel="stylesheet" type="text/css" href="css/style.css" />
    <div class="form-style-6" style="margin-top: 15%;">
        <div class="<?php echo $flag ?>" style = "display : <?php echo $visibility ?>">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?php echo $message; ?></strong> 
        </div>
        <h1 class = " mx-2 my-2">Sign Up</h1>
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
                    <input type="submit" name="submit" value = "Create Profile" class="btn btn-success my-4"> 
                </fieldset>
            </form>
        </div>
    </div>
