<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
error_reporting(0);
include_once('PHPJasperXML/class/tcpdf/tcpdf.php');
include_once("PHPJasperXML/class/PHPJasperXML.inc.php");

$server = 'localhost';
$user = 'root';
$pass = 'P@55w0rd';
$db= 'db_ci_easyui';


$xml =  simplexml_load_file("salesorder.jrxml");


$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
