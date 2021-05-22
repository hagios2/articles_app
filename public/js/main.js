const articles = document.getElementById('articles');

if (articles) {
    articles.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-article') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/articles/delete/${id}/article`, {
                    method: 'DELETE'
                }).then(res => {//console.log(res)
                    window.location.reload()
                });
            }
        }
    });
}
