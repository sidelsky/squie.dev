<div class="single-portfolio__content-wrap">
  <!-- START: Inner content -->
  <?php

      //---------------------------//
      // Primary title and content //
      //---------------------------//

      // Project color
      $color = get_field('color');

      echo '<div class="single-portfolio__inner">';
      // Title
      the_title('<h1 class="single-portfolio__title" style="color:' . $color . '">','</h1>');

      echo '<hr class="single-portfolio__hr" style="border-color:' . $color . '; opacity: .4; ">';
      // Content
      the_content();
      echo '</div>';

  ?>

  <?php

      if( have_rows('content') ) :
      ?>

      <?php while ( have_rows('content') ) : the_row(); ?>

          <?php
              // CTA
              // Title and copy
              if( get_row_layout() == 'cta' ) :

                  $link = get_sub_field('button');
                  $margin = get_sub_field('remove_margin_top');
           ?>

           <form action="<?php echo $link; ?>" method="get" target="_blank">
              <button style="background-color: <?php echo $color; ?>" class="button button--link <?php if($margin) : echo 'button--' . $margin; endif; ?>">Visit: <span><?php the_title(); ?></span></button>
          </form>

           <?php endif; ?>


            <?php

            // Project details list
            if( get_row_layout() == 'technologies' ) : ?>
            <div class="o-details">

            <?php
            // check for rows (parent repeater)
             if( have_rows('technology') ): ?>

                <?php
                // loop through rows (parent repeater)
                while( have_rows('technology') ): the_row(); ?>

                        <h3 class="o-details__title"><?php the_sub_field('title'); ?></h3>

                        <?php

                        // check for rows (sub repeater)
                        if( have_rows('details') ): ?>
                            <ul class="o-details__list">
                            <?php

                            // loop through rows (sub repeater)
                            while( have_rows('details') ): the_row();

                                // display each item as a list - with a class of completed ( if completed )
                                ?>
                                <li class="o-details__item"><?php the_sub_field('detail'); ?></li>
                            <?php endwhile; ?>
                            </ul>
                        <?php endif; //if( get_sub_field('items') ): ?>


                <?php endwhile; // while( has_sub_field('to-do_lists') ): ?>
                    </div>
            <?php endif;  endif;// if( get_field('to-do_lists') ): ?>



          <?php
          // Title and copy
          if( get_row_layout() == 'copy' ) :

              $title = get_sub_field('title');
              $copy = get_sub_field('copy');

              ?>

              <?php

              echo '<div class="single-portfolio__inner">';
              // Title
              if($title) : ?>
                  <h2 style="color: <?php echo $color; ?>"><?php echo $title; ?></h2>
                  <?php echo '<hr class="single-portfolio__hr" style="border-color:' . $color . '; opacity: .4; ">'; ?>
              <?php endif; ?>

              <?php
              // Copy
              if($copy) : ?>
                  <div class="single-portfolio__sub-content"><?php echo $copy; ?></div>
              <?php endif;
                  echo '</div>';
              ?>

          <?php endif; ?>



          <?php
              // Get Video
              if( get_row_layout() == 'video' ) :
           ?>

              <?php
                  // get iframe HTML
                  $iframe = get_sub_field('video_id');

                  // use preg_match to find iframe src
                  preg_match('/src="(.+?)"/', $iframe, $matches);
                  $src = $matches[1];

                  // add extra params to iframe src
                  $params = array(
                      'controls'  => 0,
                      'hd'        => 1,
                      'autohide'  => 1
                  );

                  $new_src = add_query_arg($params, $src);

                  $iframe = str_replace($src, $new_src, $iframe);

                  // add extra attributes to iframe html
                  $attributes = 'frameborder="0"';

                  $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

                  // echo $iframe
                  //echo '<div class="video-container">' . $iframe . '</div>';

                  echo '<div class="video-container">' . $iframe . '</div>';
               ?>
          <?php endif; ?>


          <?php
          // Get Image gallery
          if( get_row_layout() == 'image' ) :

          // Sizes
          $thumbnail = 'thumbnail';
          $medium = 'medium';
          $medium_large = 'medium_large';
          $large = 'large';

          $image = get_sub_field('image');
          $image_thumbnail = $image['sizes'][ $thumbnail ];
          $image_medium = $image['sizes'][ $medium ];
          $image_medium_large = $image['sizes'][ $medium_large ];
          $image_large = $image['sizes'][ $large ];

          // Alt tag
          $alt = $image['alt'];

          ?>

          <img src="<?php echo $image['url']; ?>"
               class="single-portfolio__image"
               srcset="<?php echo $image['url']; ?> 2560w,
                       <?php echo $image_large; ?> 1024w,
                       <?php echo $image_medium_large; ?> 768w,
                       <?php echo $image_medium; ?> 300w"
               sizes="100vw"
               alt="<?php echo $alt; ?>" />

          <?php endif; ?>

          <?php
          // Get Gallery
          if( get_row_layout() == 'gallery' ) :
          ?>
          <div class="single-portfolio__gallery">
          <?php
          // Sizes
          $thumbnail = 'thumbnail';
          $medium = 'medium';
          $medium_large = 'medium_large';
          $large = 'large';

          $gal_images = get_sub_field('gallery');

          foreach ($gal_images as $gal_image) :

            $gal_image_thumbnail = $gal_image['sizes'][ $thumbnail ];
            $gal_image_medium = $gal_image['sizes'][ $medium ];
            $gal_image_medium_large = $gal_image['sizes'][ $medium_large ];
            $gal_image_large = $gal_image['sizes'][ $large ];

              // Alt tag
              $alt = $image['alt'];

              ?>
          <img src="<?php echo $gal_image['url']; ?>"
               class="single-portfolio__image-grid"
               srcset="<?php echo $gal_image['url']; ?> 2560w,
                       <?php echo $gal_image_large; ?> 1024w,
                       <?php echo $gal_image_medium_large; ?> 768w,
                       <?php echo $gal_image_medium; ?> 300w"
               sizes="100vw"
               alt="<?php echo $alt; ?>" />
          <?php endforeach; ?>
          </div>
          <?php endif; ?>


      <?php endwhile; ?>
  <?php endif; ?>
  <!-- END: Inner content -->
</div>
