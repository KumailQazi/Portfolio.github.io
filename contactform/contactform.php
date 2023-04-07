<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form fields and sanitize the data
  $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

  // Check that all required fields are filled in
  if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all required fields.";
    exit;
  }

  // Build the email message
  $to = "krmaazha@outlook.com";
  $subject = "New message from contact form";
  $body = "Name: $name\n\nEmail: $email\n\nMessage:\n$message";

  // Set the email headers
  $headers = "From: $name <$email>";

  // Send the email
  if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Thank you for your message! I will be in touch soon.";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
}
?>
