<?php
//$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
//$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

//echo $color;
?>
<!--
    VUE:
-->
<transition name="transform-scale">

    <section class="about" data-about-section v-if="show">

      <div class="single-portfolio__inner">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <!-- post -->
          <?php the_title('<h1 class="about__title">','</h1>'); ?>
          <?php the_content(); ?>

        <?php endwhile; ?>
          <!-- post navigation -->
        <?php else: ?>
          <!-- no posts found -->
        <?php endif; ?>

      </div>
    </section>

</transition>


<!-- <div id="demo">
  <button v-on:click="show = !show">
    Toggle
  </button>
  <transition name="bounce">
    <p v-if="show">hello</p>
  </transition>
</div> -->
