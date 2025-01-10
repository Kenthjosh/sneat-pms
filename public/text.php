<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "systemfinal";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch data
$sql = "SELECT * FROM tbl_users LIMIT $recordsPerPage OFFSET $offset";
$result = $conn->query($sql);

// Calculate total pages
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM tbl_users";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagination Example</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['email'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php if ($totalPages > 1): ?>
    <nav>
        <ul style="list-style: none; display: flex;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li style="margin: 0 5px;">
                <a href="?page=<?= $i ?>"
                   style="text-decoration: none; <?= $i == $page ? 'font-weight: bold;' : '' ?>">
                   <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</body>
</html>
