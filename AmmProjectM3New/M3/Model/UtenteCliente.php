<?php

class UtenteCliente
{
    private $id;
    private $password;
    private $conto;
    private $acquisti;
    private $nAcquisti;
    
    public function __construct($id, $password, $conto, $acquisti, $nAcquisti)
    {
        $this->id = $id;
        $this->password = $password;
        if(isset($conto))
        {
            $this->conto = $conto;
        }
        else
        {
            $this->conto = 0;
        }
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
        $costo = $articolo.getPrezzo() * $quantita;
        if($articolo.getNDisponibili() >= $quantita &&
                $conto >= $costo)
        {
            $this->conto-=$costo;
            $nome=$articolo.getNome();
            if(isset($this->acquisti[$nome]))
            {
                $this->nAcquisti[$nome]+=$quantita;
            }
            else
            {
                $this->nAcquisti[$nome]=$quantita;
                $this->acquisti[$nome]=$articolo;
            }
            $articolo.venditore.vendiArticolo($articolo, quantita);
        }
    }
}
