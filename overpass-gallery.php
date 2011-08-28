<?php 

/*
Plugin Name: Overpass Gallery
Plugin URI: http://byed.it
Description: Bespoke gallery
Version: 1.0
Author: Nitzan
Author URI: http://byed.it
*/

remove_shortcode('gallery');
add_shortcode('gallery', 'parse_gallery_shortcode');

function parse_gallery_shortcode($atts) {
 
	global $post;
 
	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'medium',
		'link' => 'file'
	), $atts));
 
	$args = array(
		'post_type' => 'attachment',
		'post_parent' => $id,
		'numberposts' => -1,
		'orderby' => $orderby
		); 
	$images = get_posts($args);
 ?>
 
<div class="post-gallery">

 <?php
 foreach ( $images as $image ) {		
		$caption = $image->post_excerpt;
 		$description = $image->post_content;
		if($description == '') $description = $title;
 		$image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
 		$img = wp_get_attachment_image_src($image->ID, $size);
 		
 
?>

<img src="<?php echo $img[0];?>" height="<?php echo $img[2];?>" width="<?php echo $img[1];?>" alt="<?php echo $image_alt; ?>">

<?php
 
         }
         
 ?>
  

  </div>
  
<?php
}




?>