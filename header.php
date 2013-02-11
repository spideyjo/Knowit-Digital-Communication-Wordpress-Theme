<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if(is_single() || is_page() || is_home()) { ?>
			<meta name="googlebot" content="index,archive,follow,noodp" />
			<meta name="robots" content="all,index,follow" />
			<meta name="msnbot" content="all,index,follow" />
		<?php } else { ?>
			<meta name="googlebot" content="noindex,noarchive,follow,noodp" />
			<meta name="robots" content="noindex,follow" />
			<meta name="msnbot" content="noindex,follow" />
		<?php } ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/styles.css" type="text/css" media="screen" title="no title" charset="utf-8">
		
		<?php if (is_home() || is_archive()) { ?>
		<link rel="prefetch" href="<?php echo get_next_posts_page_link(); ?>">
		<link rel="prerender" href="<?php echo get_next_posts_page_link(); ?>">
		<?php } else if (is_single()) { ?>	
		<?php
		$prev_url = get_permalink(get_adjacent_post(false,'',true));
		?>
		<link rel="prefetch" href="<?php echo $prev_url; ?>">
		<link rel="prerender" href="<?php echo $prev_url; ?>">
		<?php } ?>
		
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon-114x114.png">

		<?php wp_head(); ?>
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  </head>

<body>
  <header>
    <?php
    $args = array(
      'type'                     => 'post',
      'child_of'                 => 0,
      'parent'                   => '',
      'orderby'                  => 'name',
      'order'                    => 'ASC',
      'hide_empty'               => 1,
      'hierarchical'             => 1,
      'exclude'                  => '',
      'include'                  => '',
      'number'                   => '',
      'taxonomy'                 => 'category',
      'pad_counts'               => false
    );
    $categories = get_categories($args);
    if($categories)
    {
    ?>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="span12 categories hidden-phone">
            <ul>
            <?php
            foreach($categories as $category)
            {
            ?>
            <li><a href="/<?php echo (string) $category->slug; ?>"><?php echo (string) $category->name; ?></a></li>
            <?php
            }
            ?>
            </ul>
          </div>
          <div class="span12 mobile-categories visible-phone">
            <a href="#show-categories" id="toggle-categories">Kategorier</a>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="blogname" style="float:left;width:80%;">
            <div class="symbol"><a href="<?php echo get_option('home'); ?>">Symbol</a></div>
            <div class="text"><a href="<?php echo get_option('home'); ?>">vi jobbar med<br/><em>digital kommunikation</em></a></div>
          </div>
          <div class="logo hidden-phone" style="float:right;"><a target="_blank" href="http://www.knowit.se">Knowit</a></div>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </header>