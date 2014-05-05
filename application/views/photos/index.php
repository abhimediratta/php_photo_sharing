<h2>My photos</h2>
<div class="col-md-10 thumbnail_container">

</div>

<div class="col-md-4" style="margin-top:5%;">
	<span class="btn-mrgn btn-fb-login share_album">
	    <span class="icon icon-fb"></span>
	    <span class="title">Share on Facebook</span>
	</span>
	<%= link_to button_tag("Add New Photos",type: 'button',class: 'btn-mrgn btn btn-info new_photo_btn'), new_photo_path %>
</div>
<span id="shared_album_id"><%= @shared_album.to_param %></span>