<?php
require_once 'core.php';
if (!isAuthed()) {
  return http_response_code(403);
}

if (isset($_POST['title']) && isset($_POST['body'])) {
  $title = mysql_real_escape_string($_POST['title']);
  $body = mysql_real_escape_string($_POST['body']);

  @mysql_query("INSERT INTO xss_tickets (user_id, status, title, body) VALUES ('".$userData['user_id']."','Unread','$title','$body')") or die(mysql_error());
  echo '<strong>Your ticket has been created! We will check it very shortly!</strong>';
}
?>
<form action="" method="post">
    <input type="text" name="title" placeholder="Issue summary" />
  </p>
  <p>
  <textarea name="body" placeholder="Describe your issue"></textarea>
  </p>
  <p>
  <input type="submit" value="Create" /> <a href="tickets.php">cancel</a>
  </p>
</form>
