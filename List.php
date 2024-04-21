<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Registered Users</title> 
    <style> 
        
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('19366.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            }

            h1 {
            text-align: center;
            color: #333;
            }

            .activity-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url('background-image.jpg');
            background-size: cover;
            }

            .activity {
            margin-bottom: 20px;
            text-align: center;
            }

            .activity img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
            }

            .activity h2 {
            margin: 0;
            color: #333;
            }

            .activity p {
            margin: 10px 0;
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

            .table-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            overflow-x: auto; 
            text-align: center; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }


    </style> 

</head> 
<body> 

    <div class="header">
        <img src="logo_sm.png" alt="Computer Club Logo" class="logo">
        <h3 class="club-name">Computer Club</h3><br>
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
 
<?php 
// Database connection 
$conn = new mysqli('localhost', 'root', '', 'computer_club_db'); 
if ($conn->connect_error) { 
    die("Connection Failed: " . $conn->connect_error); 
} 
 
// Retrieve data from the database 
$result = $conn->query("SELECT * FROM registration"); 
 
// Check if any rows were returned 
if ($result->num_rows > 0) { 
    echo "<table>"; 
    echo "<tr><th>Name</th><th>IC Number</th><th>Username</th><th>Address</th><th>Gender</th><th>Email</th><th>Class</th><th>Age</th><th>Telephone</th><th>Interests</th></tr>"; 
 
    // Output data of each row 
    while ($row = $result->fetch_assoc()) { 
        echo "<tr>"; 
        echo "<td>" . htmlspecialchars($row['name']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['icNumber']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['username']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['address']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['gender']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['email']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['class']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['age']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['telephone']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['interests']) . "</td>"; 
        echo "</tr>"; 
    } 
 
    echo "</table>"; 
} else { 
    echo "<h2>No registered users.</h2>"; 
} 
 
// Close the database connection 
$conn->close(); 
?> 
 
</body> 
</html>