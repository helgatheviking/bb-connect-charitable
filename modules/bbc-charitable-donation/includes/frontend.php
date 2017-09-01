<div class="bbc-charitable-donation fl-clearfix">
	<?php if ( $settings->title ) : ?>
        <h3 class="bbc-charitable-donation-title"><?php echo $settings->title ?></h3>
	<?php endif; ?>

	<?php 

	$donation_shortcode = sprintf( '[charitable_donation_form campaign_id="%s"]',
			$settings->campaign_id
		);
	
	echo do_shortcode( $donation_shortcode ); 

	?>
</div>



			
