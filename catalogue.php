<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./asset/css/style-catalogue.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <main>
        <section id="catalogue">
            <div class="row-limit-size">
                <article class="titleDiv">
                    <h1 class="title">Catalogue</h1>
                </article>
                <section>
    <label for="category">Catégorie:</label>
    <select id="category" name="category[]" multiple>
        <option value="kodomo">Kodomo</option>
        <option value="shonen">Shonen</option>
        <option value="shojo">Shojo</option>
        <option value="seinen">Seinen</option>
        <option value="josei">Josei</option>
    </select>
</section>

<section>
    <label for="public">Public:</label>
    <select id="public" name="public[]" multiple>
        <option value="enfant">Enfant</option>
        <option value="adolescent">Adolescent</option>
        <option value="adulte">Adulte</option>
    </select>
</section>

<section>
    <label for="genre">Genre:</label>
    <select id="genre" name="genre[]" multiple>
        <option value="action">Action</option>
        <option value="aventure">Aventure</option>
        <option value="romance">Romance</option>
        <option value="science-fiction">Science-fiction</option>
        <option value="comedie">Comédie</option>
        <option value="drame">Drame</option>
        <option value="fantastic">Fantastique</option>
        <option value="horror">Horreur</option>
        <option value="musical">Musical</option>
        <option value="mistery">Mystère</option>
        <option value="school-life">School-life</option>
        <option value="slice-of-life">Tranche de vie</option>
        <option value="sport">Sport</option>
        <option value="surnaturel">Surnaturel</option>
        <option value="thriller">Thriller</option>
    </select>
</section>



   
        </section>
    </main>
    <script src="./asset/js/main.js"></script>
</body>