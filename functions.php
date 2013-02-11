<?php
function bootstrap_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 )+1;
	global $paged;
	if ( empty( $paged ) ) $paged = 1;

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination pagination-centered'><ul>";
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( 1 )."'>&laquo;</a></li>";
		if ( $paged > 1 && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $paged - 1 )."'>&lsaquo;</a></li>";

		for ( $i=1; $i <= $pages; $i++ ) {
			if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i )? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link( $i )."' class='inactive' >".$i."</a></li>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $paged + 1 )."'>&rsaquo;</a></li>";
		if ( $paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages ) echo "<li><a href='".get_pagenum_link( $pages )."'>&raquo;</a></li>";
		echo "</ul></div>\n";
	}
}

function removeEmptyParagraphs($str) {
	$str = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", "", $str);
	return $str;
}
add_filter('the_content', 'removeEmptyParagraphs', 9999);

function get_related_author_posts() {
    global $authordata, $post;
    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );
    if (count($authors_posts) > 0) {
    	$output = '<div class="headline">Andra artiklar av '.get_the_author_meta( 'first_name', $authordata->ID).'</div>';
	    $output .= '<ul>';
	    foreach ( $authors_posts as $authors_post ) {
	        $output .= '<li><i class="icon-caret-right"></i><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
	    }
	    $output .= '</ul>';
	    return $output;
    } else {
    	return false;
    }
}

function AuthorTwitter() {
	global $authordata;
	$twitter = get_usermeta($authordata->ID, 'twitter');
	if (empty($twitter)) {
		return false;
	} else {
		echo '<li class="twitter-circle"><a rel="tooltip" title="Follow me on Twitter" href="'.$twitter.'">Twitter</a></li>';
	}
}

function AuthorLinkedIn() {
	global $authordata;
	$linkedin = get_usermeta($authordata->ID, 'linkedin');
	if (empty($linkedin)) {
		return false;
	} else {
		echo '<li class="linkedin-circle"><a rel="tooltip" title="Read my resumé on LinkedIn" href="'.$linkedin.'">LinkedIn</a></li>';
	}
}

function AuthorGoogle() {
	global $authordata;
	$google = get_usermeta($authordata->ID, 'google');
	if (empty($google)) {
		return false;
	} else {
		echo '<li class="google-circle"><a rel="tooltip" title="Circle me on Google Plus" href="'.$google.'">GooglePlus</a></li>';
	}
}

function AuthorCity() {
	global $authordata;
	$city = get_usermeta($authordata->ID, 'city');
	if (empty($city)) {
		return false;
	} else {
		echo $city;
	}
}

function AuthorTitle() {
	global $authordata;
	$title = get_usermeta($authordata->ID, 'title');
	if (empty($title)) {
		return false;
	} else {
		echo $title;
	}
}

register_nav_menu( 'footer', 'Footer Menu' );
remove_filter( 'the_excerpt', 'wpautop' );
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'wrap_div_around_images', 100 );

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

function wrap_div_around_images( $content ) {
	// /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/
	$content = preg_replace( '/(<img [^>]*src="([^"]*)"[^>]*>)/i', '<div class="imageborderbox">$1</div>', $content );
	return $content;
}


// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

function disable_admin_bar() {
	add_filter( 'show_admin_bar', '__return_false' );
	add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_settings' );
}
add_action( 'init', 'disable_admin_bar' , 9 );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

set_post_thumbnail_size( 500, 500, false );



add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

function hide_meta_boxes() {
	remove_meta_box('suggestedtags','post','advanced');
	remove_meta_box('suggestedtags','page','advanced');
	#remove_meta_box('tagsdiv-post_tag','post','side');
	#remove_meta_box('tagsdiv-post_tag','page','side');
	remove_meta_box('trackbacksdiv','post','normal');
	remove_meta_box('trackbacksdiv','page','normal');
	remove_meta_box('postcustom','post','normal');
	remove_meta_box('slugdiv','post','normal');
	remove_meta_box('slugdiv','page','normal');
	remove_meta_box('postcustom','page','normal');
	#remove_meta_box('commentstatusdiv','post','normal');
	#remove_meta_box('commentstatusdiv','page','normal');
	remove_meta_box('commentsdiv','post','normal');
	remove_meta_box('commentsdiv','page','normal');
	remove_meta_box('postimagediv','page','side');
	remove_meta_box('postimagediv','post','side');
	
	#remove_meta_box('postexcerpt','page','side');
	#remove_meta_box('postexcerpt','post','side');
	
	remove_meta_box('authordiv','page','side');
	remove_meta_box('authordiv','post','side');
	remove_meta_box('authordiv','page','normal');
	remove_meta_box('authordiv','post','normal');

	#remove_meta_box('categorydiv','page','side');
	#remove_meta_box('categorydiv','post','side');
	#remove_meta_box('categorydiv','page','normal');
	#remove_meta_box('categorydiv','post','normal');

	remove_meta_box('postimagediv','page','side');
	remove_meta_box('postimagediv','post','side');
	remove_meta_box('postimagediv','page','normal');
	remove_meta_box('postimagediv','post','normal');

	
}

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
} 

function remove_menus () {
	if (current_user_can('editor') && !current_user_can('administrator')) {
		global $menu;
		$restricted = array(__('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
	}
}

add_action('admin_menu', 'remove_menus');
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
add_action( 'admin_init','hide_meta_boxes');


// [snipt id="value"]
function snipt_func( $atts, $content = null ) {
	extract(shortcode_atts(array('id' => '10'), $atts));
	return '<script type="text/javascript" src="https://snipt.net/embed/' . $id . '/"></script>';
}
add_shortcode( 'snipt', 'snipt_func' );

function gist_func( $atts, $content = null ) {
	extract(shortcode_atts(array('id' => '10'), $atts));
	return '<script type="text/javascript" src="https://gist.github.com/' . $id . '.js"></script>';
}
add_shortcode( 'gist', 'gist_func' );



?>
