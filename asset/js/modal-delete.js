let deleteArticle = document.querySelectorAll(".delete");
let main = document.querySelector("main");

//Loop supprimer
for (let deleteArticles of deleteArticle) {
    deleteArticles.addEventListener("click", function () {
        let titre = this.dataset.titre;
        let volume = this.dataset.volume;
        let id = this.dataset.id;


        //Creation Modal Window
        let div = document.createElement('div');
        div.classList.add('modal');
        main.prepend(div);

        document.querySelector('body').style.overflow = 'hidden';

        document.querySelector('.modal').style.display = 'block';

        let container = document.createElement('div');
        container.classList.add('modal-content');
        div.appendChild(container);

        let warning = document.createElement('h1');
        warning.innerHTML = 'Vous êtes sûr de vouloir supprimer ce manga : ' + titre + ' tome.' + volume + ' ?';
        container.appendChild(warning);

        let deletebtn = document.createElement('a');
        deletebtn.classList.add('btn');
        deletebtn.setAttribute("href", "./delete.php?id=" + id);
        deletebtn.innerHTML = 'Confirmer';
        container.appendChild(deletebtn);

        let cancelbtn = document.createElement('a');
        cancelbtn.classList.add('btn');
        cancelbtn.innerHTML = 'Annuler';
        container.appendChild(cancelbtn);

        cancelbtn.addEventListener('click', function () {
            document.querySelector('.modal').style.display = 'none';
        });
    });
};