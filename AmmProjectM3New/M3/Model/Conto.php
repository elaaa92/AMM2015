<?php

class Conto
{
    private $saldo;
    
    public function __construct($saldo)
    {
        $this->saldo=$saldo;
    }
    
    public function addebito($costo)
    {
        if($costo<=$this->saldo)
        {   
            $this->saldo-=$costo;
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function accredito($valore)
    {
        $this->saldo+=$valore;
        
        return $this->saldo;
    }
    
    public function getSaldo()
    {
        return $this->saldo;
    }
}
