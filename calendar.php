<!DOCTYPE html>
<html lang="en">
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
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
</head>

<style> 
  body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        #calendar {
            width: 68%;
        }
        .book-event-form {
            width: 28%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .book-event-form input, .book-event-form select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .book-event-form button {
            width: 100%;
            padding: 10px;
            background-color:  #012970;
            color: white;
            border: none;
            cursor: pointer;
        }
        .book-event-form button:hover {
            background-color: darkcyan;
        }
        
</style>
<body>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/default profile.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Administrator</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Administrator</h6>
              <span>Web Designer</span>
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
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li>
    </nav>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <div class="flex items-center w-full p-1 pl-6" style="display: flex; align-items: center; padding: 3px; width: 40px; background-color: transparent; height: 4rem;">
        <div class="flex items-center justify-center" style="display: flex; align-items: center; justify-content: center;">
            <img src="https://elc-public-images.s3.ap-southeast-1.amazonaws.com/bcp-olp-logo-mini2.png" alt="Logo" style="width: 30px; height: auto;">
        </div>
      </div>

      <div style="display: flex; flex-direction: column; align-items: center; padding: 16px;">
        <div style="display: flex; align-items: center; justify-content: center; width: 96px; height: 96px; border-radius: 50%; background-color: #334155; color: #e2e8f0; font-size: 48px; font-weight: bold; text-transform: uppercase; line-height: 1;">
            LC
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-top: 24px; text-align: center;">
            <div style="font-weight: 500; color: #fff;">
                Name
            </div>
            <div style="margin-top: 4px; font-size: 14px; color: #fff;">
                ID
            </div>
        </div>
    </div>

    <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link " href="pages-blank.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

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
        <a href="calendar.php" class="active">
            <i class="bi bi-circle"></i><span>Events Calendar</span>
        </a>
        </li>
        <li>
        <a href="tables-data.php">
            <i class="bi bi-circle"></i><span>Event Bookings</span>
        </a>
        </li>
        <li>
        <a href="user-management.php">
            <i class="bi bi-circle"></i><span>User Details</span>
        </a>
        </li> <li>
        <a href="#">
            <i class="bi bi-circle"></i><span>Holidays</span>
        </a>
        </li>

      </ul>
      </li><!-- End System Nav -->

      <hr class="sidebar-divider">

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="container">
          <!-- Calendar -->
          <div id="calendar"></div>

          <!-- Booking Form -->
         <!-- Booking Form -->
          <div class="book-event-form">
            <h2>Book Event</h2>
            <form id="bookEventForm">
              <label for="role">Role:</label>
              <select id="role" name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
                <option value="Other">Other</option>
              </select><br>
              <label for="name">Fullname:</label>
              <input type="text" id="name" name="name" required><br>

              <label for="contact">Contact (Phone or Email):</label>
              <input type="text" id="contact" name="contact" required><br>

              <label for="event_title">Event Name:</label>
              <input type="text" id="event_title" name="event_title" required><br>

              <label for="attendees">Attendees:</label>
              <input type="text" id="attendees" name="attendees" required><br>

              <label for="date_booked">Event Date:</label>
              <input type="date" id="date_booked" name="date_booked" required><br>

              <label for="time">Time:</label>
              <input type="time" id="time" name="time" required><br>

              <button type="button" id="bookEventBtn" data-bs-toggle="modal" data-bs-target="#confirmationModal">Submit</button>
            </form>
          </div>


    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationModalLabel">Confirm Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to book this event?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmBookingButton">Confirm</button>
          </div>
        </div>
      </div>
    </div>

  </main>
  
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
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'fetch_events.php',  // URL to fetch events
        eventColor: '#378006', // Customize the color of events
        eventTextColor: '#fff', // Customize the text color of events
        editable: false, // Makes events non-editable (if required)
        displayEventTime: false, // Hides the time in month view
    });
    calendar.render();
});


   
    $(document).ready(function() {
        $('#bookEventForm').on('submit', function(event) {
            event.preventDefault();
              
            $.ajax({
                url: 'submit_event.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'html',  // Expect HTML response
                success: function(response) {
                    // Assuming your PHP script returns a success message in plain text or HTML
                    alert(response);  // Show the response message
                    location.reload();  // Reload the calendar
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);  // General AJAX error handling
                }
            });
        });
    });

    $(document).ready(function() {
        $('.status-form').on('change', function(event) {
            event.preventDefault();
            var $form = $(this);

            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                dataType: 'html',  // Expect HTML response
                success: function(response) {
                    alert(response);  // Show a success message (optional)
                },
                error: function(xhr, status, error) {
                    alert("Error updating status: " + error);
                }
            });
        });
    });

  document.addEventListener('DOMContentLoaded', function() {
    $('#confirmBookingButton').on('click', function() {
      var form = $('#bookEventForm');

      $.ajax({
        url: 'submit_event.php',
        type: 'POST',
        data: form.serialize(),
        dataType: 'html',
        success: function(response) {
          alert(response); // Show the response message
          location.reload(); // Reload the calendar or update as needed
        },
        error: function(xhr, status, error) {
          alert('An error occurred: ' + error); // General AJAX error handling
        }
      });

      // Hide the modal after confirmation
      $('#confirmationModal').modal('hide');
    });
  });

  
</script>

  
</body>

</html>