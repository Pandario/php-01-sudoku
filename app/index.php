<?php

require 'generateSudoku.php';
require 'validation.php';


$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "mysql"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sudokuGrid = [];
$validationMessage = '';
$isValid = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sudokuGrid = generateSudoku();
    $validationMessage = validation($sudokuGrid);
    $isValid = $validationMessage === true;

    if ($isValid) {
        $result = $conn->query("SELECT MAX(id) as max_id FROM sudoku");
        $row = $result->fetch_assoc();
        $nextId = $row['max_id'] + 1;

        $sudokuJson = json_encode($sudokuGrid);
        $stmt = $conn->prepare("INSERT INTO sudoku (id, data) VALUES (?, ?)");
        $stmt->bind_param("is", $nextId, $sudokuJson);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="matrix">
    <form method="POST">
        <button class="btn" type="submit">Generate</button>
    </form>

    <h2>Sudoku</h2>
    <?php if (isset($isValid) && !$isValid): ?>
        <p>The generated Sudoku is not valid: <?php echo $validationMessage; ?></p>
    <?php endif; ?>
    <table>
        <?php for ($row = 0; $row < 9; $row++): ?>
            <tr>
                <?php for ($col = 0; $col < 9; $col++): ?>
                    <td class="block-<?php echo intdiv($row, 3) * 3 + intdiv($col, 3) + 1; ?>">
                        <?php echo isset($sudokuGrid[$row][$col]) ? $sudokuGrid[$row][$col] : ''; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</div>
</body>
</html>