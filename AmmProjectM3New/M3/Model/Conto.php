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
        if($costo>$this->saldo)
        {
            return false;
        }
        else
        {
            $this->saldo-=$costo;
            return true;
        }
    }
    
    public function accredito($valore)
    {
        $this->saldo+=$valore;
    }
}
