<!DOCTYPE html>

<html>
    <head>
        <title>Cliente</title>
        <?php include("meta.php") ?>
    </head>
    <body>
        <header>
            <img src="../Immagini/Olympia.png" alt='Non disponibile' id='logo'/>
            <?php 
                include("Login.php");
                include("Cliente.php")
            ?>
        </header>
        <div id='Content2'>
            <?php content($state) ?>
        </div>
        
        <nav>
            <h2> Link Esterni </h2>
            <p>
                <a href='./descrizione.php'> Informazioni </a>
                <br/>
                <a href='./login.php'> Login </a>
            </p>
        </nav>
        <?php include("./footer.php"); ?>
    </body>
</html>


