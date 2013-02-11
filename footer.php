<?php
$tagsargs = array(
  'orderby'  => 'count',
  'order'            => 'DESC', 
  'number'       => '20'
);
$tags = get_tags($tagsargs);
?>

  <div class="container">
    <div class="row hidden-phone">
      <div class="span3">
        <ul class="topics">
        <?php
        $i=0;
        foreach ($tags as $tag) {
        ?>
          <li><a href="<?php echo get_tag_link($tag->term_taxonomy_id); ?>"><span><?php echo $tag->name?></span><span class="count">#<?php echo $tag->count?></span></a></li> 
        <?php
          $i++;
          if($i % 5 == 0) {
          ?>
        </ul>
      </div>
      <div class="span3">
        <ul class="topics">
          <?php
          }
        }
        ?>
        </ul>
      </div>

    </div>
    <div class="row visible-phone">
      <div class="span3">
        <ul class="topics">
        <?php
        $k = 0;
        foreach ($tags as $tag) {
          if($k < 5)
          {
        ?>
        <li><a href="<?php echo get_tag_link($tag->term_taxonomy_id); ?>"><span><?php echo $tag->name?></span><span class="count">#<?php echo $tag->count?></span></a></li>
        <?php
          }
          $k++;
        }
        ?>
        </ul>
        <a href="#visa-alla" class="show-all">Visa alla</a>
        <ul class="topics all" style="display:none;">
        <?php
        $k = 0;
        foreach ($tags as $tag) {
          if($k >= 5)
          {
        ?>
        <li><a href="<?php echo get_tag_link($tag->term_taxonomy_id); ?>"><span><?php echo $tag->name?></span><span class="count">#<?php echo $tag->count?></span></a></li>
        <?php
          }
          $k++;
        }
        ?>
        </ul>
        <a href="#hide" class="hide-all" style="display:none;">Dölj</a>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><i class="rssicon"></i> Prenumerera via RSS</a></div>
        <!--
        <div class="links">
<?php 
$args = array(
  'theme_location'  => 'footer',
  'menu'            => '', 
  'container'       => '', 
  'container_class' => 'menu-{menu slug}-container', 
  'container_id'    => '',
  'menu_class'      => 'menu', 
  'menu_id'         => '',
  'echo'            => true,
  'fallback_cb'     => 'wp_page_menu',
  'before'          => '',
  'after'           => '',
  'link_before'     => '',
  'link_after'      => '',
  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
  'depth'           => 0,
  'walker'          => ''
);
wp_nav_menu( $args ); ?>    
        </div>
        -->
      </div>
      <div class="logo visible-phone"><a target="_blank" href="http://www.knowit.se">Knowit</a></div>
    </div>
  </footer>
  <div id="mobile"></div>
  <script src="<?php bloginfo('template_url'); ?>/bootstrap/js/jquery.1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
  <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
  <script src="<?php bloginfo('template_url'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/js.js" type="text/javascript"></script>
  <?php wp_footer(); ?>
</body>
</html>
