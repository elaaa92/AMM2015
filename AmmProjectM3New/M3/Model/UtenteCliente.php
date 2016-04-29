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
        //Recupero da database conto e acquisti e numero acquisti
        //$conto=query
        $this->conto=new Conto(200);
        //$articoliInVendita=query
        $acquisti=array();
        //$nAcquisti=query
        $nAcquisti=array();
        if(isset($acquisti))
        {
            $this->acquisti = $acquisti;
        }
        else
        {
            $this->acquisti = array();
        }
        if(isset($nAcquisti))
        {
            $this->nAcquisti = $nAcquisti;
        }
        else
        {
            $this->nAcquisti = array();
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
    
    public function getAcquisti()
    {
        return $this->acquisti;
    }
    
    public function getNAcquisti()
    {
        return $this->nAcquisti;
    }
    
    public function compraArticolo($articolo, $quantita)
    {
        $costo = $articolo->getPrezzo() * $quantita;
        if($articolo->getDisponibili() >= $quantita && $this->conto->addebito($costo))
        {
            $nome=$articolo->getNome();
            if(isset($this->acquisti[$nome]))
            {
                $this->nAcquisti[$nome]+=$quantita;
            }
            else
            {
                $this->nAcquisti[$nome]=$quantita;
                $this->acquisti[$nome]=$articolo;
            }
            $articolo->getVenditore()->vendiArticolo($articolo, $quantita);
            return true;
        }
        else
        {
            return false;
        }
    }
}
