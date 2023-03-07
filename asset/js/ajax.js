const btnSearch = document.getElementById('search');
const articles = document.getElementsByClassName('articles');
const form = document.getElementById('form');
const genre = document.getElementById('genre');

form.addEventListener('submit',function(e){ 
   e.preventDefault();
   const genres = Array.from(document.getElementsByName('genre[]'))
    .filter((checkbox) => checkbox.checked)
    .map((checkbox) => checkbox.value);
    const queryParams = new URLSearchParams({
        genre: genres.join(',')
    });
    fetch('./filter.php')

    .then((response)=>response.json())
    .then((datas)=>{
        articles.innerHTML=""; 
        for (const data of datas) {
            let divTitle = document.createElement('div');
            divTitle.innerText=data.id_genre;
           

        } 
    })
})
