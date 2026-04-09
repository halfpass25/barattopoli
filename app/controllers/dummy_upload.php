<?php

Class dummy_upload extends abstractController
{
    function index()
    {
        $data['page_title'] = "Upload (dummy)";
        $this->view("barattopoli/upload_dummy", $data);
    }
}
