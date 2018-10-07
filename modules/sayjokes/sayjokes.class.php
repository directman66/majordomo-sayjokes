<?php
/**
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 13:03:10 [Mar 13, 2016])
*/
//
//
class sayjokes extends module {
/**
* yandex_tts
*
* Module class constructor
*
* @access private
*/
function sayjokes() {
  $this->name="sayjokes";
  $this->title="Ржунемогу";
  $this->module_category="<#LANG_SECTION_APPLICATIONS#>";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
function saveParams($data=0) {
 $p=array();
 if (IsSet($this->id)) {
  $p["id"]=$this->id;
 }
 if (IsSet($this->view_mode)) {
  $p["view_mode"]=$this->view_mode;
 }
 if (IsSet($this->edit_mode)) {
  $p["edit_mode"]=$this->edit_mode;
 }
 if (IsSet($this->tab)) {
  $p["tab"]=$this->tab;
 }
 return parent::saveParams($p);
}
/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
function getParams() {
  global $id;
  global $mode;
  global $view_mode;
  global $edit_mode;
  global $tab;
  if (isset($id)) {
   $this->id=$id;
  }
  if (isset($mode)) {
   $this->mode=$mode;
  }
  if (isset($view_mode)) {
   $this->view_mode=$view_mode;
  }
  if (isset($edit_mode)) {
   $this->edit_mode=$edit_mode;
  }
  if (isset($tab)) {
   $this->tab=$tab;
  }
}
/**
* Run
*
* Description
*
* @access public
*/
function run() {
 global $session;
  $out=array();
  if ($this->action=='admin') {
   $this->admin($out);
  } else {
   $this->usual($out);
  }
  if (IsSet($this->owner->action)) {
   $out['PARENT_ACTION']=$this->owner->action;
  }
  if (IsSet($this->owner->name)) {
   $out['PARENT_NAME']=$this->owner->name;
  }
  $out['VIEW_MODE']=$this->view_mode;
  $out['EDIT_MODE']=$this->edit_mode;
  $out['MODE']=$this->mode;
  $out['ACTION']=$this->action;
  $this->data=$out;
  $p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
  $this->result=$p->result;



if ($this->view_mode=='say') {
   $this->getjoke($this->id);
 }


}
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {

}

function getjoke($ctype = 1) {
if ($ctype==1) {	$pretext = array("Слушай", "Слушайте шутку", "Слушай анекдот", "Вот шутка смешная", "Еще шутка");}
if ($ctype==2) {	$pretext = array("Слушай рассказ");} 
if ($ctype==3) {	$pretext = array("Слушай стишок");} 
if ($ctype==4) {	$pretext = array("Слушай афоризм");} 
if ($ctype==5) {	$pretext = array("Слушай цитата");} 
if ($ctype==6) {	$pretext = array("Слушай тост");} 
if ($ctype==7) {	$pretext = array("Слушай рассказ");} 
if ($ctype==8) {	$pretext = array("Слушай статус");} 
if ($ctype==9) {	$pretext = array("Слушай рассказ");} 
if ($ctype==10) {	$pretext = array("Слушай рассказ");} 
if ($ctype==11) {	$pretext = array("Слушай Анекдот");} 
if ($ctype==12) {	$pretext = array("Слушай Рассказ");} 
if ($ctype==13) {	$pretext = array("Слушай Стишки");} 
if ($ctype==14) {	$pretext = array("Слушай Афоризмы");} 
if ($ctype==15) {	$pretext = array("Слушай Цитаты");} 
if ($ctype==16) {	$pretext = array("Слушай поздравление");} 
if ($ctype==17) {	$pretext = array("Слушай Тосты");} 
if ($ctype==18) {	$pretext = array("Слушай Статусы +18");}  
 
 	$number = mt_rand(0, count($pretext) - 1);
	$res = geturl('http://rzhunemogu.ru/Rand.aspx?CType=' . $ctype, 0);
	$res = win2utf($res);
	$xml = new SimpleXMLElement($res);
 	$joke = trim(preg_replace('/\s{2,}/', ' ', $xml->content));
 	$joke = $pretext[$number] . ': ' . $joke;
 	if (strlen($joke) > 500) {
     	sleep(10);
//     	GetJoke();
    } else {
		//return $joke;
     	//say($pretext[$number].':', 1);
     	say($joke, 3);
	}
}


/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {
 $this->admin($out);
}
/**
* Install
*
* Module installation routine
*
* @access private
*/
 function install($data='') {
  parent::install();
 }
 
 function dbInstall($data) {
  parent::dbInstall($data);
 }
 
 function uninstall() {

  parent::uninstall();
 }
 
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgTWFyIDEzLCAyMDE2IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
