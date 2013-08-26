<?php
  class  message {
  	var $msgstr;
  	var $type;
    function message(){
    	$this->msgstr = "";
        $this->type= ""; 
    }
    function  setmsg($m){$this->msgstr=$m;}
    function settype($t){$this->type=$t;}
    function getmsg(){return $this->msgstr;}
    function gettype(){return $this->type;}
}

?>