<?php
  // For less text in the code I used require to make the header come up on the webpage
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <!--
          Here is where we make it so that the page displays that if we are logged in or out
          -->
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged out!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged in!</p>';
          }
          ?>
        </section>
      </div>
    </main>

<?php
  // Did the same thing for the footer that I did for the header.
  require "footer.php";
?>
