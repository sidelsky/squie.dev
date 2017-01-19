<?php include("header.php"); ?>
	
	<section role="main">
		
		<h2>Tag: <?php echo single_tag_title('', false); ?></h2>
		
		<?php get_template_part('loop'); ?>
	
	</section>
	
<?php include("footer.php"); ?>