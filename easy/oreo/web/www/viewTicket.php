<?php
require_once 'core.php';
if (!isAuthed()) {
  return http_response_code(403);
}
$id = @mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM xss_tickets WHERE ticket_id = '$id' ORDER BY ticket_id DESC";

$results = @mysql_query($query) or die(@mysql_error());

if (@mysql_num_rows($results) == 0) {
  echo 'Ticket not found';
}
else {
    $ticket = @mysql_fetch_assoc($results);
    if (!$isAdmin && $ticket['user_id'] != $userData['user_id']) {
      echo 'Ticket not found';
    }
    else {
      if ($isAdmin) {
        // Mark as Read
        @mysql_query("UPDATE xss_tickets SET status = 'read' WHERE ticket_id = '$id'");
      }

      $body = $ticket['body'];
      $body = str_replace("script", "", $body);

      echo "<h1>" . htmlentities($ticket['title'], ENT_QUOTES) . "</h1>";
      echo '<pre>' . $body . '</pre>';
      echo '<a href="tickets.php">back</a>';
    }
}
?>
