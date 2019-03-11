<?php

// Used to display an error message below the form
$errorMessage = '';
$username = '';
$email = '';
$passwords = '';

$taken = array();
$taken[] = "Dean";
array_push($taken,"Sam");
array_push($taken,"Cass");
array_push($taken,"John");
array_push($taken,"Gabriel");
array_push($taken,"Crowley");


$isPostback = 'POST' === $_SERVER['REQUEST_METHOD'];

if ($isPostback) {
    $errorMessage = processForm();
}



function processForm()
{
    global $username, $email, $passwords, $taken;
    //$counter = 0;
    $username = $_POST['username'];
    $email = $_POST['email'];
    // The array of 2 passwords
    $passwords = $_POST['password'];
    // var_dump($passwords);
    // Validate the form
    if (empty($username)) {
        return 'Username is required';
    } elseif (empty($email)) {
        return 'Email is required';
    } elseif (2 != count($passwords)) {
        return 'Password and Repeat Password are required';
    } elseif ($passwords[0] != $passwords[1]) {
        return 'Password must match Repeat Password';
    } elseif (empty($passwords[0])) {
        return 'Password cannot be empty';
    }elseif( (strpos($passwords[0], $username));
        return 'Password cannot contain username';
      
    

    // TODO: process the registration
    
    if(empty($errorMessage)){
    
        var_dump($taken);

        for ($i=0; $i<=sizeof($taken); $i++) {
            echo $i;
            echo $username;
            echo $taken[$i];
            if($username === $taken[$i]){
                return 'Username is already taken';
            }
        }
    }
    
}
//if (strpos($str, 'This') !== false) {
    //echo 'true';


?>


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>CSUMB Dashboard Demo Registration</title>

  <!-- Icons -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="css/style.min.css" rel="stylesheet">

  <!-- Styles required by this views -->

</head>

<body>
  <div class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mx-4">
          <div class="card-body p-4">
            <h1>Register</h1>
            <p class="text-muted">Create your account</p>
            <form action="register.php" method="POST">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password[]">
              </div>

              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Repeat password" name="password[]">
              </div>
              <input type="submit" class="btn btn-block btn-success" value="Create Account" />
            </div>
          </form>
          <div class="card-footer p-4">
            <?php
            if ($isPostback) {
                if (!empty($errorMessage)) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo "We could not complete the registration: $errorMessage.";
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-success" role="alert">';
                    echo 'Registration was successful';
                    echo '</div>';
                }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>