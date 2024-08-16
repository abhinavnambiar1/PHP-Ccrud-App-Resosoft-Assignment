document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('a.delete-record');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            if (!confirm('Are you sure you want to delete this record?')) {
                event.preventDefault();
            }
        });
    });
});
