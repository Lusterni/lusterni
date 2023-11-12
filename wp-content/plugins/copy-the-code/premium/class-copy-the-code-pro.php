<?php
/**
 * Pro
 *
 * @package Copy the Code
 * @since 1.0.0
 */

if ( ! class_exists( 'Copy_The_Code_Pro' ) ) :

	/**
	 * Copy the Code
	 *
	 * @since 1.0.0
	 */
	class Copy_The_Code_Pro {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class Instance.
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', [ $this, 'dashboard_scripts' ] );
			add_action( 'copy_the_code/dashboard/save', [ $this, 'save' ] );
			add_action( 'wp_footer', array( $this, 'add_style' ) );
		}

		/**
		 * Add style
		 */
		public function add_style() {
			$style = get_option( 'ctc_default_style' );
			if ( ! $style ) {
				return;
			}
			$btnColor      = isset( $style['btn_color'] ) ? $style['btn_color'] : '';
			$btnBgColor    = isset( $style['btn_bg_color'] ) ? $style['btn_bg_color'] : '';
			$btnFontSize   = isset( $style['btn_font_size'] ) ? $style['btn_font_size'] : '';
			$btnLineHeight = isset( $style['btn_font_weight'] ) ? $style['btn_font_weight'] : '';
			$btnLPadding   = isset( $style['btn_l_padding'] ) ? $style['btn_l_padding'] : '';
			$btnTPadding   = isset( $style['btn_t_padding'] ) ? $style['btn_t_padding'] : '';
			$btnRPadding   = isset( $style['btn_r_padding'] ) ? $style['btn_r_padding'] : '';
			$btnBPadding   = isset( $style['btn_b_padding'] ) ? $style['btn_b_padding'] : '';
			$btnLMargin    = isset( $style['btn_l_margin'] ) ? $style['btn_l_margin'] : '';
			$btnTMargin    = isset( $style['btn_t_margin'] ) ? $style['btn_t_margin'] : '';
			$btnRMargin    = isset( $style['btn_r_margin'] ) ? $style['btn_r_margin'] : '';
			$btnBMargin    = isset( $style['btn_b_margin'] ) ? $style['btn_b_margin'] : '';
			$btnTLRadius   = isset( $style['btn_tl_radius'] ) ? $style['btn_tl_radius'] : '';
			$btnTRRadius   = isset( $style['btn_tr_radius'] ) ? $style['btn_tr_radius'] : '';
			$btnBRRadius   = isset( $style['btn_br_radius'] ) ? $style['btn_br_radius'] : '';
			$btnBLRadius   = isset( $style['btn_bl_radius'] ) ? $style['btn_bl_radius'] : '';
			$btnHColor     = isset( $style['btn_h_color'] ) ? $style['btn_h_color'] : '';
			$btnHBgColor   = isset( $style['btn_h_bg_color'] ) ? $style['btn_h_bg_color'] : '';

			$svgIconColor    = isset( $style['svg_icon_color'] ) ? $style['svg_icon_color'] : '';
			$svgIconWidth    = isset( $style['svg_icon_width'] ) ? $style['svg_icon_width'] : '';
			$svgIconTPadding = isset( $style['svg_icon_t_padding'] ) ? $style['svg_icon_t_padding'] : '';
			$svgIconRPadding = isset( $style['svg_icon_r_padding'] ) ? $style['svg_icon_r_padding'] : '';
			$svgIconBPadding = isset( $style['svg_icon_b_padding'] ) ? $style['svg_icon_b_padding'] : '';
			$svgIconLPadding = isset( $style['svg_icon_l_padding'] ) ? $style['svg_icon_l_padding'] : '';
			$svgIconHColor   = isset( $style['svg_icon_h_color'] ) ? $style['svg_icon_h_color'] : '';

			$coverColor    = isset( $style['cover_color'] ) ? $style['cover_color'] : '';
			$coverFontSize = isset( $style['cover_font_size'] ) ? $style['cover_font_size'] : '';

			?>
			<style>
				.copy-the-code-wrap.copy-the-code-style-cover .copy-the-code-button  {
					color: <?php echo $coverColor; ?>;
					font-size: <?php echo esc_html( $coverFontSize ); ?>px;
				}

				.copy-the-code-wrap.copy-the-code-style-svg-icon .copy-the-code-button {
					padding-top: <?php echo $svgIconTPadding; ?>px;
					padding-right: <?php echo $svgIconRPadding; ?>px;
					padding-bottom: <?php echo $svgIconBPadding; ?>px;
					padding-left: <?php echo $svgIconLPadding; ?>px;
					color: <?php echo $svgIconColor; ?>;
				}
				.copy-the-code-wrap.copy-the-code-style-svg-icon .copy-the-code-button svg {
					fill: <?php echo $svgIconColor; ?>;
					width: <?php echo $svgIconWidth; ?>px;
				}
				.copy-the-code-wrap.copy-the-code-style-svg-icon .copy-the-code-button:hover {
					color: <?php echo $svgIconHColor; ?>;
				}
				.copy-the-code-wrap.copy-the-code-style-svg-icon .copy-the-code-button:hover svg {
					fill: <?php echo $svgIconHColor; ?>;
				}

				.copy-the-code-style-button .copy-the-code-button {
					color: <?php echo esc_html( $btnColor ); ?>;
					background-color: <?php echo esc_html( $btnBgColor ); ?>;
					font-size: <?php echo esc_html( $btnFontSize ); ?>px;
					line-height: <?php echo esc_html( $btnLineHeight ); ?>px;
					padding-left: <?php echo esc_html( $btnLPadding ); ?>px;
					padding-top: <?php echo esc_html( $btnTPadding ); ?>px;
					padding-right: <?php echo esc_html( $btnRPadding ); ?>px;
					padding-bottom: <?php echo esc_html( $btnBPadding ); ?>px;
					margin-left: <?php echo esc_html( $btnLMargin ); ?>px;
					margin-top: <?php echo esc_html( $btnTMargin ); ?>px;
					margin-right: <?php echo esc_html( $btnRMargin ); ?>px;
					margin-bottom: <?php echo esc_html( $btnBMargin ); ?>px;
					border-top-left-radius: <?php echo esc_html( $btnTLRadius ); ?>px;
					border-top-right-radius: <?php echo esc_html( $btnTRRadius ); ?>px;
					border-bottom-right-radius: <?php echo esc_html( $btnBRRadius ); ?>px;
					border-bottom-left-radius: <?php echo esc_html( $btnBLRadius ); ?>px;
				}
				.copy-the-code-style-button .copy-the-code-button:hover {
					color: <?php echo esc_html( $btnHColor ); ?>;
					background-color: <?php echo esc_html( $btnHBgColor ); ?>;
				}

				.copy-the-code-style-button .copy-the-code-button svg {
					fill: <?php echo esc_html( $btnColor ); ?>;
					width: <?php echo esc_html( $btnFontSize ); ?>px;
				}
				.copy-the-code-style-button .copy-the-code-button:hover svg {
					fill: <?php echo esc_html( $btnHColor ); ?>;
				}
			</style>
			<?php
		}

		/**
		 * Save
		 *
		 * @since 3.0.0
		 * @return void
		 */
		public function save() {
			$style = isset( $_POST['style'] ) ? $_POST['style'] : get_option( 'ctc_default_style', [] );
			if ( ! $style ) {
				return;
			}

			update_option( 'ctc_default_style', $style );
		}

		/**
		 * Dashboard scripts.
		 *
		 * @version 3.0.0
		 *
		 * @param  string $hook Current hook name.
		 * @return mixed
		 */
		function dashboard_scripts( $hook = '' ) {
			if ( 'settings_page_copy-the-code' !== $hook ) {
				return;
			}

			wp_enqueue_script( 'copy-the-code-customize', COPY_THE_CODE_URI . 'assets/admin/js/customize.js',  [ 'jquery', 'wp-hooks' ], COPY_THE_CODE_VER, true );
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Copy_The_Code_Pro::get_instance();

endif;
