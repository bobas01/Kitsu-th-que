
const form = document.getElementById('form');
const inputGenre = document.getElementsByClassName('genre');
const arrayGenre = []
const arrayPublic = []
const arrayCategory = []
const inputPublic = document.getElementsByClassName('public');
const inputCategory = document.getElementsByClassName('category');

const catalogue = document.getElementById('catalogues');

// fonction pour créer un élément HTML pour chaque article
function createArticle(article) {
  // créer les éléments HTML
  const articleElement = document.createElement('article');
  const figureElement = document.createElement('figure');
  const aElement = document.createElement('a');
  const imgElement = document.createElement('img');
  const divElement = document.createElement('div');
  const h2Element = document.createElement('h2');
  const pElement = document.createElement('p');

  // ajouter les classes et les attributs nécessaires
  articleElement.classList.add('article');
  figureElement.classList.add('article-image');
  aElement.setAttribute('href', './post.php?id=' + article.id);
  imgElement.setAttribute('src', './asset/img/premiere-page/' + article.cover);
  imgElement.setAttribute('alt', 'premièrepage');
  divElement.classList.add('article-content');
  h2Element.classList.add('article-title');
  pElement.classList.add('article-tome');

  // ajouter le contenu des éléments HTML
  h2Element.textContent = article.title;
  pElement.textContent = 'Tome ' + article.volume;

  // ajouter les éléments HTML les uns aux autres
  aElement.appendChild(imgElement);
  figureElement.appendChild(aElement);
  articleElement.appendChild(figureElement);
  divElement.appendChild(h2Element);
  divElement.appendChild(pElement);
  articleElement.appendChild(divElement);

  // renvoyer l'élément HTML créé
  return articleElement;
}

function boucle(inputItem) {
  const arrayItem = []
  for (const items of inputItem) {
    if (items.checked) {
      arrayItem.push(items.value)
    }
  }
  return arrayItem
}

form.addEventListener('submit', function (e) {
  e.preventDefault();
  const arrayGenre = boucle(inputGenre)
  const arrayPublic = boucle(inputPublic)
  const arrayCategory = boucle(inputCategory)
  let url = './filter.php?';
 
  fetch('./filter.php', {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ genre: arrayGenre, category: arrayCategory, public: arrayPublic })
  })
    .then((response) => response.json())
    .then((datas) => {





      // effacer les résultats précédents
      catalogue.innerHTML = '';
      // créer un élément HTML pour chaque article et les ajouter à la page
      datas.forEach(article => {
        const articleElement = createArticle(article);
        catalogue.appendChild(articleElement);
        catalogue.style.display='flex';
        catalogue.style.flexWrap='wrap';
        catalogue.style.justifyContent='space-evenly';
        catalogue.style.maxWidth='1200px';
        catalogue.style.width='100%';
        catalogue.style.margin='0 auto';
      });
    })
    .catch(error => console.log(error));
});







