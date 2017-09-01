<?php

/**
 * This is the basic Charitable Donation Form module.
 *
 * @class BBC_Charitable_Donation
 * @since 1.0
 */
class BBC_Charitable_Donation extends FLBuilderModule {

	/**
	 * Constructor function for the module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'          => __( 'Donation Form', 'bbc-charitable' ),
			'description'   => __( 'Add your Charitable Donation Form to your page.', 'bbc-charitable' ),
			'category'      => __( 'Charitable Modules', 'bbc-charitable' ),
			'editor_export' => true, // Defaults to true and can be omitted.
			'enabled'       => true, // Defaults to true and can be omitted.
		) );
	}

	/**
	 * Get all Charitable campaigns
	 *
	 * @return array List of Charitable campaigns
	 */
	public static function list_campaigns() {
		$list = array( '' => __( 'Select a Campaign', 'bbc-charitable' ) );

		$campaigns = Charitable_Campaigns::query( array( 'posts_per_page' => -1 ) );

		foreach ( $campaigns->posts as $campaign ) {
			$list[ $campaign->ID ] = $campaign->post_title;
		}

		return $list;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'BBC_Charitable_Donation', array(
	'donation' => array( // Tab
		'title'    => __( 'General', 'bbc-charitable' ), // Tab title
		'sections' => array( // Tab Sections
			'general' => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'title' => array(
						'type'        => 'text',
						'label'       => __( 'Title', 'bbc-charitable' ),
						'default'     => '',
						'placeholder' => __( 'Placeholder text', 'fl-builder' ),
						'class'       => 'bbc-charitable-donation-title',
					),
					'campaign_id' => array(
						'type'    => 'select',
						'label'   => __( 'Select Campaign', 'bbc-charitable' ),
						'default' => '',
						'options' => BBC_Charitable_Donation::list_campaigns()
					),
	/*				'show_goal'         => array(
						'type'        => 'bbc-toggle',
						'label'       => __( 'Show Goal', 'bbc-charitable' ),
						'default'     => 'false',
						'options'     => array(
							'true'  => __( 'Show', 'bbc-charitable' ),
							'false' => __( 'Hide', 'bbc-charitable' ),
						),
						'help'    => __( 'Show/hide the form goal. Default is “hide”', 'bbc-charitable' )
					),
					'form_display'     => array(
						'type'    => 'select',
						'label'   => __( 'Display Options', 'bbc-charitable' ),
						'default' => 'default',
						'options' => array(
							'default' => __( 'Use default setting', 'bbc-charitable' ),
							'separate_page' => __( 'Show on a Separate Page', 'bbc-charitable' ),
							'same_page'     => __( 'Show on the Same Page', 'bbc-charitable' ),
							'modal'         => __( 'Reveal in a Modal', 'bbc-charitable' )						
					),
						'help'    => __( 'Override the setting you set when you created the campaign. You can choose from “Show on s Separate Page”, “Show on the Same Page”, or “Reveal in a Modal”.', 'bbc-charitable' )
					),
			*/
				)
			)
		)
	)
) );