<?php 
add_action( 'after_setup_theme', 'your_parent_theme_setup', 9 );
function your_parent_theme_setup() {    
	add_action( 'cmb2_admin_init', 'rose_child_portfolio_metabox' );
}
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function rose_child_portfolio_metabox(){
// Start with an underscore to hide fields from custom fields list
	// $prefix = '_zonapro_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb = new_cmb2_box( array(
		'id'            => rose_get_prefix('links_metabox'),
		'title'         => __( 'External Embendable Links', 'zonapro' ),
		'object_types'  => array( 'portfolio', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
		) );
	$group_field_id = $cmb->add_field( array(
		'id'          => rose_get_prefix('embeds_group'),
		'type'        => 'group',
		'description' => __( 'Generate a new oembed', 'cmb2' ),
	// 'repeatable'  => false, // use false if you want non-repeatable group
		'options'     => array(
		'group_title'   => __( 'Link {#}', 'zonapro' ), // since version 1.1.4, {#} gets replaced by row number
		'add_button'    => __( 'Añadir Link', 'zonapro' ),
		'remove_button' => __( 'Eliminar Link', 'zonapro' ),
		'sortable'      => true, // beta
		// 'closed'     => true, // true to have the groups closed by default
		),
		) );
	$cmb->add_group_field( $group_field_id, array(
		'name' => 'Link oEmbed',
		'id'   => rose_get_prefix('oembed'),
		'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
		'type' => 'oembed',
	// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );
	$meta_related = new_cmb2_box( array(
		'id'           => rose_get_prefix('related_portfolios_meta'),
		'title'        => __( 'Related Portfolio', 'cmb2' ),
		'object_types' => array( 'portfolio' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		) );
	$meta_related->add_field( array(
		'name' => 'Titulo',
		'desc' => 'Titulo para describir proyectos relacionados',
		'type' => 'text',
		'default' => 'PROYECTOS RELACIONADOS',
		'id'   => rose_get_prefix('related_portfolios_title')
		) );
	$meta_related->add_field( array(
		'name' => 'Subtitulo',
		'desc' => 'Subtitulo  proyectos relacionados',
		'default' => 'Conoce los proyectos relacionados',
		'id' => rose_get_prefix('related_portfolios_sub_title'),
		'type' => 'textarea_small'
		) );
	$meta_related->add_field( array(
		'name'      	=> __( 'Select Portfolios', 'cmb2' ),
		'id'        	=> rose_get_prefix('related_portfolios'),
		'type'      	=> 'post_search_ajax',
		'desc'			=> __( '(Start typing post title)', 'cmb2' ),
		// Optional :
		'limit'      	=> 10, 		// Limit selection to X items only (default 1)
		'sortable' 	 	=> true, 	// Allow selected items to be sortable (default false)
		'query_args'	=> array(
			'post_type'			=> array( 'portfolio' ),
			'post_status'		=> array( 'publish' ),
			'posts_per_page'	=> -1
			)
		) );

}