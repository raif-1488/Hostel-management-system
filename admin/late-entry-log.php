<?php
$conn = new mysqli("localhost", "hostel", "hostel", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Late Entry Records</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        .container { max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: center; }
        button { padding: 10px 15px; margin: 10px; cursor: pointer; }
        .nav { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Late Entries</h2>

    <!-- Navigation -->
    <div class="nav">
        <a href="late-entry-add-student.php"><button>➕ Add Student</button></a>
    </div>
    
   
   
   
    <!-- Late Entries Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Late Time</th>
            <th>Date</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM late_entries ORDER BY late_time DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['late_time']}</td>
                <td>{$row['date']}</td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
