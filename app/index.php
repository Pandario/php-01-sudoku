<?php

require 'generateSudoku.php';
require 'validation.php';

$sudokuGrid = [];
$validationMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sudokuGrid = generateSudoku();
    $validationMessage = validation($sudokuGrid);
    $isValid = $validationMessage === true;
}
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