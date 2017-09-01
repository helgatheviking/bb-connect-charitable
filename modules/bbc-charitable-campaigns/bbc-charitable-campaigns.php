<?php

/**
 * @class  BBC_Charitable_Campaigns
 * @since  2.0
 * @credit The Beaver Builder (https://beaverbuilder.com) team for the Tabs module which is what we based  this upon and the team at UABB (https://www.ultimatebeaver.com) for their clever implementation of toggle fields.
 */
class BBC_Charitable_Campaigns extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'            => __( 'Charitable Campaigns', 'bbc-charitable' ),
			'description'     => __( 'Display a group of campaigns.', 'bbc-charitable' ),
			'category'        => __( 'Charitable Modules', 'bbc-charitable' ),
			'partial_refresh' => true
		) );
	}

}

//
/*			$default = array(
				'id' 		   	   => '',
				'orderby' 		   => 'post_date',
				'order' 		   => '',
				'number' 		   => get_option( 'posts_per_page' ),
				'category' 		   => '',
				'tag' 			   => '',
				'creator'          => '',
				'exclude'          => '',
				'include_inactive' => false,
		

*/

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'BBC_Charitable_Campaigns', array(
	'campaigns'  => array(
		'title'    => __( 'Campaigns', 'bbc-charitable' ),
		'sections' => array(
			'general'      => array(
				'title'  => '',
				'fields' => array(
					'title' => array(
						'type'        => 'text',
						'label'       => __( 'Title', 'bbc-charitable' ),
						'default'     => '',
						'placeholder' => __( 'Placeholder text', 'fl-builder' ),
						'class'       => 'bbc-charitable-campaigns-title',
					),
					'number' => array(
						'type'    => 'text',
						'label'   => __( 'Number of Campaigns', 'bbc-charitable' ),
						'default' => get_option( 'posts_per_page' ),
						'maxlength'     => '2',
                        'size'          => '3',
					),
					'orderby'       => array(
						'type'        => 'select',
						'label'       => __( 'Order Campaigns By', 'bbc-charitable' ),
						'description' => '',
						'default'     => 'recent',
						'options'     => array(
							'post_date'  => __( 'Date published', 'bbc-charitable' ),
							'ending' => __( 'How soon campaign is ending', 'bbc-charitable' ),
							'popular' => __( 'How much money has been raised', 'bbc-charitable' )
						),
					),
					'order'       => array(
						'type'        => 'select',
						'label'       => __( 'Campaign Order', 'bbc-charitable' ),
						'description' => '',
						'default'     => 'recent',
						'options'     => array(
							'ASC'  => __( 'Ascending', 'bbc-charitable' ),
							'DSC' => __( 'Descending', 'bbc-charitable' ),
						),
					),
					'include_inactive'       => array(
						'type'        => 'bbc-toggle',
						'label'       => __( 'Include Inactive Campaigns', 'bbc-charitable' ),
						'default'     => 'false',
						'options'     => array(
							'true'  => __( 'Include', 'bbc-charitable' ),
							'false' => __( 'Exclude', 'bbc-charitable' ),
						),
					),
				)
			)
		)
	),
	'style' => array(
		'title'    => __( 'Style', 'bbc-charitable' ),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
					'columns' => array(
						'type'    => 'text',
						'label'   => __( 'Number of Columns', 'bbc-charitable' ),
						'default' => '2',
						 'maxlength'     => '2',
                         'size'          => '3',
					)
				)
			)
		)
	)
) );

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form( 'tabs_form', array(
	'title' => __( 'Add Item', 'bbc-charitable' ),
	'tabs'  => array(
		'general' => array(
			'title'    => __( 'General', 'bbc-charitable' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'label' => array(
							'type'        => 'text',
							'label'       => __( 'Label', 'bbc-charitable' ),
							'connections' => array( 'string' )
						)
					)
				),
				'content' => array(
					'title'  => __( 'Content', 'bbc-charitable' ),
					'fields' => array(
						'content' => array(
							'type'        => 'editor',
							'label'       => '',
							'wpautop'     => false,
							'connections' => array( 'string' )
						)
					)
				)
			)
		)
	)
) );