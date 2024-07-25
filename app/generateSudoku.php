<?php

function generateSudoku() {
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
    $grid = array_fill(0, 9, array_fill(0, 9, ''));

    if (fillGrid($grid, $letters)) {
        return $grid;
    }
}

function fillGrid(&$grid, $letters) {
    for ($row = 0; $row < 9; $row++) {
        for ($col = 0; $col < 9; $col++) {
            if ($grid[$row][$col] === '') {
                shuffle($letters);
                foreach ($letters as $letter) {
                    if (isValid($grid, $row, $col, $letter)) {
                        $grid[$row][$col] = $letter;
                        if (fillGrid($grid, $letters)) {
                            return true;
                        }
                        $grid[$row][$col] = '';
                    }
                }
                return false;
            }
        }
    }
    return true;
}

function isValid($grid, $row, $col, $letter) {
    for ($i = 0; $i < 9; $i++) {
        if ($grid[$row][$i] === $letter) {
            return false;
        }
    }

    for ($i = 0; $i < 9; $i++) {
        if ($grid[$i][$col] === $letter) {
            return false;
        }
    }

    $startRow = $row - $row % 3;
    $startCol = $col - $col % 3;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($grid[$startRow + $i][$startCol + $j] === $letter) {
                return false;
            }
        }
    }

    return true;
}
?>