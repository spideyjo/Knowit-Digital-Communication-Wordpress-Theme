<?php get_header(); ?>
  <div class="container">
    <div class="divider"></div>
    <div class="row">
      <div class="span12 welcome">
        <p>
<?php 
if( is_tag() ) {
  ?>Arkiv för &#8216;<?php single_tag_title(); ?>&#8217;<?php
} elseif (is_day()) {
  ?>Arkiv för <?php the_time('F jS, Y'); ?><?php
} elseif (is_month()) {
  ?>Arkiv för <?php the_time('F, Y'); ?><?php
} elseif (is_year()) {
  ?>Arkiv för <?php the_time('Y'); ?><?php
} elseif (is_category()) {
  single_cat_title();
}
?>
        </p>
      </div>
    </div>
    <div class="divider"></div>
  </div>

  <div class="container">
    <div class="row">
    <?php $i = 1; $total = 1; ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="span4">
        <article id="postid_<?php the_ID(); ?>" class="teaser">
          <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <p><?php if($post->post_excerpt) the_excerpt(); ?></p>
          <div class="tags"><i class="icon-tags"></i><?php the_tags('', ', ', ''); ?></div>
        </article>
      </div>

    <?php
      if($i == 3 && $total < 12)
      {
    ?>
    </div>
    <div class="space-divider"></div>
    <div class="row">
    <?php
        $i = 1;
      }
      else
      {
        $i++;
      }
      $total++;
    ?>

    <?php endwhile; ?>
    </div>
    <div class="space-divider"></div>
    
    <?php bootstrap_pagination();?>
    <div class="divider"></div>
  </div>

<?php get_footer(); ?>
