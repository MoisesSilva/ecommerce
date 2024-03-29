<?php

namespace Hcode;

use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "views/")
    {
        //var_dump($this->tpl);
        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            "tpl_dir"   => $tpl_dir,
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"]."views-caches/",
            "debug"     => false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl();

        foreach ($this->options["data"] as $key => $val) {
            $this->tpl->assign($key, $val);
        }

        $this->setData($this->options["data"]);
        //if ($this->options['data']) $this->setData($this->options['data']);
        if ($this->options["header"] === true) $this->tpl->draw("header");

        // Desenhando o header
        //$this->tpl->draw("header");
        
    }

    // Método para receber os dados da view
    private function setData($data = array())
    {
        foreach ($data as $key => $val) {
            $this->tpl->assign($key, $val);
        }
    }

    public function setTpl($tplname, $data = array(), $returnHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($tplname, $returnHTML);

    }

    public function __destruct()
    {   
        // Desenhando o footer
        //$this->tpl->draw("footer");
        if ($this->options["footer"] === true) $this->tpl->draw("footer");
    }

}


?>