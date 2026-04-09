<?php $this->view("barattopoli/header",$data);?>

<?php
/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/
?>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand font-weight-bolder mr-3" href="home">	<img class="logo-before" src="<?=ASSETS?>barattopoli/img/logo.jpg" alt="LOGO">
</a>
    <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsDefault">
    	<ul class="navbar-nav mr-auto align-items-center">
    		<form class="bd-search hidden-sm-down">
    			<input type="text" class="form-control bg-graylight border-0 font-weight-bold" id="search-input" placeholder="Ricerca oggetti..." autocomplete="off">
    			<div class="dropdown-menu bd-search-results" id="search-results">
    			</div>
    		</form>
    	</ul>

		<div> 
			<img class="logo" src="<?=ASSETS?>barattopoli/img/logone_baratto.png" style="width:400px;height:80px">
		</div>
    	<ul class="navbar-nav ml-auto align-items-center">
		<li class="nav-item">
    		<a class="nav-link" href="profilo"><img class="rounded-circle mr-2" src="<?=ASSETS?>barattopoli/img/av.png" style="width:40px;height:40px;"><span class="align-middle"><?php echo "Ciao ". "<strong>".$_SESSION['user_name']?></strong></span></a>
			<?php echo "UID ". "<strong>".$_SESSION['user_id']?></strong></span></a>
    		</li>
    		<li class="nav-item">
    		<a class="nav-link " href="upload">Carica Oggetti</a>
    		</li>
    		<li class="nav-item">
    		<a class="nav-link" href="proposte_baratti">Proposte Baratti</a>
    		</li>
			<li class="nav-item">
    		<a class="nav-link" href="ricerca">Blog</a>
    		</li>
			<li class="nav-item">
    		<a class="nav-link" href="logout">Esci</a>
    		</li>
    	</ul>
    </div>
    </nav>    
    <main role="main">
        
    
   

	<?php $this->view("barattopoli/footer",$data);?>
