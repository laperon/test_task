<?php

/**
 * Custom shorcodes
 */
class Shortcodes {
	public function __construct() {
		add_shortcode( 'ads-form', [ $this, 'form_ads_shortcode' ] );
	}

	public function form_ads_shortcode() {
		ob_start(); ?>
        <form id="ads-form" method="post" action="<?php echo add_query_arg( [
			'form' => 'add_publication'
		] ); ?> " enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="title">
						<?php _e( 'Title', 'neve' ); ?>
                    </label>
                    <input type="text" id="title" name="title">
                </li>
                <li>
                    <label for="file">
						<?php _e( 'Image', 'neve' ); ?>
                    </label>
                    <input type="file" id="file" name="image">
                </li>
                <li>
                    <label for="email">
						<?php _e( 'Email', 'neve' ); ?>
                    </label>
                    <input type="email" id="email" name="email">
                </li>
                <li>
                    <input type="submit" value="send">
                </li>
                <li>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">
                            0%
                        </div>
                    </div>
                </li>
            </ul>
        </form>


		<?php return ob_get_clean();
	}
}

new Shortcodes();