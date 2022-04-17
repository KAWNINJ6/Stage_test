<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./views/style/style.css" rel="stylesheet">
    <script defer src="./views/script/script.js"></script>
    <title>Home</title>
</head>
<body>
    <div id="header">

        <form method="post" action="./controllers/Users.php">

            <input type="hidden" name="type" value="login">
            <li>
                <label for="email">Adresse e-mail ou mobile</label><br>
                <input type="text" class="login" name="login" placeholder="Votre login">
            </li>
            <li>
                <label for="password">Mot de passe</label><br>
                <input type="password" class="password" name="password" placeholder="Votre mot de passe"><br>
                <a href="#">Informations de compte oubliées ?</a>    
            </li>

            <li><input type="submit" value="Connexion"></li>
        </form>
    </div>

    <div id="register">

        <form method="post" action="./controllers/Users.php">
            <h1>Inscription</h1>
            <p>C'est gratuit (et ça le restera toujours)</p>

            <input type="hidden" name="type" value="register">
            <li class="username">
                <input type="text" placeholder="Prénom" name="firstname" class="firstname">
                <input type="text" placeholder="Nom de famille" name= "lastname" class="lastname">
            </li>
            <li>
                <input type="text" placeholder="Numéro de mobile ou email" name="login" class="login">
            </li>
            <li>
                <input type="text" placeholder="Confirmer numéro de mobile ou email" name="login" class="login">
            </li>
            <li>
                <input type="password" placeholder="Nouveau mot de passe" name="password" class="password">
            </li>

            <p>Date de naissance</p>
            <div class="birthday">
                <select name="day" id="day">
                    <option value="0">Jour</option>
                </select>
                <select name="month" id="month">
                    <option value="0">Mois</option>
                </select>
                <select name="year" id="year">
                    <option value="0">Année</option>
                </select>
                <a href="#">Pourquoi indiquer ma <br> date de naissance ?</a>
            </div>

            <li class="gender">
                <input type="radio" id="f" name="gender" value="femme">
                <label for="f">Femme</label>
                
                <input type="radio" id="h" name="gender" value="homme">
                <label for="h">Homme</label>
            </li>

            <li class="terms">En cliquant sur inscription, vous acceptez nos 
                <a href="#">Conditions</a> et <br> indiquez que vous avez lu notre 
                <a href="#">Politique d'utilisation des <br> données</a>,  y compris notre 
                <a href="#">utilisation des cookies</a>. Vous <br> pourrez recevoir 
                des notifications  par texto de la part de <br> Facebook et pouvez vous 
                désabonner à tout moment.
            </li>

            <p role="alert" hidden></p>
            <li><input type="submit" value="Inscription"></li>
        </form>
    </div>
</body>
</html>