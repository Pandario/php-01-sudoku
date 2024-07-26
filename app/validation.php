<?php

function validation($grid) {
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

    for ($i = 0; $i < 9; $i++) {
        $rowCheck = $letters;
        $colCheck = $letters;

        for ($j = 0; $j < 9; $j++) {
            $rowLetter = $grid[$i][$j];
            $colLetter = $grid[$j][$i];

            if (($key = array_search($rowLetter, $rowCheck)) !== false) {
                unset($rowCheck[$key]);
            } else {
                return "Letter '$rowLetter' found in row $i";
            }

            if (($key = array_search($colLetter, $colCheck)) !== false) {
                unset($colCheck[$key]);
            } else {
                return "Letter '$colLetter' found in column $j";
            }
        }
    }

    for ($blockRow = 0; $blockRow < 3; $blockRow++) {
        for ($blockCol = 0; $blockCol < 3; $blockCol++) {
            $blockCheck = $letters;
            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    $letter = $grid[$blockRow * 3 + $i][$blockCol * 3 + $j];
                    if (($key = array_search($letter, $blockCheck)) !== false) {
                        unset($blockCheck[$key]);
                    } else {
                        return "Letter '$letter' found in 3x3 block starting at row " . ($blockRow * 3) . ", column " . ($blockCol * 3);
                    }
                }
            }
        }
    }

    return true;
}
?>