<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method="POST">
    username:
    <input placeholder="username" type="text" name="username1">
    email:
    <input placeholder="email" type="text" name="email1">
    password:
    <input id="pass" placeholder="password" type="password" name="password1">
    <br>
    username:
    <input placeholder="username" type="text" name="username2">
    email:
    <input placeholder="email" type="text" name="email2">
    password:
    <input id="pass" placeholder="password" type="password" name="password2">
    <br><br>
    <input type="submit">
  </form>
  <button id="show">show password</button>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = "mydata";
    $table = "users";
    $host = "localhost";
    $usrname = "root";
    $passcode = "";

    $username2 = $_POST["username1"];
    $password2 = $_POST["password1"];
    $username1 = $_POST["username2"];
    $password1 = $_POST["password2"];

    if (filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL) && filter_var($_POST["email2"], FILTER_VALIDATE_EMAIL)) {
      $email2 = $_POST["email1"];
      $email1 = $_POST["email2"];

      try {
        $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->exec("INSERT INTO $table (username, email, password)
        VALUES ('$username1','$email1','$password1')");

        $connect->exec("INSERT INTO $table (username, email, password)
        VALUES ('$username2','$email2','$password2')");
        echo "insertion successful!";
      } catch (Exception $e) {
        echo "insertion failed!: " . $e->getMessage();
      }
    } else {
      echo "please enter a valid email";
    }
  }
  ?>

  <script>
    let show = document.getElementById("show");
    let pass = document.getElementById("pass");

    show.addEventListener("click", function() {
      if (pass.type == "password") {
        pass.setAttribute("type", "text");
      } else {
        pass.setAttribute("type", "password");
      }
    })
  </script>
</body>

</html>