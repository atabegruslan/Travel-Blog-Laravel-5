var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
if(isAndroid) {
	$('#app').css('visibility', 'visible');
	$('#app').css('position', 'relative');
}else{
	$('#app').css('visibility', 'hidden');
	$('#app').css('position', 'absolute');
}