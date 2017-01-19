<?php include("header.php"); ?>
	
	<section role="main">
		
		<h2>Category: <?php single_cat_title(); ?></h2>
		
		<?php get_template_part('loop'); ?>
	
	</section>
	
<?php include("footer.php"); ?>