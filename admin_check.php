<script>
   var storage = sessionStorage.getItem("user");
</script>

<?php
include_once "db.php";

function getID() {
   global $db;
   $email = $_COOKIE['user'];
   $sql = "SELECT id FROM members WHERE email = '$email'";
   $getID = mysqli_query($db, $sql);
   $row = mysqli_fetch_array($getID);
   return $row['id'];
}

$sql = "SELECT id, email, administrator FROM members";
$result = mysqli_query($db, $sql);
$id = getID();
while ($row = mysqli_fetch_array($result)) {
   if ($row['email'] == $_COOKIE['user'] && $row['administrator'] == 'yes' && $row['id'] == $id) {
      setcookie("adStatus", 'yes', null, "/");
      return false;
   } else {
      setcookie("adStatus", 'no', null, "/");
   }
}
?>