const btnSearch = document.getElementById('search');
const articles = document.getElementsByClassName('articles');
const form = document.getElementById('form');
const inputGenre = document.getElementsByClassName('genre');
const arrayGenre=[]
const arrayPublic=[]
const arrayCategory=[]
const inputPublic = document.getElementsByClassName('public');
const inputCategory = document.getElementsByClassName('category');

function boucle( inputItem){
  const arrayItem = []
  for(const items of inputItem){
    if (items.checked){
      arrayItem.push(items.value)
    }
   }
   return arrayItem
}

form.addEventListener('submit',function(e){ 
   e.preventDefault();
   const arrayGenre = boucle(inputGenre)
const arrayPublic= boucle(inputPublic)
const arrayCategory= boucle(inputCategory)
console.log(arrayGenre);
console.log(arrayPublic);
console.log(arrayCategory);
   }
    );
   
    fetch('./filter.php', {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify({genre: arrayGenre, category: arrayCategory, public: arrayPublic})
  })
      .then((response) => response.json())
      .then((datas) => console.log(datas))
    console.log(response);
    
   
   
    
 
    
