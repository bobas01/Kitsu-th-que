<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <main>
        <section id="news">
            <div class="row-limit-size">
                <article class="titleDiv">
                    <h1 class="title">Les nouveautés</h1>
                </article>
                <div id="slider">
                    <div id="leftArrow">
                        <img src="./asset/img/icon/flèche-gauche.svg" alt="left arrow">
                    </div>
                    <div id="window-slider">
                        <div id="list-slide">
                            <div class="slide"><img src="./asset/img/première-page/One-Pieceédition-originale-t.103.jpg" alt="One Piece - édition originale t.103"></div>
                            <div class="slide"><img src="./asset/img/première-page/OnePiecedition-originalet.102.jpg" alt="One Piece - édition originale t.102.jpg"></div>
                            <div class="slide"><img src="./asset/img/première-page/OnePieceédition-originale-t.101.jpeg" alt="One Piece - édition originale t.101.jpg"></div>
                            <div class="slide"><img src="./asset/img/première-page/OnePieceéditionoriginalet.100.jpeg" alt="One Piece - édition originale t.100.jpg"></div>
                            <div class="slide"><img src="./asset/img/première-page/OnePieceédition-originalet.99.jpg" alt="One Piece - édition originale t.99.jpg"></div>
                            <div class="slide"><img src="./asset/img/première-page/One-Pieceédition-originale-t.103.jpg" alt="One Piece - édition originale t.103"></div>
                        </div>
                    </div>
                    <div id="rightArrow">
                        <img src="./asset/img/icon/flèche-droite.svg" alt="right arrow">
                    </div>


                </div>
                <figure id="swipe"><img src="./asset/img/icon/icon-swipe.svg" alt="swipe" style="width: 50px; height: 50px;"></figure>


            </div>
        </section>
        <section id="event">
            <div class="row-limit-size">

                <article class="titleDiv">
                    <h1 class="title"> Nos événements</h1>
                </article>
                <div id=eventran>
                    <div id="imgEvent">
                        <img src="./asset/img/photo/kevin-tran-250.jpg" alt="Kévin Tran">
                        <img src="./asset/img/première-page/ki&hi.png" alt="KI&HI">
                    </div>
                    <p>Dédicace de Kevin Tran le 30/03/2023 de 14h à 18h pour son dernier manga KI & HI.</p>
                </div>

            </div>
        </section>
        <section id="place">
            <div class="row-limit-size">

                <article class="titleDiv">
                    <h1 class="title"> Notre mangathèque</h1>
                </article>
                <div id=placeKitsu>
                    <p>Un endroit chaleureux, accessible à tous (accès pour personne à handicap) pour tous des plus petits avec Pokémon les ados avec Naruto ou les plus vieux avec Berserk
                        pour lire sur place ou chez vous avec un personnel très accueillant. </p>
                    <div id="imgPlace">
                        <img id="firstImgPlace" src="./asset/img/photo/musee-manga-kyoto-3.jpg" alt="Kespace de lecture">
                        <img id="secondImgPlace" src="./asset/img/photo/espace-accuieller.jpg" alt="rayon de la mangathèque">
                        <img id="thirdImgPlace" src="./asset/img/photo/trogstad_public_library_no_013.jpg" alt="accueil">
                    </div>

                </div>

            </div>
        </section>
        <section id="suggestion">
            <div class="row-limit-size">
            <article class="titleDiv">
                    <h1 class="title">Vos suggestions</h1>
                </article>

                <div id="suggestion-container">
                    <p>Envoyer nous  vos suggestions pour les prochains tomes ou nouveau manga qui vous interresserai :</p>
                    <form action="/submit-suggestion">
                        
                        <input type="text" id="suggestion" name="suggestion" placeholder="Vos suggestion">
                        <button type="submit">Envoyer</button>
                    </form>
                </div>

            </div>
        </section>

    </main>
   
    <script src="./asset/js/main.js"></script>
</body>

</html>