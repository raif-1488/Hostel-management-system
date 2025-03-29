<?php
$conn = new mysqli("localhost", "hostel", "hostel", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];

    $sql = "INSERT INTO students (student_id, name) VALUES ('$student_id', '$name')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student Added Successfully'); window.location.href='late-entry-log.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        .container { max-width: 600px; margin: auto; }
        form { margin-top: 20px; }
        button { padding: 10px 15px; margin-top: 10px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Student</h2>

    <form method="POST">
        <label>Student ID:</label>
        <input type="text" name="student_id" required>
        
        <label>Name:</label>
        <input type="text" name="name" required>

        <button type="submit">Add Student</button>
    </form>

    <br>
    <a href="late-entry-log.php"><button>🔙 Back to Late Entries</button></a>
</div>

</body>
</html>
