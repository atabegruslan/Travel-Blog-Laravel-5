var $slider1 = $('#slider1');
var $slider2 = $('#slider2');

$.ajax
({
	url: "ajax_php/images.php", 
	type: "get",

	success: function(result)
	{ 
		var imagesArray = JSON.parse(result);

		if (imagesArray.length > 3) {
			
			var firstHalfPictures = imagesArray.slice( 0 , imagesArray.length/2 );
			var latterHalfPictures = imagesArray.slice( imagesArray.length/2 , imagesArray.length );

			$slider1.slider
			({
				title: "pictures ...",
				fade: 500,
				pictures: firstHalfPictures
			});		

			$slider2.slider
			({
				title: "... and more",
				fade: 350,
				pictures: latterHalfPictures
			});	
		}	
	}
});