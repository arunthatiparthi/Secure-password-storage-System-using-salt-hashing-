<!-- <?php 
    // require_once("connection.php");
    session_start();
   $server="localhost";
   $username="root";
   $password="";
   $con=mysqli_connect($server,$username,$password,"salthashing");
   if(!$con){
    die("pk");
   }
   if (isset($_POST['mail']) && isset($_POST['password'])) 
   {
    $email=$_POST['mail'];
    echo "<script type='text/javascript'> alert($email)</script>";
    $query = " select * from salt_hash where Name = (select name from signup where email='$email')";
    $result = mysqli_query($con,$query);
   }

?> -->
<?php 
    session_start();

    // Database connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "salthashing";

    $con = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['mail']) && isset($_POST['password'])) 
    {
        $email = $_POST['mail'];

        // Use prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($con, "SELECT name FROM signup WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($name) {
            // Fetching user details from salt_hash
            $stmt2 = mysqli_prepare($con, "SELECT * FROM salt_hash WHERE Name = ?");
            mysqli_stmt_bind_param($stmt2, "s", $name);
            mysqli_stmt_execute($stmt2);
            $result = mysqli_stmt_get_result($stmt2);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<script>alert('User: " . htmlspecialchars($row['Name']) . "');</script>";
                }
            } else {
                echo "<script>alert('No records found');</script>";
            }

            mysqli_stmt_close($stmt2);
        } else {
            echo "<script>alert('Email not found');</script>";
        }
    }

    mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="show.css"/>
    <title>View Records</title>
</head>
<body class="bg-dark">
    

        <div class="container">
            <div class="row">
                <div class="col m-auto">
                    <div class="card mt-5">
                        <table class="table table-bordered">
                            <h2>Hash from Database</h2>
                            <tr>
                                <td> User Name </td>
                                <td> Slat_Hash </td>
                                <td> Edit  </td>
                                <td> Delete </td>
                            </tr>

                            <?php 
                                    
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                       
                                        $UserName = $row['Name'];
                                        $UserID = $row['Hash'];
                                    
                            ?>
                                    <tr>
                                
                                        <td><?php echo $UserName ?></td>
                                        <td><?php echo $UserID ?></td>
                                       
                                        <td><a href="#" class="btn btn-pencil">Edit</a></td>
                                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                    
                                   

                        </table>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>