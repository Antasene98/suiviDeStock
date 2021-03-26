<?php

class produits
{
    // table fields
    public $id;
    public $qtStock;
    public $nom;
    public $ref;

    // message string
    public $id_msg;
    public $qtStock_msg;
    public $name_msg;
    public $ref_msg;

    // constructor set default value
    function __construct()
    {
        $id=0;$qtStock=$nom="";
        $id_msg=$qtStock_msg=$ref_msg=$name_msg="";
    }
}

?>