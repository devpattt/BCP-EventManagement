<?php

session_start();
if (!isset($_SESSION['accountId'])) {
    header("index.php");
    exit();
}

include 'fetchname.php';
?>

<!DOCTYPE html>
<lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/bcp logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">>
  <link href="assets/css/style.css" rel="stylesheet">

</head>
  <style>    
    .alert-box {
        position: fixed;
        top: 150px;
        right: 550px;
        background-color: #5cb85c; 
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
        z-index: 1000;
    }

    .alert-box.show {
        opacity: 1;
        visibility: visible;
    }

    .alert-box.error {
        background-color: #d9534f;
    }

    
  </style>

<body>

  <div id="statusMessage" class="alert-box">
      <span id="messageContent"></span>
  </div>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/default profile.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo htmlspecialchars($fullname); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span>Administrator</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  
  <ul class="sidebar-nav" id="sidebar-nav">
    <div class="logo-container" style="text-align: center; margin-bottom: 10px;">
    <img src="assets/img/bcp logo.png" alt="Logo" style="width: 100px; height: auto;">
</div>


   

        <hr class="sidebar-divider">

      <li class="nav-heading">Event Management System</li>

      <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#system-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-calendar4-event"></i><span>Event Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="system-nav" class="nav-content collapse show " data-bs-parent="#sidebar-nav">
        <li>
        <li>
        <a href="eventdash.php">
            <i class="bi bi-circle"></i><span>Report and Analytics</span>
        </a>
        </li>
        <a href="calendar.php" >
            <i class="bi bi-circle"></i><span>Events Calendar</span>
        </a>
        </li>
        <li>
        <a href="tables-data.php">
            <i class="bi bi-circle"></i><span>Event Bookings</span>
        </a>
        </li>
        <li>
        <a href="history-data.php" class="active">
            <i class="bi bi-circle"></i><span>History</span>
        </a>
        </li>
      </ul>
      </li><!-- End System Nav -->

     
      <hr class="sidebar-divider">  
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

<div class="pagetitle">
  <h1>Event Bookings</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <table class="table datatable">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Event Title</th>
            <th>Reservation Date</th>
            <th>No. of People</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th> 
          </tr>
        </thead>
        <tbody>
        <?php
          $servername = "localhost"; 
          $username = "root"; 
          $password = ""; 
          $dbname = "bcp_sms3_ems"; 

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT id, `name`, contact, event_title, date_booked, attendees, time, status FROM bcp_sms3_event_history
             WHERE status IN ('Approved', 'Cancelled')
             ORDER BY booked_at DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["event_title"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date_booked"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["attendees"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo "<td><button class='btn btn-primary' onclick='loadBooking(" . $row["id"] . ")'>Update</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No history records found.</td></tr>";
            }

            $conn->close();
        ?>
        </tbody>
      </table>
    </div>
  </div>
</section>



</main>


<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="confirmationModalLabel">Confirm Status Change</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      Are you sure you want to change the status?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="updateBookingModal" tabindex="-1" role="dialog" aria-labelledby="updateBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateBookingModalLabel">Update Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateBookingForm">
                    <input type="hidden" name="id" id="bookingId">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="event_title">Event Title:</label>
                        <input type="text" class="form-control" id="event_title" name="event_title" required>
                    </div>
                    <div class="form-group">
                        <label for="date_booked">Reservation Date:</label>
                        <input type="date" class="form-control" id="date_booked" name="date_booked" required>
                    </div>
                    <div class="form-group">
                        <label for="attendees">No. of People:</label>
                        <input type="number" class="form-control" id="attendees" name="attendees" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Approved">Approved</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
   
    function loadBooking(id) {
        $.ajax({
            url: 'get_booking.php', 
            type: 'GET',
            data: { id: id },
            success: function(data) {
                const booking = JSON.parse(data);
                $('#bookingId').val(booking.id);
                $('#name').val(booking.name);
                $('#contact').val(booking.contact);
                $('#event_title').val(booking.event_title);
                $('#date_booked').val(booking.date_booked);
                $('#attendees').val(booking.attendees);
                $('#time').val(booking.time);
                $('#status').val(booking.status);
                $('#updateBookingModal').modal('show');
            }
        });
    }

   
 window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'success') {
        showMessage("Status updated successfully!", "success");
    } else if (status === 'error') {
        showMessage("Error updating status. Please try again.", "error");
    }
 }

function showMessage(message, type) {
    const messageBox = document.getElementById('statusMessage');
    const messageContent = document.getElementById('messageContent');

    messageContent.textContent = message;
    messageBox.className = `alert-box ${type === 'error' ? 'error' : ''} show`;
    
    setTimeout(() => {
        messageBox.classList.remove('show');
    }, 3000);
}

function openModal(selectElement) {
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    const confirmButton = document.getElementById('confirmButton');
    const form = selectElement.closest('form');
    const selectedValue = selectElement.value;
    const eventId = form.querySelector('input[name="event_id"]').value;
    confirmButton.onclick = function() {
        form.submit(); 
    };

    modal.show();

    modal._element.addEventListener('hidden.bs.modal', function () {
        form.reset();  
    });
}

</script>
</body>
</html>