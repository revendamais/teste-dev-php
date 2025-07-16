<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="container">
    <div class="card col-md-4 m-auto mt-4">
        <form id="chat-form">
            @csrf
            <div class="card-body">
            </div>
            <div class="card-footer d-flex flex-column gap-3">
                <input id="message" class="form-control rounded-pill" placeholder="Escreve sua duvida..." />
                <button id="post-chat-message" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</div>

<script>
const form = document.getElementById('chat-form');
const outputMessageBox = document.querySelector('.card-body');
const ul =document.createElement('ul');
ul.classList.add('list-group');
outputMessageBox.appendChild(ul);
form.addEventListener('submit', async function (event){
    event.preventDefault();
    const message = document.getElementById('message');
    const userli = document.createElement('li');
    userli.classList.add('list-group-item')
    userli.innerHTML = `<span class='fw-bold'> Você: </span><span>${message.value}</span>`;;
    ul.appendChild(userli)
    const chatLi =document.createElement('li');
    chatLi.classList.add('list-group-item');
    const data = {message: message.value}
    await fetch('/api/chat', {
        method: 'POST',
        body: JSON.stringify(data)
    })
    .then(async response => {
        const result = await response.json();
        chatLi.innerHTML = `<span class='fw-bold'> Cconet bot: </span><span>${result.message}</span>`;
        ul.appendChild(chatLi)
        message.value = "";
    })
})

</script>