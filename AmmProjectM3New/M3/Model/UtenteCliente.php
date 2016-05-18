<?php

class UtenteCliente
{
    private $id;
    private $password;
    private $conto;
    private $acquisti;
    private $nAcquisti;
    
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
    
    public function compraArticolo($articolo, $quantita)
    {
        //Step 1
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            return -1;
        }
        else
        {
            $idArticolo = $articolo->getId();
            
            $mysqli->autocommit(false);
            $result=$mysqli->query("select disponibili from articoli where id=$idArticolo")->fetch_array();

            if($mysqli->errno != 0 ) //Errore in una query
            {
                $mysqli->rollback();
                mysqli_close($mysqli);
                return -1;
            }
            
            $disponibili=$result['disponibili'];
            if($disponibili > $quantita)
            {
                $mysqli->query("update articoli set disponibili=($disponibili-$quantita) where id=$idArticolo");
            }
            else if($disponibili == $quantita)
            {
                $mysqli->query("delete from articoli where id='$idArticolo'");
            }
            else
            {
                //Non ha effettuato alcuna modifica
                mysqli_close($mysqli);
                return 1;
            }   
            
            if($mysqli->errno != 0 )
            {
                $mysqli->rollback();
                mysqli_close($mysqli);
                return -1;
            }
        
            //Step 2

            $costo = $articolo->getPrezzo() * $quantita;
            $result=$this->conto->addebito($costo);
            
            if(!$result)
            {
                $mysqli->rollback();
                mysqli_close($mysqli);
                return 2;
            }
            
            $saldo=$this->conto->getSaldo();
            
            $mysqli->query("update utenti set conto=$saldo where id='$this->id'");

            if($mysqli->errno != 0 )
            {
                $mysqli->rollback();
                mysqli_close($mysqli);
                return -1;
            }

            //Step 3

            $venditore=$articolo->getVenditore();
            $idVenditore = $venditore->getId();
            $venditore->getConto()->accredito($costo);
            
            $mysqli->query("update utenti set conto=$saldo where id='$idVenditore'");

            if($mysqli->errno != 0 )
            {
                $mysqli->rollback();
                mysqli_close($mysqli);
                return -1;
            }
            
            $mysqli->commit();
            return 0;
        }
        
    }
}
