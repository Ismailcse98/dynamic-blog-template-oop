<?php
class Format{
	public function FormatDate($date){
		return date('F j, Y, g : i : a',strtotime($date));
	}
	public function textShorten($text,$limit = 400){
		$text = substr($text, 0,$limit);
		$text = substr($text, 0, strrpos($text, " "));
		$text = $text.".......";
		return $text;
	}
	public function valid($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripcslashes($data);
		return $data;
	}
	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path,".php");
		$title = str_replace('_', ' ', $title);
		if ($title == "index") {
			$title = "Home";
		}elseif($title=="contact"){
			$title="Contact";
		}
		return ucwords($title);
		// return ucfirst($title);
	}
}
?>