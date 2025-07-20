<?php
include 'con.php';
if (isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $conn->query(\"UPDATE poses SET status=0 WHERE id=$id\");
}
