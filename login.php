<?php
include_once "db.php";

//$sql = "INSERT INTO `members`(`name`, `phone`, `email`, `address`) VALUES ('john', 2132132, 'awefwune@gmail.com', 'address')"; mysqli_query($db, $sql);
if (isset($_COOKIE["user"]) == null) {
   setcookie("user", "notlogged", null, "/");
}
if (isset($_POST['submit'])) {
   $inputLogin = mysqli_escape_string($db, $_POST['inputLogin']);
   $password = mysqli_escape_string($db, md5($_POST['password']));
   if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $inputLogin)) {
      $sql = "SELECT email, password FROM `members` WHERE email = '$inputLogin'";
      $result = mysqli_query($db, $sql);
   } else {
      $sql = "SELECT name, email, password FROM `members` WHERE name = '$inputLogin'";
      $result = mysqli_query($db, $sql);
   }
   while ($row = mysqli_fetch_assoc($result)) {
      if ($password == $row['password'] && $inputLogin == $row['email'] OR $password == $row['password'] && $inputLogin == $row['name']) {
         setcookie("user", $row['email'], null, "/");
         header("Location: ./index.html");
         return false;
      }
   }
   mysqli_error($db);
}

?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" type="text/css">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="css/login.css" type="text/css">
   <title>Login</title>
</head>

<body>
   <div id="preloader"></div>

   <nav>
      <ul class="nav d-flex justify-content-center fixed-top navaddpage">
         <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
         <li class="nav-item"><a class="nav-link" href="course.php">Course</a></li>
         <li class="nav-item"><a class="nav-link nav-current" href="login.php">Login</a></li>
         <li class="nav-item"><a class="nav-link" href="account.php"><i class="fa-solid fa-user"></i></a></li>
      </ul>
   </nav>

   <div class="container-fluid container-bg">
      <div class="container main-container justify-content-center">
         <div class="row form-container g-4">
            <h3 class="h3 text-center">Login Panel</h3>
            <div class="form">
               <form method="POST" class="col" name="f1">
                  <div class="top-form form-group">
                     <label for="">Name or Email:</label>
                     <input type="text" name="inputLogin" id="inputLogin" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="top-form form-group">
                     <label for="">Password:</label>
                     <input type="password" name="password" id="pass" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group loginstatus">
                     <?php
                     if (isset($_POST["submit"])) {
                        if (!$_POST["email"] == '' || !$_POST["password"] == '') {
                           while ($row = mysqli_fetch_assoc($result)) {
                              if ($email == $row["email"] and $password == $row["password"]) {
                                 echo "<p style='color: green;'>You have logged in</p>";
                              } else {
                                 echo "<p style='color: red;'>Invalid login or password</p>";
                                 return false;
                              }
                           }
                        } else {
                           print_r("<p style='color: red;'>Fields are empty!</p>");
                        }
                     }
                     ?>
                  </div>
                  <div class="form-group">
                     <button type="submit" name="submit" class="btn btn-primary">Login</button>
                  </div>
               </form>
               <div class="form-group">
                  <p>Don't have an account? <a href="register.php">here</a>.</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Javscript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="js/script.js"></script>
</body>

</html>