<?php
$conn = new mysqli("localhost", "hostel", "hostel", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';


// Modify SQL query to filter results based on Student_ID or Name
$sql = "SELECT * FROM girl_log_records ";

if ($search !== '') {
    $sql .= " WHERE Student_ID LIKE '%$search%' OR name LIKE '%$search%'";
}
$sql .= "ORDER BY date DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Log Records</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; text-align: center; border: 1px solid black; }
        .btn { padding: 5px 10px; cursor: pointer; }
        
        .search-container { text-align: right; margin: 10px 5%; }
        .search-input { padding: 8px; width: 250px; }
        .search-btn { padding: 8px 12px; cursor: pointer; }
        
        
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Log Records</h2>



<div class="search-container">
    <form method="GET">
        <input type="text" name="search" class="search-input" placeholder="Search by Student_ID or Name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="search-btn">Search</button>
    </form>
</div>


<table>
    <tr>
        <th>Name</th>       
        <th>Date</th>
        <th>Medical Emergency</th>
        <th>Alcoholic Substance</th>
        <th>Theft Record</th>
       <!-- <th>Late Entry</th> -->
        <th>Student_ID</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td>
		    <?= $row['medical_emergency'] ?> 
		    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'medical_emergency',this, 'increment')">+</button>  
		    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'medical_emergency',this, 'decrement')">-</button>
            </td>
            <td>
                    <?= $row['alcoholic_substance'] ?> 
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'alcoholic_substance',this, 'increment')">+</button>  
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'alcoholic_substance',this, 'decrement')">-</button>
            </td>
            <td>
                    <?= $row['theft_record'] ?> 
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'theft_record',this, 'increment')">+</button>      
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'theft_record',this, 'decrement')">-</button>
            </td>
            <!-- <td>    
                    <?= $row['late_entry'] ?> 
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'late_entry',this, 'increment')">+</button> 
                    <button class="btn" onclick="updateLog(<?= $row['id'] ?>, 'late_entry',this, 'decrement')">-</button>
            </td>-->
            
            <td><?= $row['Student_ID'] ?></td>
            
      </tr>
    <?php } ?>
</table>

<script>
function updateLog(studentId, field, button, action) {

    fetch('update-log-records.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + studentId + '&field=' + field + '&action=' + action
    })
    .then(response => response.text())
    .then(data => {
        
        if(data.includes("Updated successfully")) {
           let parent  = button.parentElement;
           let countSpan = parent.childNodes[0];
           let currentValue = parseInt(countSpan.nodeValue.trim()); // Fix: Convert to number
           
           
           if (action === 'increment') {
               countSpan.nodeValue = currentValue + 1;
           } else if (action === 'decrement' && currentValue > 0) { 
               countSpan.nodeValue = currentValue - 1; // Prevent negative values
           }
        } else {
             alert("Error updating record"); 
        }
    });
    
    
}


</script>

</body>
</html>

<?php $conn->close(); ?>
