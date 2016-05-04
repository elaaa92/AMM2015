<!DOCTYPE html>

<html>
    <head>
        <title>Login</title>
        <?php include("meta.php") ?>
    </head>
    <body>
        <header>
            <img src="../Immagini/logo.png" alt='Non disponibile' id='logo'/>
            <h1> Login </h1>
        </header>
        <div id='Content2'>
            <?php include("Login.php");?>   
            <form method='post'>
                <label for='id'> Username </label>
                <input type='text' id='id' name='id'>
                <br/>
                <label for='password'> Password </label>
                <input type='password' id='password' name='password'>
                <br/>
                <input type='submit' id='login' name='login' value='Login'>     
            </form>
        </div>
        <nav>
            <h2> Link Esterni </h2>
            <a href='./descrizione.php'> Informazioni </a>
            <br/>
            <a href='./cliente.php'> Cliente </a>
            <br/>
            <a href='./venditore.php'>  Venditore </a>
        </nav>
        <?php include("./footer.php"); ?>
    </body>
</html>
