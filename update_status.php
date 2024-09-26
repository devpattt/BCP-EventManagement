<?php
  // update_status.php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "bcpevent_db"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Get the event ID and the new status from the form
    $event_id = $_POST['event_id'];
    $new_status = $_POST['status'];

    // Prepare and bind the statement to update the status
    $stmt = $conn->prepare("UPDATE event_db SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $event_id);

    if ($stmt->execute()) {
      echo "Status updated successfully!";
    } else {
      echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the main page after update (this can be replaced with AJAX to prevent reload)
    header('Location: tables-data.php');  // Change to your main file name
    exit();
  }
?>
