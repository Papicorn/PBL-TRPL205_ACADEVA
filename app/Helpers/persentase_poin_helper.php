<?php

if (!function_exists('calculatePercentage')) {
    function calculatePercentage($receivedPoints, $totalPoints) {
        if ($totalPoints == 0) {
            return 0;
        }
        return ($receivedPoints / $totalPoints) * 100;
    }
}

if (!function_exists('determineGrade')) {
    function determineGrade($percentage) {
        if ($percentage >= 85.00) {
            return "A";
        } elseif ($percentage >= 80.00 && $percentage <= 84.99) {
            return "A-";
        } elseif ($percentage >= 75.00 && $percentage <= 79.99) {
            return "B+";
        } elseif ($percentage >= 70.00 && $percentage <= 74.99) {
            return "B";
        } elseif ($percentage >= 65.00 && $percentage <= 69.99) {
            return "B-";
        } elseif ($percentage >= 60.00 && $percentage <= 64.99) {
            return "C+";
        } elseif ($percentage >= 55.00 && $percentage <= 59.99) {
            return "C";
        } elseif ($percentage >= 50.00 && $percentage <= 54.99) {
            return "C-";
        } elseif ($percentage >= 45.00 && $percentage <= 49.99) {
            return "D+";
        } elseif ($percentage >= 40.00 && $percentage <= 44.99) {
            return "D";
        } else {
            return "E";
        }
    }
}
