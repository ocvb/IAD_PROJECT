<?php
include_once "db.php";

?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" type="text/css">
   <link rel="stylesheet" href="css/style.css" type="text/css">

   <script type="module">
      import {
         getCookie
      } from "./js/cookies.js";

      sessionStorage.setItem("user", "notlogged");
      $(document).ready(function() {
         function loggedin() {
            if (getCookie("user") != "notlogged") {
               if (getCookie("adStatus") == 'yes') {
                  $("#navaddpage").append('<li class="nav-item account-item">- <a href="admin.php">Admin</a></li>');
               }
            }
            $.post("admin_check.php");
         }
         if (getCookie("user") == '') {
            $.post("cookies.php");
         }

         loggedin();
      });
   </script>
</head>

<body>
   <div id="preloader"></div>
   <!--TODO: Header, Nav, Article, Aside-->
   <nav>
      <ul id="navaddpage" class="nav d-flex justify-content-center fixed-top navaddpage">
         <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
         <li class="nav-item"><a class="nav-link" href="course.php">Course</a></li>
         <li class="nav-item"><a class="nav-link" href="account.php"><i class="fa-solid fa-user"></i></a></li>
      </ul>
   </nav>
   <header class="navbar justify-content-center">
      <div>
         <p>ruhe</p>
      </div>
   </header>

   <!--javascript-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="js/script.js"></script>
   <script>
      function logout() {
         $.post("cookies.php");
         window.location.reload();
      }
   </script>
</body>

</html>