<?php include("header.php"); ?>

    <section role="main" class="portfolio" data-portfolio >
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            $do_not_duplicate = $post->ID;
        ?>


            <div class="door-frame" data-door-frame>
                <!--BEGIN #magic-door-wrap-->
                <div class="single-portfolio post-<?php the_ID(); ?>">
                    <!--START: Portfolio post content -->
                    <?php include('partials/portfolio-post-item-content.php'); ?>
                    <!--END: Portfolio post content -->
                </div>
            </div>


        <?php endwhile; endif; ?>
    </section>

<!-- START: Hero -->
<?php include 'partials/portfolio-items.php'; ?>
<!-- END: Hero -->

<?php include("footer.php"); ?>
