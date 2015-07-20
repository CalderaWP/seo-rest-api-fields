<?php

/**
 * Class test_post_response
 *
 * Tests that GET requests will have the right SEO fields.
 */
class test_post_response extends WP_UnitTestCase {

	/**
	 * Setupt tests
	 */
	public function setUp() {
		parent::setUp();

		/** @var WP_REST_Server $wp_rest_server */
		global $wp_rest_server;
		$this->server = $wp_rest_server = new WP_REST_Server;
		do_action( 'rest_api_init' );
		$this->post_id = $this->factory->post->create();
		update_post_meta( $this->post_id, '_yoast_wpseo_title', 'title' );
		update_post_meta( $this->post_id, '_yoast_wpseo_metadesc', 'description' );
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
	 * Make sure we did not break posts query
	 */
	public function test_posts_response_still_works() {
		$request = new WP_REST_Request( 'GET', '/wp/v2/posts' );
		$response = $this->server->dispatch( $request );
		$this->assertNotInstanceOf( 'WP_Error', $response );
		$response = rest_ensure_response( $response );
		$this->assertEquals( 200, $response->get_status() );
	}

	/**
	 * Make sure we did not break single post query
	 */
	public function test_post_response_still_works() {
		$request = new WP_REST_Request( 'GET', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$response = $this->server->dispatch( $request );
		$this->assertNotInstanceOf( 'WP_Error', $response );
		$response = rest_ensure_response( $response );
		$this->assertEquals( 200, $response->get_status() );
	}

	/**
	 * Test that we have the title field in the response.
	 */
	public function test_has_title_field() {
		$request = new WP_REST_Request( 'GET', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$response = $this->server->dispatch( $request );
		$response = rest_ensure_response( $response );
		$data = $response->get_data();
		$this->assertArrayHasKey( '_yoast_wpseo_title', $data );

	}

	/**
	 * Test that the title field in the response is correct.
	 */
	public function test_title_response() {
		$request = new WP_REST_Request( 'GET', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$response = $this->server->dispatch( $request );
		$response = rest_ensure_response( $response );
		$data = $response->get_data();
		$this->assertEquals( $this->post_id, $data['id'] );
		$this->assertEquals( get_post_meta( $this->post_id, '_yoast_wpseo_title', true ), $data['_yoast_wpseo_title'][0] );
	}

	/**
	 * Test that we have the description field in the response.
	 */
	public function test_has_description_field() {
		$request = new WP_REST_Request( 'GET', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$response = $this->server->dispatch( $request );
		$response = rest_ensure_response( $response );
		$data = $response->get_data();
		$this->assertArrayHasKey( '_yoast_wpseo_title', $data );

	}

	/**
	 * Test that the description field in the response is correct.
	 */
	public function test_description_response() {
		$request = new WP_REST_Request( 'GET', sprintf( '/wp/v2/posts/%d', $this->post_id ) );
		$response = $this->server->dispatch( $request );
		$response = rest_ensure_response( $response );
		$post = get_post( $this->post_id );
		$data = $response->get_data();
		$this->assertEquals( $this->post_id, $data['id'] );
		$this->assertEquals( get_post_meta( $this->post_id, '_yoast_wpseo_metadesc', true ), $data['_yoast_wpseo_metadesc'][0] );

	}
}

