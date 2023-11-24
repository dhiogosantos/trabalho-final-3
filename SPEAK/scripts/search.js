document.addEventListener('DOMContentLoaded', function () {
    const searchBar = document.getElementsByClassName('search-input')[0];
    searchBar.addEventListener('input', function () {
        filterTable(searchBar.value.toLowerCase());
    });

    function filterTable(searchText) {
        const rows = document.querySelectorAll('.card');

        rows.forEach(function (row) {
            const name = row.querySelector('.card-title').textContent.toLowerCase();
            if (name.includes(searchText)) {
                row.parentElement.style.display = 'block';
            } else {
                row.parentElement.style.display = 'none';
            }
        });
    }
});