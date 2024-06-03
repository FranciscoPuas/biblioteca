<?php
function getBooks() {
    global $conn;
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getLoans() {
    global $conn;
    $sql = "SELECT loans.id, books.title as book_title, loans.borrower, loans.status FROM loans JOIN books ON loans.book_id = books.id";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addBook($title, $author) {
    global $conn;
    $sql = "INSERT INTO books (title, author) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $author);
    return $stmt->execute();
}

function addLoan($bookTitle, $borrower) {
    global $conn;
    $bookId = getBookIdByTitle($bookTitle);
    if ($bookId) {
        $sql = "INSERT INTO loans (book_id, borrower, status) VALUES (?, ?, 'prestado')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $bookId, $borrower);
        return $stmt->execute();
    }
    return false;
}

function updateLoanStatus($loanId, $status) {
    global $conn;
    $sql = "UPDATE loans SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $loanId);
    return $stmt->execute();
}

function getBookIdByTitle($title) {
    global $conn;
    $sql = "SELECT id FROM books WHERE title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    return $book ? $book['id'] : null;
}
?>
