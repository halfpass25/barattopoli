<?php

Class notfound404 extends abstractController
{
	function index()
	{

		//controlliamo sempre se l'utente è loggato...
		 $this->requireLogin(); // controlla sessione

		 
 	 	//Per la Home page di prova del Frankenwork assegniamo solo il titolo...
 	 	$data['page_title'] =  "404 | Page Not Found";




 	 	//e al resto del layout con gli eventuali dati dinamici, ci pensa la view.
		$this->view("barattopoli/_404",$data);
	}

}