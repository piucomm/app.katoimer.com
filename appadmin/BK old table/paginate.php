<?php
/**
 * CodexWorld is a programming blog. Our mission is to provide the best online resources on programming and web development.
 *
 * This Pagination class helps to integrate ajax pagination in PHP.
 *
 * @class   Pagination
 * @author    CodexWorld
 * @link    http://www.codexworld.com
 * @contact   http://www.codexworld.com/contact-us
 * @version   1.0
 */
class Pagination{
  var $baseURL    = '';
  var $totalResult    = '';
  var $perPage = 10;
  var $nowPage = 11;
  var $total_pages = 1;
    
  function __construct($bu, $tR, $pP,$nP){
    
    $this->baseURL = $bu;
    $this->totalResult = $tR;
    $this->perPage = $pP;
    $this->nowPage = $nP;
  }
  
  /**
   * Generate the pagination links
   */ 
  function getLinks(){ 
    $output = $this->baseURL;

    return $output;   
  }

  function getTotalPages(){ 
    $resto_mod = $this->totalResult % $this->perPage;

    if($this->totalResult >= $this->perPage) {
      $total_pages = ceil($this->totalResult / $this->perPage);
    }
    return $total_pages;  
  }

}
?>