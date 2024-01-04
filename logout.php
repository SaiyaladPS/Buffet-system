<?php
// Start the session
session_start();
// Destroy the session
session_destroy();

// Redirect to a different page after destroying the session (optional)
header("location: index.php");
exit();
?>