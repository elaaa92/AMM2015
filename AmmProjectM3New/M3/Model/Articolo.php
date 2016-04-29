<?php

class Articolo 
{
    private $venditore;
    private $id;
    private $nome;
    private $prezzo;
    private $descrizione;
    private $disponibili;
    private $immagine;
    private static $listaArticoli;
    private static $listaVenditori;

    public function __construct($venditore, $nome, $prezzo, $descrizione, $disponibili, $immagine) 
    {
        $this->venditore = $venditore;
        if(isset(self::$listaArticoli))
        {
            $this->id = count(self::$listaArticoli);
        }
        else
        {
            self::$listaArticoli=array();
        }
        $this->nome = $nome; 
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $this->disponibili = $disponibili;
        $this->immagine = $immagine;
        self::$listaArticoli[] = $this;
        self::$listaVenditori[]=$venditore;
    }
    
    public static function inizializzaVenditori()
    {
        self::$listaVenditori=array();
        self::$listaVenditori[]=new UtenteVenditore("Nike", "1234");
        self::$listaVenditori[]=new UtenteVenditore("Converse", "1234");
        self::$listaVenditori[]=new UtenteVenditore("Reebok", "1234");
        self::$listaVenditori[]=new UtenteVenditore("Burton", "1234");
        self::$listaVenditori[]=new UtenteVenditore("MTB", "1234");
        self::$listaVenditori[]=new UtenteVenditore("Adidas", "1234");
        self::$listaVenditori[]=new UtenteVenditore("SportsWear", "1234");
    }
    
    public static function inizializza()
    {
        self::inizializzaVenditori();
        self::$listaArticoli = array();
        new Articolo(self::$listaVenditori[0], "Scarpe Nike", 60, "Belle scarpe", 10, "../Immagini/scarpenike.png");
        new Articolo(self::$listaVenditori[1], "Scarpe Converse", 40, "Belle scarpe", 5, "../Immagini/scarpeconverse.png");
        new Articolo(self::$listaVenditori[0], "Guanti Nike", 20, "Bei guanti", 2, "../Immagini/guantinike.png");
        new Articolo(self::$listaVenditori[2], "Scarpe Reebok", 30, "Belle scarpe", 30, "../Immagini/scarpereebok.png");
        new Articolo(self::$listaVenditori[3], "Tavola da surf", 500, "Bella tavola", 100, "../Immagini/tavoladasurf.png");
        new Articolo(self::$listaVenditori[4], "Mountain bike", 230, "Bella bici", 8, "../Immagini/mountainbike.png");
        new Articolo(self::$listaVenditori[3],  "Giacca da snowboard", 40, "Bella giacca", 3, "../Immagini/giaccasnowboard.png");
        new Articolo(self::$listaVenditori[5], "Guanti Adidas", 20, "Bei guanti", 13, "../Immagini/guantiadidas.png");
        new Articolo(self::$listaVenditori[6], "Canottiera", 30, "Bella canottiera", 50, "../Immagini/canottiera.png");
    }
    
    public function getVenditore()
    {
        return $this->venditore;
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
            if($articolo->getVenditore()->getId() == $chiave)
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
            if($articolo->getNome() == $chiave)
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }
    
    public static function cercaId($chiave)
    {
        if(!isset(self::$listaArticoli))
        {
            self::inizializza();
        }
        $find = array();
        foreach(self::$listaArticoli as $articolo)
        {
            if($articolo->getId() == $chiave)
            {
                $find[] = $articolo;
            }
        }
        return $find;
    }
    
    public static function venditori()
    {
        if(!isset(self::$listaVenditori))
        {
            self::inizializzaVenditori();
        }
    }

}
