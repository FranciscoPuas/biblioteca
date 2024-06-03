<?php
include 'db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookTitle = $_POST['book_title'];
    $borrower = $_POST['borrower'];
    addLoan($bookTitle, $borrower);
    header('Location: index.php');
}
?>
