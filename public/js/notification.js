function give_notification(name, time, place, imgUrl){
  var options = {
    body: name + " posted about " + place + " on " + time,
    icon: imgUrl,
    dir : "ltr"
  };
  var notification = new Notification("New Travel-Blog Post", options);     
}

function notifyMe(name, time, place, imgUrl){
  //browser dont support
  if((!("Notification" in window))) {
    //alert("This browser does not support desktop notification");
    console.log("This browser does not support desktop notification");
  }else{
    console.log("browser auto allow");
    if(Notification.permission === "granted"){
      give_notification(name, time, place, imgUrl);
      console.log("user manually allow");
    }else if(Notification.permission !== 'denied'){
      Notification.requestPermission(function (permission) {
        if (!('permission' in Notification)) {
          Notification.permission = permission;
        }
        if (permission === "granted") {
          give_notification(name, time, place, imgUrl);
        }
      });
      console.log("User don't allow");
    }else{
      console.log("dont give notification");
    }		
  }
}

setInterval(function(){
  $.ajax
  ({
    //url: "http://localhost/travel_blog/public/notification", 
    url: "http://ruslan-website.com/laravel/travel_blog/notification", 
    type: "get",

    success: function(result)
    { 
      //console.log(result);
      result = JSON.parse(result);

      if(result.length > 0){
        for(let i = 0; i < result.length; i++){
          // console.dir(result[i].user.name);
          // console.dir(result[i].time);
          // console.dir(result[i].place);
          // console.dir(result[i].img_url);
          notifyMe(result[i].user.name, result[i].time, result[i].place, result[i].img_url);
        }
      }
    }
  });
}, 20000);