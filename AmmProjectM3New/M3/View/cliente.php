<!DOCTYPE html>

<html>
    <head>
        <title>Cliente</title>
        <?php include("./meta.php") ?>
    </head>
    <body>
        <header>
            <img src="../../Immagini/logo.png" alt='Non disponibile' id='logo'/>
            <?php 
                include("../Controller/Login.php");
                include("../Controller/Cliente.php");
            ?>
        </header>
        <div id='Content2'>
            <?php content($state) ?>
        </div>
        
        <nav>
            <h2> Link Esterni </h2>
            <a href='./descrizione.php'> Informazioni </a>
            <br/>
            <?php mostraLogin() ?>
        </nav>
        <?php include("./footer.php"); ?>
    </body>
</html>

