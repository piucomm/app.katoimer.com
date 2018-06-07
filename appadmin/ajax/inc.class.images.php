<?php
////////////////////////////////////////////////////
// PHP Image class
//
// Version 2.0
//
// Author: Orlando Guiggi <info@orlandoguiggi.it>
//
// License: GPL
////////////////////////////////////////////////////
if(!isset($pathinfo['extension'])){
	$pathinfo['extension'] = "";
}
if(!isset($extension)){
	$extension = "";
}


class image {
	
	var $handler	= NULL;
	var $filename	= NULL;
	var $xsize		= NULL;
	var $ysize		= NULL;
	
	function load($filename){
		if (!file_exists($filename)) return false;
		else{
			$pathinfo = pathinfo($filename);
			switch (strtolower($pathinfo['extension'])){
				case "jpg":
					if (function_exists("imagecreatefromjpeg")) 
						$this->handler = imagecreatefromjpeg($filename);
					break;
				case "jpeg":
					if (function_exists("imagecreatefromjpeg")) 
						$this->handler = imagecreatefromjpeg($filename);
					break;
				case "gif":
					if (function_exists("imagecreatefromgif")) 
						$this->handler = imagecreatefromgif($filename);
					break;
				case "bmp":
					if (function_exists("imagecreatefromwbmp")) 
						$this->handler = imagecreatefromwbmp($filename);
					break;
				case "png":
					if (function_exists("imagecreatefrompng")) 
						$this->handler = imagecreatefrompng($filename);
					break;
					 
			}
			if ($this->handler){
				$this->xsize = imagesx($this->handler);
				$this->ysize = imagesy($this->handler);
				$this->filename = $filename;
				return true;
			}else return false;
		}
	}
	
	function save($filename = NULL){
		if (!$filename) $filename = $this->filename;
		$pathinfo = pathinfo($filename);
			switch (strtolower($pathinfo['extension'])){
				case "jpg":
						//if (function_exists("imagejpeg")) 
						imagejpeg($this->handler, $filename, 100);
					break;
				case "jpeg":
					//if (function_exists("imagejpeg")) 
						imagejpeg($this->handler, $filename, 100);
					break;
				case "gif":
					//if (function_exists("imagegif")) 
						imagegif($this->handler, $filename);
					break;
				case "bmp":
					//if (function_exists("imagewbmp")) 
						imagewbmp($this->handler, $filename);
					break;
				case "png":
					//if (function_exists("imagewbmp")) 
						imagepng($this->handler, $filename);
					break;
			}
	}
	
	function close(){
		imagedestroy($this->handler);
		$this->handler = NULL;
		$this->xsize = NULL;
		$this->ysize = NULL;
	}
	
	function fit($fit_x, $fit_y){
		if ($this->handler){		
			if ($this->xsize > $fit_x || $this->ysize > $fit_y){
				$ratio = $this->ysize / $this->xsize;
				$fit_ratio = $fit_y / $fit_x;
				if ($fit_ratio > $ratio) $resize_ratio = $fit_x / $this->xsize;
				else $resize_ratio = $fit_y / $this->ysize;
				$new_x = round($this->xsize * $resize_ratio);
				$new_y = round($this->ysize * $resize_ratio);
				$im_resized = imagecreatetruecolor($new_x, $new_y);
				imagecopyresampled($im_resized, $this->handler, 0, 0, 0, 0, $new_x, $new_y, $this->xsize, $this->ysize);
				imagedestroy($this->handler);
				$this->handler = $im_resized;
				$this->xsize = imagesx($this->handler);
				$this->ysize = imagesy($this->handler);
			}
			return true;
		}else{
			return false;
		}
	}

	function fill($fill_x, $fill_y){
		if ($this->handler){		
				$ratio = $this->ysize / $this->xsize;
				$fill_ratio = $fill_y / $fill_x;
				if ($fill_ratio < $ratio) $resize_ratio = $fill_x / $this->xsize;
				else $resize_ratio = $fill_y / $this->ysize;
				if ($fill_ratio < $ratio){
					$src_x_size = $this->xsize;
					$src_x = 0;
					$src_y_size = round($fill_y / $resize_ratio);
					$src_y = round(($this->ysize - $src_y_size) / 2);
				}else{
					$src_x_size = round($fill_x / $resize_ratio);
					$src_x = round(($this->xsize - $src_x_size) / 2);
					$src_y_size = $this->ysize;
					$src_y = 0;
				}
				$im_resized = imagecreatetruecolor($fill_x, $fill_y);
				imagecopyresampled($im_resized, $this->handler, 0, 0, $src_x, $src_y, $fill_x, $fill_y, $src_x_size, $src_y_size);
				imagedestroy($this->handler);
				$this->handler = $im_resized;
				$this->xsize = imagesx($this->handler);
				$this->ysize = imagesy($this->handler);
			return true;
		}else{
			return false;
		}
	}



	function resize($res_x, $res_y){
		if ($this->handler){		
				

				if ($this->ysize < $this->xsize) {  // altezza minore della larghezza
					$ratio = $this->xsize / $this->ysize;
					$xnew = $res_x;
					$ynew = round($xnew / $ratio);
	
				} else {
					$ratio = $this->ysize / $this->xsize;
					$ynew = $res_y;
					$xnew = round($ynew / $ratio);
				}
				$im_resized = imagecreatetruecolor($xnew, $ynew);
				imagecopyresampled($im_resized, $this->handler, 0, 0, 0, 0, $xnew, $ynew, $this->xsize, $this->ysize);
				imagedestroy($this->handler);
				$this->handler = $im_resized;
				$this->xsize = imagesx($this->handler);
				$this->ysize = imagesy($this->handler);
			return true;
		}else{
			return false;
		}
	}


	
	function show(){
		$pathinfo = pathinfo($this->filename);
			switch (strtolower($pathinfo['extension'])){
				case "jpg":
					header("Content-type: image/jpeg");
					if (function_exists("imagejpeg")) 
						imagejpeg($this->handler, '', 100);
					break;
				case "jpeg":
					header("Content-type: image/jpeg");
					if (function_exists("imagejpeg")) 
						imagejpeg($this->handler, '', 100);
					break;
				case "gif":
					header("Content-type: image/gif");
					if (function_exists("imagegif")) 
						imagegif($this->handler);
					break;
				case "bmp":
					header("Content-type: image/bmp");
					if (function_exists("imagewbmp")) 
						imagewbmp($this->handler);
					break;
				case "png":
					header("Content-type: image/png");
					if (function_exists("imagepng")) 
						imagepng($this->handler);
					break;
			}
	}


	function sanitizeName($sName) {

		$sName = $this->filename;

	    $sName = str_replace("à","a",$sName);
	    $sName = str_replace("è","e",$sName);
	    $sName = str_replace("é","e",$sName);
	    $sName = str_replace("ù","u",$sName);
	    $sName = str_replace("ì","i",$sName);
	    $sName = str_replace("ò","o",$sName);
	    $sName = str_replace(" ","_",$sName);
	    $sName = str_replace("'","-",$sName);
	    $sName = str_replace("?","-",$sName);
	    $sName = str_replace("%","-",$sName);
	    $sName = str_replace("$","-",$sName);

	    $this->filename = trim($sName);
	}

}

?>