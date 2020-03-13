<?php
namespace Give\Views\Form\Themes\Sequoia;

use Give\Form\Theme;
use Give\Form\Theme\Themeable as Themeable;
use Give\Views\Form\Themes\Sequoia\Actions;
use Give\Views\Form\Themes\Sequoia\Scripts;


/**
 * Class Sequoia
 *
 * @package Give\Form\Theme
 */
class Sequoia extends Theme implements Themeable {

	/**
	 * @inheritDoc
	 */
	public function loadHooks() {
		$actions = new Actions();
		$actions->init();
	}

	/**
	 * @inheritDoc
	 */
	public function loadScripts() {
		add_action( 'wp_enqueue_scripts', array( new Scripts(), 'init' ) );
	}

	/**
	 * @inheritDoc
	 */
	public function getID() {
		return 'sequoia';
	}

	/**
	 * @inheritDoc
	 */
	public function geName() {
		return __( 'Sequoia - Multi-Step Form', 'give' );
	}

	/**
	 * @inheritDoc
	 */
	public function getImage() {
		return 'https://images.unsplash.com/photo-1448387473223-5c37445527e7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&q=100';
	}

	/**
	 * @inheritDoc
	 */
	public function getOptions() {
		return require 'optionConfig.php';
	}
}