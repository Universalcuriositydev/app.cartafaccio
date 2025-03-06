document.addEventListener('DOMContentLoaded', function () {
    fetch('php/get_counts.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching counts:', data.error);
            } else {
                document.getElementById('articles-count').textContent = data.articles;
                document.getElementById('courses-count').textContent = data.courses;
                document.getElementById('books-count').textContent = data.books;
                document.getElementById('users-count').textContent = data.users;
            }
        })
        .catch(error => console.error('Error fetching counts:', error));
});
