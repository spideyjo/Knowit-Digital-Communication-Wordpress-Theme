<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
  <div class="container">
    <div class="divider"></div>
    <div class="row">
      <div class="span8">
        <article class="post">
          <h1><?php the_title(); ?></h1>
          <ul class="social-icons">
            <li class="facebook"><a rel="tooltip" title="Share this on Facebook" class="facebook-share-button" href="javascript:void(0)" data-url="<?php echo (get_permalink().'?utm_source=Blog&utm_medium=SocialLink&utm_campaign=Facebook'); ?>" data-text="<?php the_title(); ?>">Facebook</a></li>
            <li class="linkedin"><a rel="tooltip" title="Share this on LinkedIn" class="linkedin-share-button" href="javascript:void(0)" data-url="<?php echo (get_permalink().'?utm_source=Blog&utm_medium=SocialLink&utm_campaign=LinkedIn'); ?>" data-text="<?php the_title(); ?>">LinkedIn</a></li>
            <li class="twitter"><a rel="tooltip" title="Share this on Twitter" class="twitter-button" href="javascript:void(0)" data-via="knowitab" data-related="knowitab" data-url="<?php echo (get_permalink().'?utm_source=Blog&utm_medium=SocialLink&utm_campaign=Twitter'); ?>" data-text="<?php the_title(); ?>">Twitter</a></li>
            <li class="google"><a rel="tooltip" title="Share this on Google Plus" class="google-share-button" href="javascript:void(0)" data-url="<?php echo (get_permalink().'?utm_source=Blog&utm_medium=SocialLink&utm_campaign=GooglePlus'); ?>">Google Plus</a></li>
          </ul>
          <div class="divider"></div>

          <div class="row">
            <div class="span3">
              <div class="post-date"><i>Date</i><?php the_time( 'j M, Y' ) ?></div>
            </div>
            <div class="span5">
               <div class="post-tags"><i>Tags</i><?php the_tags( '', ', ', '' ); ?></div>
            </div>
          </div>
          <div class="space-divider"></div>
          <p class="preamble"><?php if($post->post_excerpt) the_excerpt(); ?></p>
          <?php the_content(); ?>
		<div class="divider"></div>	
        </article>
      </div>
      <div class="span4 personinfo">
        <div class="imageborderbox"><?php echo get_simple_local_avatar( get_the_author_meta('ID'), '400' ); ?> </div>
        <div class="name"><?php the_author_meta( 'first_name'); ?> <?php the_author_meta( 'last_name'); ?></div>
        <div class="title"><?php AuthorTitle();?>, <span><?php AuthorCity();?></span></div>
        <ul class="social-icons">
          <?php AuthorGoogle();?>
          <?php AuthorLinkedIn();?>
          <?php AuthorTwitter();?>
        </ul>

        <div class="linklist">
          
          <?php echo get_related_author_posts() ?>
        </div>
      </div>
    </div>

<?php endwhile; ?>
  <div class="divider visible-phone"></div> 
  <div class="row">
    <div class="span8">
      <div class="commentlist">
        <?php comments_template( '', true ); ?>
      </div>
    </div>
    <div class="span4"></div>
  </div>
    <div class="divider"></div>
  </div>


<?php get_footer(); ?>
