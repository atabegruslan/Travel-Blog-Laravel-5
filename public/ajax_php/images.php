<?php
	$dirname = "../images/";
	$images = glob($dirname."*.png");
	$imagesArray = array();

	foreach($images as $image) {
	    //echo '<img src="'.$image.'" /><br />';
	    array_push($imagesArray, str_replace("../", "", $image) );
	}

	//print_r($imagesArray);
	echo json_encode($imagesArray);
?>