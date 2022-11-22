let button = document.querySelectorAll('btn-delete');

button.forEach(element => {
    element.addEventListener('click', function(event) {
        let slug = element.id;
        let title = element.getAttribute('title');

        document.getElementById('modal-text').innerHTML = "Are you sure want to remove " + title + "?";
    })
})