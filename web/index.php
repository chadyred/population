<?php


 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

//$configuration = ProjectConfiguration::getApplicationConfiguration('gestionPopulation', 'prod', false);
$configuration = ProjectConfiguration::getApplicationConfiguration('gestionPopulation', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
 

