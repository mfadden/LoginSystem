<?php
// Here is where you check if the user got to this page by clicking the login button.
if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  // Here is where you check for empty fields in the login.
  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        // Here is where we check if the password matches what is in the database.
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        // If they don't match send them back to try again!
        if ($pwdCheck == false) {
          // If there is an error we send the user back to the signup page to try again.
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        // Then if they DO match, then you log them in!
        else if ($pwdCheck == true) {
            // We start a session here to be able to create the variables to say that the user is loged in!
          session_start();
          // You create the session variables here.
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          // Now the user is logged in, you can now sedn them back to the homepage logged in!
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../signup.php");
  exit();
}
