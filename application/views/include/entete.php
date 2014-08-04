<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="public"/>
    <meta name="viewport" content="width=device-width" />
    <title>Tableau de bord </title>

  
      <link rel="stylesheet" href="<?php echo css_url('bootstrap.min') ?>">
      <link rel="stylesheet" href="<?php echo css_url('mystyle') ?>">

    <script type="text/javascript" src="<?php echo js_url('jquery_1.10.min') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('angular.min') ?>"></script>
     <script type="text/javascript" src="<?php echo js_url('angular-touch.min') ?>"></script>
      <script type="text/javascript" src="<?php echo js_url('angular-animate.min') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('myapp') ?>"></script>
 
</head>

<body ng-app="domo">
    <!--[if lt IE 7]>
             <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
         <![endif]-->
    <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

<div class="row" >
    <div id="bartop">
    </div>    
</div>

<div class="row barre_menu" >
     <a href="<?php echo base_url() ;?>" class="btn btn-green ">
        <span class="glyphicon glyphicon-2x glyphicon-home"> </span>
    </a>

     <a href="<?php echo base_url() ;?>index.php/modules/" class="btn btn-green ">
        <span class="glyphicon glyphicon-2x glyphicon-check"> </span>
    </a>


     <a href="<?php echo base_url() ;?>index.php/modules/thermo" class="btn btn-green ">
        <span class="glyphicon glyphicon-2x glyphicon-fire"> </span>
    </a>
    
     <a href="<?php echo base_url() ;?>index.php/modules/form_chercher" class="btn btn-green ">
        <span class="glyphicon glyphicon-2x glyphicon-search"> </span>
    </a>

    <a href="<?php echo base_url() ;?>index.php/welcome/trace" class="btn btn-green ">
        <span class="glyphicon glyphicon-2x glyphicon-pencil"> </span>
    </a>



</div> 