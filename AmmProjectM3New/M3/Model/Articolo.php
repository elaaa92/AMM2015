<?php

class Articolo 
{
    private $venditore;
    private $categoria;
    private $id;
    private $nome;
    private $prezzo;
    private $descrizione;
    private $disponibili;
    private $immagine;
    private static $listaArticoli;
    private static $listaVenditori;
   
    public function __construct($id, $venditore, $categoria, $nome, $prezzo, $descrizione, $disponibili, $immagine) 
    {
        //In fase di creazione di un nuovo oggetto l'id ha un valore standard da aggiornare al 
        //momento dell'aggiunta
        //Quando invece si crea un oggetto a partire dai dati del database l'id è impostato
        $this->id=$id;
        $this->venditore = $venditore;
        $this->categoria=$categoria;
        $this->nome = $nome; 
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $this->disponibili = $disponibili;
        $this->immagine = $immagine;
    }
    
    public function getVenditore()
    {
        return $this->venditore;
    }
    
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nuovoNome) 
    {
        $this->nome = $nuovoNome;
    }
    
    public function getPrezzo()
    {
        return $this->prezzo;
    }
    
    public function setPrezzo($nuovoPrezzo) 
    {
        $this->prezzo = $nuovoPrezzo;
    }
    
        public function getDescr()
    {
        return $this->descrizione;
    }
    
    public function setDescr($nuovaDescr) 
    {
        $this->descrizione = $nuovaDescr;
    }
    
    public function getDisponibili()
    {
        return $this->disponibili;
    }

    public function getImmagine()
    {
        return $this->immagine;
    }
    
    public function aggiungi() //Aggiunge l'articolo al database
    {
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            error_log("Errore nella connessione al server $idErrore: $msg", 0);
            echo "Errore nella connessione $msg";  
            return -1;
        }
        else
        { 
            $nomeVenditore=$this->venditore->getId();
            $match=$mysqli->query("select * from articoli where venditore='$nomeVenditore' and nome='$this->nome'");
            echo $mysqli->error;
            if($match->num_rows > 0)
            {
                $found=$match->fetch_array();

                $this->id=$found['id'];
                mysqli_close($mysqli);
                return 0;
            }
            else
            {
                $this->id=$mysqli->query("select * from articoli")->num_rows;
            

                $result=$mysqli->query("insert into articoli (id, venditore, categoria, nome, prezzo,"
                . " descrizione, disponibili, immagine) values (default, '$nomeVenditore', "
                . "'$this->categoria', '$this->nome', $this->prezzo, '$this->descrizione',"
                . " $this->disponibili, '$this->immagine')");

                mysqli_close($mysqli);
                return 1;
            }
        }
    }
    
    public function rimuovi()
    {
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            error_log("Errore nella connessione al server $idErrore: $msg", 0);
            echo "Errore nella connessione $msg";
            return false;
        }
        else
        {
            $mysqli->query("delete from articoli where id='$this->id'");
            mysqli_close($mysqli);
            return true;
        }
    }
    
    public function modifica()      //La funzione viene chiamata sull'articolo modificato 
    {
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            error_log("Errore nella connessione al server $idErrore: $msg", 0);
            echo "Errore nella connessione $msg";    
            return false;
        }
        else
        {
            $nomeVenditore=$this->venditore->getId();
            $mysqli->query("update articoli set venditore='$nomeVenditore', "
                . "categoria='$this->categoria', nome='$this->nome', prezzo=$this->prezzo, "
                . "descrizione='$this->descrizione', disponibili=$this->disponibili, "
                . "immagine='$this->immagine' where id=$this->id");
            mysqli_close($mysqli);
            return true;
        }
    }
    
    public static function oggettiInVendita($nomeVenditore, $filtro, $chiave)
    {
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            error_log("Errore nella connessione al server $idErrore: $msg", 0);
            echo "Errore nella connessione $msg";    
            return null;
        }
        else
        {
            $query="select articoli.id,articoli.venditore,articoli.categoria,articoli.nome,"
                    . "articoli.prezzo,articoli.descrizione,articoli.disponibili,articoli.immagine,"
                    . "utenti.password,utenti.conto from articoli inner join utenti on articoli.venditore=utenti.id";
            if($nomeVenditore != null)
            {
                $cond=" where articoli.venditore='$nomeVenditore'";
            }
            if($filtro != 'tutto' && $chiave != 'tutto')
            {
                if(!isset($cond))
                {
                    $cond=" where articoli." . $filtro . "='$chiave'";  //la chiave è una stringa dentro la query
                }
                else
                {
                    $cond.=" and articoli." . $filtro . "='$chiave'";
                }
            }
            else if($filtro == 'tutto' && $chiave != 'tutto') //filtro non impostato ma chiave impostata
            {
                if(!isset($cond))
                {
                    $cond=" where articoli.nome like '%$chiave%' or articoli.nome like 'chiave%' "
                    . "or articoli.nome like '%chiave'"
                    . " or articoli.descrizione like '%$chiave%' or articoli.descrizione like '$chiave%'"
                    . "or articoli.descrizione like '%$chiave'";
                    
                }
                else
                {
                    $cond.=" and (articoli.nome like '%$chiave%' or articoli.nome like 'chiave%' "
                    . "or articoli.nome like '%chiave'"
                    . " or articoli.descrizione like '%$chiave%' or articoli.descrizione like '$chiave%'"
                    . "or articoli.descrizione like '%$chiave')";
                }
            }
            if(!isset($cond))
            {
                $cond='';
            }
            $lista=$mysqli->query($query . $cond);
            if($lista->num_rows > 0)
            {
                mysqli_close($mysqli);
                return self::creaLista($lista);
            }
            else
            {
                mysqli_close($mysqli);
                return null;
            }
        }
    }
    
    
    public static function creaLista($lista)
    {
        $listaArticoli = [];
        while($elemento = $lista->fetch_array())
        {
            $idArticolo=$elemento['id'];
            $venditoreArticolo=new UtenteVenditore ($elemento['venditore'],$elemento['password'],
            $elemento['conto']);
            $listaArticoli["$idArticolo"] = new Articolo ($idArticolo, $venditoreArticolo, 
            $elemento['categoria'], $elemento['nome'], $elemento['prezzo'],
            $elemento['descrizione'], $elemento['disponibili'], 
            $elemento['immagine']);
        }
        return $listaArticoli;
    }
}