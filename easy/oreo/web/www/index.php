<?php
require_once 'core.php';
?>
<h1>Support Center</h1>
<?php
if (isAuthed()):
  echo "Welcome back, " . htmlentities($userData['username'], ENT_QUOTES);
  echo '<ul>';

  if ($isAdmin) {
    echo '<li><a href="admin.php">Admin</a></li>';
  }
  else {
    echo '<li><a href="tickets.php">My Tickets</a></li>';
  }

  echo '
    <li><a href="logout.php">Logout</a></li>
  </ul>';
else:
  echo '<a href="login.php">Login</a> to file a ticket - Create an account <a href="create.php">here</a>';
endif;
?>
