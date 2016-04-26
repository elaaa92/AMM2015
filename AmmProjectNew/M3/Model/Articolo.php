<?php

class Articolo 
{
    private $venditore; 
    private $categoria;
    private $id;
    private $nome;
    private $prezzo;
    private $descrizione;
    private $listaArticoli;
    
    public function __construct($venditore, $categoria, $nome, $prezzo, $descrizione) 
    {
        $this->venditore = $venditore;
        $this->categoria = $categoria;
        if(isset($listaArticoli))
        {
            $this->id = count($listaArticoli);
        }
        else 
        {
            $this->id = 0;
        }
        $this->nome = $nome; 
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $listaArticoli[] = $this;
    }
    
    public function getVenditore()
    {
        return $this->venditore;
    }
    
    public function getCategoria()
    {
        return $this->categoria;
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
    
        
    public static function oggettiInVendita()
    {
        if(!isset($this->listaArticoli))
        {
            $listaArticoli = array();
            $listaArticoli[0] = new Articolo("Nike", "Scarpe", "Scarpe Nike", "60", "Belle scarpe");
            $listaArticoli[1] = new Articolo("Converse", "Scarpe", "Scarpe Converse", "40", "Belle scarpe");
            $listaArticoli[2] = new Articolo("Nike", "Guanti", "Guanti Nike", "20", "Bei guanti da palestra");
            $listaArticoli[3] = new Articolo("Reebook", "Scarpe", "Scarpe Reebok", "30", "Belle scarpe");
            $listaArticoli[4] = new Articolo("Asics", "Abbigliamento", "Tuta sportiva", "40", "Bella tuta");
            $listaArticoli[5] = new Articolo("Burton", "Surf", "Tavola da surf", "500", "Bella tavola");
            $listaArticoli[6] = new Articolo("MTB", "Bicicletta", "Mountain bike", "230", "Bella bici");
            $listaArticoli[7] = new Articolo("Burton", "Abbigliamento", "Giacca da snowboard", "40", "Belle scarpe");
            $listaArticoli[8] = new Articolo("Adidas", "Guanti", "Guanti Adidas", "20", "Bei guanti");
            $listaArticoli[9] = new Articolo("SportsWear", "Abbigliamento", "Canottiera", "30", "Bella canottiera");
        }
        return $listaArticoli; 
    }
    
    public static function cercaVenditore($chiave)
    {
        $find = array();
        foreach($articolo as $listaArticoli)
        {
            if($articolo.getVenditore().equals($chiave))
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }
    
    public static function cercaCategoria($chiave)
    {
        $find = array();
        foreach($articolo as $listaArticoli)
        {
            if($articolo.getCategoria().equals($chiave))
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }
    
    public static function cercaNome($chiave)
    {
        $find = array();
        foreach($articolo as $listaArticoli)
        {
            if($articolo.getNome().equals($chiave))
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }
}
