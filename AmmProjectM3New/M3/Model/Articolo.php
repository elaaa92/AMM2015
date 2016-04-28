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

    public function __construct($venditore, $categoria, $nome, $prezzo, $descrizione, $disponibili, $immagine) 
    {
        $this->venditore = $venditore;
        $this->categoria = $categoria;
        if(isset($this->listaArticoli))
        {
            $this->id = count($this->listaArticoli);
        }
        $this->nome = $nome; 
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $this->disponibili = $disponibili;
        $this->immagine = $immagine;
        self::$listaArticoli[] = $this;
    }
    
    public static function inizializza()
    {
        self::$listaArticoli = array();
        new Articolo("Nike", "Scarpe", "Scarpe Nike", "60", "Belle scarpe", 10, "../Immagini/scarpenike.png");
        new Articolo("Converse", "Scarpe", "Scarpe Converse", "40", "Belle scarpe", 5, "../Immagini/scarpeconverse.png");
        new Articolo("Nike", "Guanti", "Guanti Nike", "20", "Bei guanti da palestra", 2, "../Immagini/guantinike.png");
        new Articolo("Reebook", "Scarpe", "Scarpe Reebok", "30", "Belle scarpe", 30, "../Immagini/scarpereebok.png");
        new Articolo("Burton", "Surf", "Tavola da surf", "500", "Bella tavola", 100, "../Immagini/tavoladasurf.png");
        new Articolo("MTB", "Bicicletta", "Mountain bike", "230", "Bella bici", 8, "../Immagini/mountainbike.png");
        new Articolo("Burton", "Abbigliamento", "Giacca da snowboard", "40", "Belle scarpe", 3, "../Immagini/giaccasnowboard.png");
        new Articolo("Adidas", "Guanti", "Guanti Adidas", "20", "Bei guanti", 13, "../Immagini/guantiadidas.png");
        new Articolo("SportsWear", "Abbigliamento", "Canottiera", "30", "Bella canottiera", 50, "../Immagini/canottiera.png");
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
    
    public static function oggettiInVendita()
    {
        if(!isset(self::$listaArticoli))
        {
            self::inizializza();
        }
        return self::$listaArticoli; 
    }
    
    public static function cercaVenditore($chiave)
    {
        if(!isset(self::$listaArticoli))
        {
            self::inizializza();
        }
        $find = array();
        foreach(self::$listaArticoli as $articolo)
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
        if(!isset(self::$listaArticoli))
        {
            self::inizializza();
        }
        $find = array();
        foreach(self::$listaArticoli as $articolo)
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
        if(!isset(self::$listaArticoli))
        {
            self::inizializza();
        }        
        $find = array();
        foreach(self::$listaArticoli as $articolo)
        {
            if($articolo.getNome().equals($chiave))
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }

}
