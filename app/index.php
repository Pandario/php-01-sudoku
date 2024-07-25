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

        <form>
            <button class="btn" type="submit">Generate</button>
        </form>

        <h2>Sudoku</h2>
        <table>
            <?php for ($row = 0; $row < 9; $row++): ?>
                <tr>
                    <?php for ($col = 0; $col < 9; $col++): ?>
                        <td class="block-<?php echo intdiv($row, 3) * 3 + intdiv($col, 3) + 1; ?>"></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</body>
</html>