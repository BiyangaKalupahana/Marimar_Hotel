<?php
// ---------------------------
// Database Connection
// ---------------------------
$host = "localhost";   // Database host
$user = "root";        // Database username (default for XAMPP)
$pass = "";            // Database password (default is empty)
$db   = "dragonhousedb"; // Your database name

$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ---------------------------
// Handle Form Submission
// ---------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = $conn->real_escape_string($_POST['name']);
  $email   = $conn->real_escape_string($_POST['email']);
  $subject = $conn->real_escape_string($_POST['subject']);
  $message = $conn->real_escape_string($_POST['message']);

  $sql = "INSERT INTO tblcontactmessages (Name, Email, Subject, Message)
            VALUES ('$name', '$email', '$subject', '$message')";

  if ($conn->query($sql) === TRUE) {
    // ✅ Show alert then redirect to home page
    echo "<script>
                alert('Message sent successfully!');
                window.location.href = 'http://localhost/marimar';
              </script>";
    exit();
  } else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
  }
}
?>


<!-- Contact -->
<h1>Contact Us</h1>
<div class="contact">
  <div class="contact_container">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title text-center">
            <div>Ciao</div>
            <h1>Say Hello</h1>
          </div>
          <div class="contact_text text-center">
            <p>Maecenas sollicitudin tincidunt maximus. Morbi tempus malesuada erat sed pellentesque. Donec pharetra mattis nulla, id laoreet neque scelerisque at. Quisque eget sem non ligula consectetur ultrices in quis augue. Donec imperd iet leo eget tortor dictum, eget varius eros sagittis.</p>
          </div>
          <div class="contact_form_container">
            <!-- ✅ Vertical stacked fields -->
            <form action="contact.php" method="POST" class="contact_form text-center">
              <div class="mb-3">
                <input type="text" name="name" class="contact_input" placeholder="Your name" required="required">
              </div>
              <div class="mb-3">
                <input type="email" name="email" class="contact_input" placeholder="Your email" required="required">
              </div>
              <div class="mb-3">
                <input type="text" name="subject" class="contact_input" placeholder="Subject">
              </div>
              <div class="mb-3">
                <textarea name="message" class="contact_input" placeholder="Message" required="required"></textarea>
              </div>
              <button type="submit" class="contact_button">send message</button>
            </form>
          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- Map -->
  <div class="contact_map_container">
    <div class="map">
      <div id="google_map" class="google_map">
        <div class="map_container">
          <div id="map"></div>
        </div>
      </div>
    </div>

    <!-- Contact Map Content -->
    <div class="contact_map_content">
      <div class="d-flex flex-column align-items-center justify-content-center">
        <img class="contact_info_logo_1" src="images/logo_4.png" alt="">
        <img class="contact_info_logo_2" src="images/logo_2.png" alt="">
        <div class="contact_info_list">
          <ul class="text-center">
            <li>132 Liberty Streetelit, Plano, Texas</li>
            <li>hello@home.com</li>
            <li>214-805-4428</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>