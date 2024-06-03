<?php
include 'db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loanId = $_POST['loan_id'];
    $status = $_POST['status'];
    updateLoanStatus($loanId, $status);
    header('Location: index.php');
}
?>
