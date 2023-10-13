<?php include('partials-front/menu.php'); ?>
<?php include('partials-front/login-check.php'); ?>

 
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  transition: background-color 0.5s ease;
}

.contact-container {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

.contact-card {
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.contact-card h2 {
  margin-top: 0;
}

.input-container {
  margin-bottom: 15px;
}

.input-container label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

button:focus {
  outline: none;
}

@media (max-width: 600px) {
  .contact-container {
    padding: 10px;
  }
}

  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contact-form");

  contactForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Simulate sending the form data
    setTimeout(function () {
      // Show the success message
      alert("Message successfully sent!");

      // Reset the form
      contactForm.reset();
    }, 1000);
  });
});

  </script>

  <div class="contact-container">
    <h1>Contact Us</h1>
    
    <div class="contact-card">
      <h2>Get in Touch</h2>
      <form id="contact-form">
        <div class="input-container">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required>
        </div>
        
        <div class="input-container">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>
        
        <div class="input-container">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        

        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
  <script src="script.js"></script>

 <?php include('partials-front/footer.php'); ?>