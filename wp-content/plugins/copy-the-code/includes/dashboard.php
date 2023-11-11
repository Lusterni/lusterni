<?php
/**
 * Add new Page
 *
 * @package Copy the Code
 * @since 2.0.0
 */

?>
<div class="wrap copy-the-code">
	<div class="wrap">
		<p>
			<a href="<?php echo admin_url( 'options-general.php?page=copy-to-clipboard-add-new' ); ?>" class="button button-primary">Add new</a>
			<a href="<?php echo admin_url( 'edit.php?post_type=copy-to-clipboard' ); ?>" class="button">Back to List</a>
		</p>

		<h1><?php echo esc_html( COPY_THE_CODE_TITLE ); ?> <small>v<?php echo esc_html( COPY_THE_CODE_VER ); ?></small></h1>

		<p class="description"><?php _e( 'Add the new button as per your requirement. See more with <a  target="_blank"href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/" target="_blank">getting started guide</a>', 'copy-the-code' ); ?></p>

		<div id="poststuff">
			<div id="post-body" class="columns-2">
				<div id="post-body-content">

					<h2>Shortcode Information</h2>

					<h4>Example 1: Copy Same Display Text in Clipboard</h4>

					<p>
						<code>
					The zoom meeting is scheduled on data [copy]15 November 2022[/copy] please note down it.
						</code>
					</p>

					<p>Here, I have just wrapped the shortcode to the date 15 November 2022.</p>

					<p>In the above paragraph, Just click on "15 November 2022" which will copy to the clipboard.</p>

					<p><a href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#example-1-copy-same-display-text-in-clipboard&utm_source=Plugin&utm_medium=Shortcode Page&utm_campaign=WP" target="_blank">Read more</a></p>

					<h4>Example 2: Copy Different Text than Display Text in Clipboard</h4>

					<p>
						<code>
					Hello Students,<br/>

					Please save the next meeting link [copy content="https://meet.google.com/_meet/mbz-zncr-efk?ijlm=1659873953647&adhoc=1&hs=187"]Click to Copy Meeting Link[/copy] for next meeting.
						</code>
					</p>

					<p>Here, I have just wrapped the shortcode to the meeting link.</p>

					<p>In the above paragraph, Just click on "Click to Copy Meeting Link" which will copy the meeting link into the clipboard.</p>

					<p><a href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#example-2-copy-different-text-than-display-text-in-clipboard&utm_source=Plugin&utm_medium=Shortcode Page&utm_campaign=WP" target="_blank">Read more</a></p>

					<h4>See Short Video</h4>

					<p>See short video:</p>

					<iframe title="copy-content-with-shortcode-mp4" width="640" height="340" src="https://videopress.com/embed/Mo6nR60h?preloadContent=metadata&amp;hd=1" frameborder="0" allowfullscreen=""></iframe>

					<p>That’s it.</p>

					<p>Read more at <a href='https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#shortcode' target="_blank">copy with shortcode</a></p>

				</div>
				<div class="postbox-container" id="postbox-container-1">

					<?php if ( ctc_fs()->is_not_paying() ) { ?>
						<div class="postbox upgrade">
							<h2 class="hndle"><span><?php _e( 'Awesome Premium Features', 'copy-the-code' ); ?></span></h2>
							<div class="inside">
								<p>
									<a href="<?php echo ctc_fs()->get_upgrade_url(); ?>">
										<?php esc_html_e( 'Upgrade Now!', 'copy-the-code' ); ?>
									</a>
								</p>
							</div>
						</div>
					<?php } ?>

					<div class="postbox">
						<h2 class="hndle"><span><?php _e( 'Getting Started', 'copy-the-code' ); ?></span></h2>
						<div class="inside">
							<div class="table-of-contents">
								<ol class="items">
									<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#way-1-copy-with-shortcode">Way 1 - Copy with Shortcode</a>
										<ol>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#example-1-copy-same-display-text-in-clipboard">Example 1: Copy Same Display Text in
													Clipboard</a></li>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#example-2-copy-different-text-than-display-text-in-clipboard">Example 2: Copy Different
													Text than Display Text in Clipboard</a></li>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#shortcode-parameters">Shortcode Parameters</a>
											</li>
										</ol>
									</li>
									<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#way-2-copy-with-target">Way 2 - Copy with Target</a>
										<ol>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#use-case-1-how-to-add-the-copy-button-to-blockquote">Use Case 1: How to add the copy
													button to Blockquote</a></li>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#use-case-2-how-to-add-the-copy-button-to-code-snippet">Use Case 2: How to add the copy
													button to Code Snippet</a></li>
											<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#use-case-3-how-to-add-the-copy-button-to-html-list">Use Case 3: How to add the copy button
													to HTML list</a>
											</li>
										</ol>
									</li>
									<li><a target="_blank" href="https://maheshwaghmare.com/wordpress/blog/copy-anything-to-clipboard/#other-customizations">Other Customizations</a></li>
								</ol>
							</div>
						</div>
					</div>

					<div class="postbox">
						<h2 class="hndle"><span><?php _e( 'Support', 'copy-the-code' ); ?></span></h2>
						<div class="inside">
							<p><?php _e( 'Do you have any issue with this plugin? Or Do you have any suggessions?', 'copy-the-code' ); ?></p>
							<p><?php _e( 'Please don\'t hesitate to <a href="http://maheshwaghmare.wordpress.com/?p=999" target="_blank">send request »</a>.', 'copy-the-code' ); ?></p>
						</div>
					</div>

					<?php if ( ctc_fs()->is_not_paying() ) { ?>
						<div class="postbox">
							<h2 class="hndle"><span><?php _e( 'Donate', 'copy-the-code' ); ?></span></h2>
							<div class="inside">
								<p><?php _e( 'Would you like to support the advancement of this plugin?', 'copy-the-code' ); ?></p>
								<a href="https://www.paypal.me/mwaghmare7/" target="_blank" class="button button-primary"><?php _e( 'Donate Now!', 'copy-the-code' ); ?></a>
							</div>
						</div>
						<style>
							.upgrade a {
								background: #ffb100;
								color: black;
								padding: 10px;
								display: block;
								text-align: center;
								font-weight: 600;
								border-radius: 5px;
							}
						</style>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>
