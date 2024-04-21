<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $icNumber = $_POST['icNumber'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];

    // Interests is an array if multiple checkboxes are selected
    if(isset($_POST["interest"])) {
        $interests = implode(", ", $_POST["interest"]);
    } else {
        $interests = ""; // If no interests are selected
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'computer_club_db');
    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (name, icNumber, username, address, gender, email, class, age, telephone, interests) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssis", $name, $icNumber, $username, $address, $gender, $email, $class, $age, $telephone, $interests);
        $execval = $stmt->execute();

        if ($execval) {
            // Redirect to a success page or another page
            header("Location: Registration.php"); // Replace 'success.php' with the actual page you want to redirect to
            exit(); // Ensure no further code execution on this page
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Computer Club Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('19366.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    label {
      display: block;
      margin-top: 10px;
      color: #555;
      display: flex;
      align-items: center;
    }
    
    .checkbox-label {
      display: flex;
      align-items: center;
    }

    .checkbox-label input {
    margin-left: 10px;
    }


    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
      margin-top: 5px;
    }

    input[type="radio"],
    input[type="checkbox"] {
      margin-right: 5px;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-align: center;
      display: inline-block;
      font-size: 14px;
      margin-top: 10px;
      cursor: pointer;
      border-radius: 4px;
    }

    button[type="reset"] {
      background-color: #f44336;
    }

    .error {
      color: #f44336;
      font-size: 12px;
      margin-top: 5px;
    }

    .error-message {
      color: #f44336;
      font-size: 12px;
      margin-top: 5px;
    }

    .header {
      background-color: #333;
      padding: 20px;
      color: #fff;
      text-align: center;
    }

    .logo {
      display: inline-block;
      width: 80px;
      height: 80px;
      background-color: #fff;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .club-name {
      font-size: 24px;
      font-weight: bold;
      margin: 0;
    }

    .tagline {
      font-size: 16px;
      margin: 0;
    }

    .navigation {
      background-color: #f4f4f4;
      padding: 10px;
      text-align: center;
    }

    .navigation a {
      color: #333;
      text-decoration: none;
      padding: 10px 20px;
      margin: 0 10px;
    }

    .navigation a:hover {
      background-color: #333;
      color: #fff;
    }

    .introduction {
      text-align: center;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-image: url('19366.jpg');
      background-size: cover;
      background-position: center;
    }

    .image-placeholder {
      width: 400px;
      height: 200px;
      background-color: #ccc;
      margin-bottom: 20px;
    }

    .membership-message {
      font-size: 18px;
      margin: 20px 0;
      color: #333;
    }
  </style>
</head>
<body>


  <div class="header">
    <img src="logo_sm.png" alt="Computer Club Logo" class="logo">
    <h2 class="club-name">Computer Club</h2><br>
    <p class="tagline">The Best Tech, Best Future.</p>
  </div>
  

  <div class="navigation">
    <a href="home2.html">Home Page</a>
    <a href="activity.html">Activity</a>
    <a href="registration.php">Registration</a>
    <a href="contest.html">Contest</a>
    <a href="contactus.html">Contact Us</a>
    <a href="list.php">All Member List</a>
  </div>


  <h1>Computer Club Registration</h1>

  <form id="registrationForm" action="Registration.php" method="post" onsubmit="validateForm(event)">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required maxlength="50">

    <label for="icNumber">IC Number:</label>
    <input type="text" id="icNumber" name="icNumber" required pattern="\d{12}" placeholder="e.g., 123456789012">

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required minlength="5" maxlength="12">

    <label for="address">Home Address:</label>
    <textarea id="address" name="address" required></textarea>

    <label>Gender:</label><br>
    <div class="radio-label">
      <input type="radio" id="male" name="gender" value="male" required>
      <span>Male</span>
    </div>
    <div class="radio-label">
      <input type="radio" id="female" name="gender" value="female" required>
      <span>Female</span>
    </div><br>
    

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required >

    <label for="class">Class:</label>
    <select id="class" name="class" required>
      <option value="">Select One</option>
      <option value="class1">Year 1</option>
      <option value="class2">Year 2</option>
      <option value="class3">Year 3</option>
    </select>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>

    <label for="telephone">Telephone:</label>
    <input type="tel" id="telephone" name="telephone" required pattern="\d+" placeholder="e.g., 1234567890"><br><br>
    
    <label for="interests">Interests:</label>
    <br>
    <label for="interest1" class="checkbox-label">
      Information Science
      <input type="checkbox" id="interest1" name="interest[]" value="Information Science">
    </label>

    <label for="interest2" class="checkbox-label">
      Software Engineering
      <input type="checkbox" id="interest2" name="interest[]" value="Software Engineering">
    </label>

    <label for="interest3" class="checkbox-label">
      System and Network Technology
      <input type="checkbox" id="interest3" name="interest[]" value="System and Network Technology">
    </label>

    <label for="interest4" class="checkbox-label">
      Multimedia
      <input type="checkbox" id="interest4" name="interest[]" value=" Multimedia">
    </label>

    <label for="interest5" class="checkbox-label">
      Artificial Intelligence
      <input type="checkbox" id="interest5" name="interest[]" value="Artificial Intelligence">
    </label>

    <br>
    
    <!-- Add more interests as needed -->
    <button type="submit">Register</button>
    <button type="reset">Reset</button>
    
  </form>


</body>
</html>
