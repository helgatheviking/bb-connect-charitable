<div class="bbc-charitable-campaigns bbc-campaigns-<?php echo $settings->columns; ?> fl-clearfix">
	<?php if ( $settings->title ) : ?>
        <h3 class="bbc-charitable-campaigns-title"><?php echo $settings->title ?></h3>
	<?php endif; ?>

	<?php 

		$campaigns_shortcode = sprintf( '[campaigns orderby="%s" order="%s" number="%s" include_inactive="%s" columns="%s"]', 
			$settings->orderby,
			$settings->order,
			$settings->number,
			$settings->include_inactive == 'true' ? true : false,
			$settings->columns );

		echo do_shortcode( $campaigns_shortcode );
		
	?>

</div>