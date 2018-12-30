<?php
require_once 'core.php';

if (!isAuthed()) {
  return http_response_code(403);
}

$query = "SELECT * FROM xss_tickets WHERE user_id = '{$userData['user_id']}' ORDER BY ticket_id DESC";

$results = @mysql_query($query) or die(@mysql_error());

echo '<p><a href="createTicket.php">Create ticket</a></p>';

if (@mysql_num_rows($results) == 0) {
  echo 'No tickets have been lodged';
}
else {
  echo '<table>
    <thead>
      <th width="">#</th>
      <th width="">Title</th>
      <th width="">Status</th>
    </thead>
    <tbody>
  ';
  while ($post = mysql_fetch_assoc($results)) {
    echo '<tr>
      <td>' . $post['ticket_id'] . '</td>
      <td><a href="viewTicket.php?id=' . $post['ticket_id'] . '">' . $post['title'] . '</a></td>
      <td>' . $post['status'] . '</td>
    </tr>';
  }

  echo '</tbody></table>';
}
?>
<p><b><a href="index.php">Back to home</a></b></p>
