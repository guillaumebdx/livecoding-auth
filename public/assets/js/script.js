const stars = document.getElementsByClassName('fa-star');
const alertMessage = document.getElementById('alert-message');
for (let i=0; i < stars.length; i++) {
    stars[i].addEventListener('click', event => {
        fetch('/favorite/add', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'item' : event.target.dataset.itemid,
                'user' : event.target.dataset.userid
                }),
        })
            .then(response => response.json())
            .then(data => alertMessage.innerHTML = data.item + ' a bien été ajouté', alertMessage.classList.add('alert'))
            .catch((e) => console.log(e))
    })
}
