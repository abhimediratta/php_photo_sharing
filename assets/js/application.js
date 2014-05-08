//var ajax_loader;
$(document).ready(function(){
	var drop_zone;
  /*ajax_loader=$('#ajax-loader');*/
	$('.swipebox' ).swipebox();
  
	if ($('#image_upload').length > 0) {
		drop_zone=new Dropzone("#image_upload",{url: "/photo_sharing/photos/upload",enqueueForUpload: true});
		Dropzone.options.drop_zone = {
		  acceptedFiles: "image/*",
		  maxFilesize: 1 // MB
		};
		drop_zone.on("addedfile",function(file){
			if(file.size > 2048576){
				alert("Please check if file size is > 1MB");
				drop_zone.removeFile(file);
			}
		});
		drop_zone.on("sending",function(file,xhr,formData){
			var csrf_token=$('[name="authencity_token"]').attr("value");
			formData.append("authencity_token",csrf_token);
//			ajax_loader.show();
			$('#image_upload').fadeTo(400,0.5);
		});
		drop_zone.on("success",function(file,response){
//			ajax_loader.hide();
			$('#image_upload').fadeTo(400,1);
		});
    drop_zone.on("canceled",function(file,response){
  //    ajax_loader.hide();
      $('#image_upload').fadeTo(400,1);
    });
	};

  $('.share_album').click(function(){
    $('.thumbnail_container').fadeTo(400,0.5);
    FB.getLoginStatus(function(response){
      if (response.status === "connected") {
        post_api();
      }
      else if(response.status === "not_authorized"){
        FB.login(function(){
          post_api();
        },{scope: "publish_actions,publish_stream"});
      }
      else{
        FB.login(function(){
          post_api();
        },{scope: "publish_actions,publish_stream"}); 
      }
    });
  });

});

function post_api(){
  ajax_loader.show();
  var album_id=$("#shared_album_id").html();
  var share_url="https://photo-sharing-direct.herokuapp.com/shared_albums/"+album_id;
    FB.ui({
      method: 'feed',
      link: share_url,
      name: 'Photo Sharing',
      caption: 'Test app'
    }, function(response){
      ajax_loader.hide();
      $('.thumbnail_container').fadeTo(400,1);
      if (!response || response.error) {
        alert(response.error.message);
      }
      else{
        alert("Album shared on your Facebook wall!");
      }
    });
}

window.fbAsyncInit = function() {
  FB.init({
    appId      : '741577162529233',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  /*FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      //testAPI();
      //FB.logout(FB.getLoginStatus);
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login(function(){},{scope: "publish_actions"});
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login(function(){},{scope: "publish_actions"});
    }
  });*/
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));