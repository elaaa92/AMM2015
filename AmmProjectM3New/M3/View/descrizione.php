<!DOCTYPE html>

<html>
    <head>
        <title>Descrizione</title>
        <?php include("./meta.php") ?>
    </head>
    <body>
        <header>
            <img src="../../Immagini/logo.png" alt='Non disponibile' id='logo'/>
            <?php include("../Controller/Login.php")?>
            <h1> About </h1>
        </header>
        <div id='Sommario'>
            <h2> Indice </h2>
            <a href='#compra'> Compra </a>
            <br/>
            <a href='#vendi'> Vendi </a>
        </div>
        <div id='Content1'>
                <h1>Olympia Store</h1>
                <h2>Vestiti, scarpe, accessori e tutto il necessario per il tuo sport</h2>
                     
            <h3 id='compra'>Compra</h3>
            <p> 
                Scegli tra le sezioni dedicate ai diversi sport.
                <br/>
                Trova l'articolo che ti piace, aggiungilo al carrello o compralo subito.
                <br/>
                Dai un voto ai venditori, le tue recensioni saranno utili agli altri utenti!
            </p>
            
            <h3 id='vendi'>Inserisci il tuo articolo</h3>
            <p>
                Hai un articolo da vendere? Iscriviti e inseriscilo in poche semplici mosse!
            </p>
                  
        </div>
        <nav>
            <h2> Link Esterni </h2>
            <?php mostraLogin() ?>
        </nav>
        <?php include("./footer.php");?>
    </body>
</html>
