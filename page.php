<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
  <div class="container">
    <div class="divider"></div>
    <div class="row">
      <div class="span8">
        <article class="post">
          <h1><?php the_title(); ?></h1>
          <div class="divider"></div>
          <?php the_content(); ?>
        </article>
      </div>
      <div class="span4 personinfo">
      </div>
    </div>

<?php endwhile; ?>
    <div class="divider"></div>
  </div>


<?php get_footer(); ?>
