<?php
/**
 *
 */
class database
{

  var $host = 'localhost';
  var $user = 'root';
  var $pass = '';
  var $db   = 'klinik';

  function __construct()
  {
    $koneksi = mysql_connect($this->host, $this->user, $this->pass);
    mysql_select_db($this->db);
    }
  }

$klinik = new database();

?>
