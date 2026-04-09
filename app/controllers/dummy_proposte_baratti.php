<?php

Class dummy_Proposte_baratti extends abstractController 
{
    function index($idimg = null)
    {
        $data['page_title'] = "Proposte Baratti (dummy)";
        $this->view("barattopoli/proposte_baratti_dummy", $data);
    }
}
