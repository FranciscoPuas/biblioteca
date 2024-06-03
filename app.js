document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const bookList = document.getElementById('book-list');
    const books = Array.from(bookList.children);

    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        books.forEach(book => {
            const text = book.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                book.style.display = '';
            } else {
                book.style.display = 'none';
            }
        });
    });
});
