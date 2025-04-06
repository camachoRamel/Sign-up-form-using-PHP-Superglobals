<?php

$log = [];

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
    

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    <title>Document</title>
</head>
<body class="justify-content-center bg-light">
    
    <div class="container mt-3"><h1 class="text-center">Sign up form</h1></div>
    
    <div class="container rounded bg-white">
        <div class="justify-content-center p-4 mt-3">

       <form action="" method="POST">
            <!-- <div class="container "> -->
                <div class="form-group has-validation">
                    <label for="username">Username:</label>
                    <input class="form-control" type="text" name="username" id="username" required>
                    <!-- <div class="d-inline text-danger">Username can't be empty.</div> -->
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirim Password:</label>
                    <input class="form-control" type="password" name="confirm-password" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input class="form-control" type="number" name="age" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="text-center w-100">
                <button class="btn btn-success mt-3 w-100" type="submit" name="submit" value="submit">Sign up</button>
                <!-- </div> -->
            </div>
       </form> 
        </div>
    </div>


</body>
</html>