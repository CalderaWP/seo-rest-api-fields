<?php
/*
Plugin Name: REST API SEO Fields
Version: 0.1.0-b1
Description: Adds SEO fields to the WordPres REST API response, and allows editing via the API.
Author: Josh Pollock for CalderaWP LLC
Author URI: https://CalderaWP.com
Plugin URI: https://CalderaWP.com
Text Domain: seo-rest-api-fields
Domain Path: /languages
*/

/**
 * Boot up if REST API and WordPress-SEO are present.
 */
add_action( 'init', 'cwp_rest_api_seo_field' );
function cwp_rest_api_seo_field() {
	if ( defined( 'REST_API_VERSION' ) && version_compare( REST_API_VERSION,'2.0-beta3', '>=' ) ) {
		if ( defined( 'WPSEO_FILE' ) ) {
			$title_field = '_yoast_wpseo_title';
			$description_field = '_yoast_wpseo_metadesc';
			new CWP_REST_API_SEO_Fields( $title_field, $description_field );
		}

	}

}

class CWP_REST_API_SEO_Fields {

	/**
	 * The meta key for SEO title
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $title_field;

	/**
	 * The meta key for SEO description
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $description_field;

	/**
	 * Post types to register fields for.
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var array
	 */
	protected $post_types;

	/**
	 * Constructor for class.
	 *
	 * @since 0.0.1
	 *
	 * @param string $title_field Name of meta field for SEO title.
	 * @param string $description_field Name of meta field for SEO description.
	 * @param string|array $post_types Optional. Post type(s) to allow. Default is post.
	 */
	public function __construct( $title_field, $description_field, $post_types = 'post' ) {
		$this->set_title_field( $title_field );
		$this->set_description_field( $description_field );
		$this->set_post_types( $post_types );
		add_filter( 'is_protected_meta', array( $this, 'make_fields_public' ), 10, 2 );
		$this->register_fields();
	}

	/**
	 * Make fields public when using REST API
	 *
	 * @since 0.1.0
	 *
	 * @uses "is_protected_meta" filter
	 * @param bool $protected
	 * @param string $meta_key
	 *
	 * @return bool
	 */
	public function make_fields_public( $protected, $meta_key ) {
		if ( $this->title_field == $meta_key || $this->description_field == $meta_key && defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			$protected = false;
		}

		return $protected;
	}

	/**
	 * Register the fields
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 */
	protected function register_fields() {
		register_api_field( $this->post_types,
			$this->title_field,
			array(
				'get_callback'    => array( $this, 'get_post_meta_cb' ),
				'update_callback' => array( $this,'update_post_meta_cb' ),
				'schema'          => null,
			)
		);

		register_api_field( $this->post_types,
			$this->description_field,
			array(
				'get_callback'    => array( $this, 'get_post_meta_cb' ),
				'update_callback' => array( $this,'update_post_meta_cb' ),
				'schema'          => null,
			)
		);
	}

	/**
	 * Handler for getting custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param array $object The object from the response
	 * @param string $field_name Name of field
	 * @param WP_REST_Request $request Current request
	 *
	 * @return mixed
	 */
	public function get_post_meta_cb( $object, $field_name, $request ) {
		return get_post_meta( $object[ 'id' ], $field_name );
	}

	/**
	 * Handler for updating custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param object $object The object from the response
	 * @param string $field_name Name of field
	 *
	 * @return bool|int
	 */
	public function update_post_meta_cb( $value, $object, $field_name ) {
		return update_post_meta( $object->ID, $field_name, $value );
	}

	/**
	 * Set title_field property
	 *
	 * @since 0.1.0
	 *
	 * @access private
	 *
	 * @param string $title_field
	 */
	private function set_title_field( $title_field ) {
		$this->title_field = $title_field;
	}

	/**
	 * Set description_field property
	 *
	 * @since 0.1.0
	 *
	 * @access private
	 *
	 * @param string $description_field
	 */
	private function set_description_field( $description_field ) {
		$this->description_field = $description_field;
	}

	/**
	 *  Sets post_types propery and ensures is is an array.
	 *
	 * @since 0.1.0
	 *
	 * @access private
	 *
	 * @param string|array $post_types
	 */
	private function set_post_types( $post_types ) {
		if ( is_string( $post_types ) ) {
			$post_types = array( $post_types );
		}

		$this->post_types = $post_types;
	}

}
