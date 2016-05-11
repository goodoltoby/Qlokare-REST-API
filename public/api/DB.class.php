<?php 

class DB{

  private static $instance; 

  public static function getInstance(){
    if(!self::$instance){ # Om vi redan har något i $instance i klassen (self::)
      # Skapa då ett mysqli-objekt med en kopplaing till vår databas och lagra den i $instance
      require_once('db.conf.php');
      self::$instance = new mysqli(CONF_DB_SERVER,CONF_DB_USERNAME,CONF_DB_PASSWORD,CONF_DB_DATABASE);
      self::$instance->query("SET NAMES 'utf8'");
      return self::$instance;
    }else{ # Om vi inte har något i $instance
      return self::$instance;
    }
  }

  private function __construct(){}
  private function __clone(){}
}