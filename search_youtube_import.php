<?php
	// url
 $parts = explode("list=",$_POST['resource_param']);
  //echo end($parts);
	$url = 'https://www.googleapis.com/youtube/v3/';
	//key
	$key = 'key=' . 'AIzaSyDuBXgUBkaIQoMFLngjtEru30LES3l-R6w'; 
	// $channels_type = array( 'likes', 'favorites', 'uploads' );
	$resource = 'playlistItems?';

	//Required parameters
	$part = 'part=snippet&';

	$resource_param = 'playlistId=' . end($parts) . '&';

	//Optional parameters

	$maxResults = 'maxResults=' ."20". '&';
	if (empty($_POST['pageToken'])) {
		$pageToken = '';
	} else{
		$pageToken = 'pageToken=' .  $_POST['pageToken'] . '&';
	}

	$fields = 'fields=items(snippet),nextPageToken,prevPageToken,pageInfo'; 
	$request = $url . $resource . $part . $resource_param . $maxResults . $pageToken . $key ;
	$str_datos = file_get_contents( $request );
	$datos = json_decode($str_datos,true);
  //echo $request;
	//Video gallery
	//-------------------------------
	$youtube_videos = '';
	// $gallery_title = "search";

	// $youtube_videos .= '<h2>' . $gallery_title . '</h2>';

	//gallery
	$youtube_videos .= '<div id="grid">';
	foreach ($datos["items"] as $items) {
		$youtube_videos .= '<div class="product"><div class="make3D"><div class="product-front">';
		//check private thumbnail videos
		if( !isset($items["snippet"]["thumbnails"]) && $items["snippet"]["title"] == 'Private video' ){
		
			//get private thumbnail videos
			$thumbnail_url = 'https://i1.ytimg.com/vi/' . $items["snippet"]["resourceId"]["videoId"] . '/mqdefault.jpg';
			$video_state = 'private';
			
		} else {
		
			$thumbnail_url = $items["snippet"]["thumbnails"]["medium"]["url"];
			$video_state = 'public';
		}

		$youtube_videos .= '<div class="' . $video_state . '"><img src="' . $thumbnail_url . '"></div> <div class="image_overlay"></div><div class="add_to_cart">Add to Playlist</div>';
		$videoId = $items["snippet"]["resourceId"]["videoId"];
		$youtube_videos .='<div class="stats"><div class="stats-container"><span id="'. $videoId .'" class="product_name">' . $items["snippet"]["title"] . '</span></div></div>';
		// $youtube_videos .= '<h3><a href="https://www.youtube.com/watch?v=' . $videoId . '">' . $items["snippet"]["title"] . '</a></h3>';
		$youtube_videos .= '<input type="hidden" name="YoutubeID[]" value='. $videoId .'>';
		$youtube_videos .= '</div></div></div>';
	}
	$youtube_videos .= '</div>';
		
		//Pagination
	//-------------------------------
	//previous page link
		$youtube_videos .= '<div class="pagination">';
		$youtube_videos .= '';
		if (isset($datos["prevPageToken"])) {
			$youtube_videos .= '<a href="#" data-prev="' .$datos["prevPageToken"]. '" class="prev-button btn btn-accent btn-sm">Previous</a>';
		}
		$youtube_videos .= '';

		//next page link
		$youtube_videos .= '';
		if (isset($datos["nextPageToken"])) {
		$youtube_videos .= '<a href="#" data-next="' .$datos["nextPageToken"]. '" class="next-button btn btn-accent btn-sm">Next</a>';
		}
		$youtube_videos .= '';
		$youtube_videos .= '</div>';

	  echo $youtube_videos;


?>