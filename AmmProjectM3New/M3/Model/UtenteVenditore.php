<?php

class UtenteVenditore 
{
    private $id;
    private $password;
    private $conto;
    
    public function __construct($id, $password)
    {
        $this->id = $id;
        $this->password = $password;
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            error_log("Errore nella connessione al server $idErrore: $msg", 0);
            echo "Errore nella connessione $msg";
            $this->conto=new Conto(0);
        }
        else
        {
            $data=$mysqli->query("select conto from utenti where id='$this->id'")->fetch_array();
            $this->conto=new Conto($data['conto']);
            mysqli_close($mysqli);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getPwd()
    {
        return $this->password;
    }
    
    public function setPwd($password)
    {
        $this->password = $password;
    }
    
    public function getConto()
    {
        return $this->conto;
    }
    
    public function inserisciArticolo($articolo)
    {
        return $articolo->aggiungi(); 
    }
    
    public function rimuoviArticolo($articolo, $quantita, $erase)
    {
        return $articolo->rimuovi();
    }
    
    public function modificaArticolo($articoloMod)
    {
        return $articoloMod->modifica();
    }
}
