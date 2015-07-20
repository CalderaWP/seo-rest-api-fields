<?php

/**
 * Class test_post_update
 *
 * Tests that POST requests will have the right SEO fields.
 */
class test_post_update extends WP_UnitTestCase {

	/**
	 * Setup tests
	 */
	public function setUp() {
		parent::setUp();

		$this->post_id = $this->factory->post->create();
		update_post_meta( $this->post_id, '_yoast_wpseo_title', rand() );
		update_post_meta( $this->post_id, '_yoast_wpseo_metadesc', rand() );

		$this->editor_id = $this->factory->user->create( array(
			'role' => 'editor',
		) );


		/** @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;
		$this->server = $wp_rest_server = new WP_REST_Server;
		do_action( 'rest_api_init' );


	}

	/**
	 * Tidy up after tests
	 */
	public function tearDown() {
		parent::tearDown();
		wp_delete_post( $this->post_id );

		/** @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;
		$wp_rest_server = null;
	}

	/**
	 * Test we can update title
	 */
	public function test_update_title() {
		wp_set_current_user( $this->editor_id );

		$request = new WP_REST_Request( 'POST', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$request->set_body_params( array(
			'_yoast_wpseo_title'    => 'one two three',
		) );
		$response = $this->server->dispatch( $request );
		$this->assertNotInstanceOf( 'WP_Error', $response );
		$response = rest_ensure_response( $response );
		$this->assertEquals( 200, $response->get_status() );

		$this->assertEquals( 'one two three', get_post_meta( $this->post_id, '_yoast_wpseo_title', true ) );
	}

	/**
	 * Test we can update description
	 */
	public function test_update_description() {
		wp_set_current_user( $this->editor_id );

		$request = new WP_REST_Request( 'POST', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$request->set_body_params( array(
			'_yoast_wpseo_metadesc' => 'uno dos tres',
		) );

		$response = $this->server->dispatch( $request );
		$this->assertNotInstanceOf( 'WP_Error', $response );
		$response = rest_ensure_response( $response );
		$this->assertEquals( 200, $response->get_status() );

		$this->assertEquals( 'uno dos tres', get_post_meta( $this->post_id, '_yoast_wpseo_metadesc', true ) );
	}

	/**
	 * Test we can update both description and title
	 */
	public function test_update_both() {
		wp_set_current_user( $this->editor_id );

		$request = new WP_REST_Request( 'POST', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$request->set_body_params( array(
			'_yoast_wpseo_title'    => '1 2 3',
			'_yoast_wpseo_metadesc' => '4 5 6',
		) );

		$response = $this->server->dispatch( $request );
		$this->assertNotInstanceOf( 'WP_Error', $response );
		$response = rest_ensure_response( $response );
		$this->assertEquals( 200, $response->get_status() );

		$this->assertEquals( '1 2 3', get_post_meta( $this->post_id, '_yoast_wpseo_title', true ) );

		$this->assertEquals( '4 5 6', get_post_meta( $this->post_id, '_yoast_wpseo_metadesc', true ) );

	}

}

