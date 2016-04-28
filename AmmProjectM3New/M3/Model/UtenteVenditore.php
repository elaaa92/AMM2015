<?php

class UtenteVenditore 
{
    private $id;
    private $password;
    private $conto;
    private $articoliInVendita;
    private $nDisponibili;
    
    public function __construct($id, $password, $conto, $articoliInVendita)
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
        if(isset($articoliInVendita))
        {
            $this->articoliInVendita = $articoliInVendita;
        }
        else
        {
            $this->articoliInVendita = array();
        }
        if(isset($nDisponibili))
        {
            $this->nDisponibili = $nDisponibili;
        }
        else
        {
            $this->nDisponibili = array();
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
    
    public function getArticoli()
    {
        return $this->articoliInVendita;
    }
    
    public function inserisciArticolo($articolo, $quantita)
    {        
        $nome=$articolo.getNome();
        if(isset($this->nDisponibili[$nome]))
        {
            $this->nDisponibili[$nome] += $quantita;
        }
        else
        {
            $this->nDisponibili[$nome] = $quantita;
            $this->articoliInVendita[$nome] = $articolo;
        }
    }
    
    public function rimuoviArticolo($articolo, $quantita)//da rifare
    {
        $nome=$articolo.getNome();
        if(isset($this->nDisponibili[$nome]) 
                && $this->nDisponibili[$nome] == $quantita)
        {
            unset($this->articoliInVendita[$nome]);
            unset($this->nDisponibili[$nome]);
        }
        else if(isset($this->nDisponibili[$nome]) 
                && $this->nDisponibili[$nome] > $quantita)
        {
            $this->nDisponibili[$nome]-=$quantita;
        }
    }
    
    public function vendiArticolo($articolo, $quantita)
    {
        $guadagno = $articolo.getPrezzo() * $quantita;
        rimuoviArticolo($articolo, $quantita);
        $this->conto+=$guadagno;
    }
    
    public function getNDisponibili($articolo)
    {
        $nome=$articolo.getNome();
        return $this->nDisponibili[$nome];
    }
}
