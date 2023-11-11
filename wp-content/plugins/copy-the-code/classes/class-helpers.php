<?php
/**
 * Helpers
 *
 * @package Copy the Code
 * @since 1.0.0
 */

namespace CopyTheCode;

/**
 * Helpers
 *
 * @since 1.0.0
 */
class Helpers {
    public static function get_svg_copy_icon() {
        return '<svg aria-hidden="true" focusable="false" role="img" class="copy-icon" viewBox="0 0 16 16" width="16" height="16" fill="currentColor"><path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path><path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path></svg>';
    }

    public static function get_svg_checked_icon() {
        return '<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="check-icon" fill="currentColor"><path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path></svg>';
    }

    public static function get_copy_button( $args = [] ) {
        $show_icon = isset( $args['show_icon'] ) ? $args['show_icon'] : 'yes';
        $with_icon = 'yes' === $show_icon ? 'with-icon' : 'without-icon';
        $as_raw = isset( $args['as_raw'] ) ? 'yes' : '';
        $copy_button_text = isset( $args['copy_button_text'] ) ? $args['copy_button_text'] : esc_html__( 'Copy', 'copy-the-code' );
        $copy_button_text_copied = isset( $args['copy_button_text_copied'] ) ? $args['copy_button_text_copied'] : esc_html__( 'Copied!', 'copy-the-code' );
        $icon_direction = isset( $args['icon_direction'] ) ? $args['icon_direction'] : 'before';

        ob_start();
        ?>
        <button class="ctc-block-copy ctc-<?php echo esc_attr( $with_icon ); ?>" copy-as-raw='<?php echo esc_html( $as_raw ); ?>' data-copied="<?php echo esc_html( $copy_button_text_copied ); ?>">
            <?php
            if ( 'before' === $icon_direction && 'yes' === $show_icon ) {
                echo self::get_svg_copy_icon();
                echo self::get_svg_checked_icon();
            }
            echo '<span class="ctc-button-text">' . esc_html( $copy_button_text ) . '</span>';
            if ( 'after' === $icon_direction && 'yes' === $show_icon ) {
                echo self::get_svg_copy_icon();
                echo self::get_svg_checked_icon();
            }
            ?>
        </button>
        <?php
        return ob_get_clean();
    }

    /**
     * Is shortcode used
     * 
     * @param string $shortcode
     * @since 3.1.0
     */
    public static function is_shortcode_used( $shortcode = '' ) {
        global $post;
        if ( ! $post ) {
            return false;
        }

        $found = false;
        if ( has_shortcode( $post->post_content, $shortcode ) ) {
            $found = true;
        }

        return $found;
    }

}