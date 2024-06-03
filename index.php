<?php
include 'db.php';
include 'functions.php';

$books = getBooks();
$loans = getLoans();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Gestión de Librerías">
    <title>Gestión de Librerías</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section id="inventory">
            <h2>Inventario de Libros</h2>
            <input type="text" id="search" placeholder="Buscar por título o autor...">
            <ul id="book-list">
                <?php foreach($books as $book): ?>
                    <li><?php echo $book['title']; ?> - <?php echo $book['author']; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section id="loans">
            <h2>Préstamos</h2>
            <ul>
                <?php foreach($loans as $loan): ?>
                    <li>
                        <?php echo $loan['book_title']; ?> - <?php echo $loan['borrower']; ?> 
                        <form action="update_status.php" method="post">
                            <input type="hidden" name="loan_id" value="<?php echo $loan['id']; ?>">
                            <select name="status">
                                <option value="prestado" <?php if ($loan['status'] == 'prestado') echo 'selected'; ?>>Prestado</option>
                                <option value="atrasado" <?php if ($loan['status'] == 'atrasado') echo 'selected'; ?>>Atrasado</option>
                                <option value="devuelto" <?php if ($loan['status'] == 'devuelto') echo 'selected'; ?>>Devuelto</option>
                            </select>
                            <button type="submit">Actualizar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Agregar Libro</h2>
            <form action="add_book.php" method="post">
                <input type="text" name="title" placeholder="Título del libro" required>
                <input type="text" name="author" placeholder="Autor del libro" required>
                <button type="submit">Agregar</button>
            </form>
        </section>
        <section>
            <h2>Registrar Préstamo</h2>
            <form action="add_loan.php" method="post">
                <input type="text" name="book_title" placeholder="Título del libro" required>
                <input type="text" name="borrower" placeholder="Nombre del prestatario" required>
                <button type="submit">Registrar</button>
            </form>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="app.js"></script>
</body>
</html>
