<?php

Class dummy_Dettaglio_oggetto extends abstractController 
{
    function index($idimg = null)
    {
        $data['page_title'] = "Dettaglio oggetto (dummy)";
        $this->view("barattopoli/dettaglio_oggetto_dummy", $data);
    }
}
