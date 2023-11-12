<?php
/**
 * Helpers
 *
 * @package Copy the Code
 * @since 1.0.0
 */

namespace CopyTheCode;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

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
        $button_text = isset( $args['button_text'] ) ? $args['button_text'] : esc_html__( 'Copy', 'copy-the-code' );
        $button_class = isset( $args['button_class'] ) ? $args['button_class'] : '';
        $button_text_copied = isset( $args['button_text_copied'] ) ? $args['button_text_copied'] : esc_html__( 'Copied!', 'copy-the-code' );
        $icon_direction = isset( $args['icon_direction'] ) ? $args['icon_direction'] : 'before';

        ob_start();
        ?>
        <button class="ctc-block-copy ctc-<?php echo esc_attr( $with_icon ); ?>" copy-as-raw='<?php echo esc_html( $as_raw ); ?>' data-copied="<?php echo esc_html( $button_text_copied ); ?>">
            <?php
            if ( 'before' === $icon_direction && 'yes' === $show_icon ) {
                echo self::get_svg_copy_icon();
                echo self::get_svg_checked_icon();
            }
            echo '<span class="ctc-button-text">' . esc_html( $button_text ) . '</span>';
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

    /**
     * Get categories
     * 
     * @since 3.2.0
     */
    public static function get_categories() {
        return [ 'copy-the-code', 'basic' ];
    }

    /**
     * Get common keywords
     * 
     * @param array $keywords New keywords.
     * @since 3.2.0
     */
    public static function get_keywords( $keywords = [] ) {
        $default = [ 'copy', 'paste', 'clipboard', 'copy clipboard', 'copy to clipboard', 'copy anything to clipboard' ];

        return array_merge( $default, $keywords );
    }

    /**
     * Register "Copy Content" Section
     * 
     * @param object $self
     */
    public static function register_copy_content_section( $self, $args = [] ) {
        $self->start_controls_section(
            'copy_content_section',
            [
                'label' => esc_html__( 'Copy Content', 'copy-the-code' ),
            ]
        );

        $self->add_control(
            'copy_content',
            [
                'label' => esc_html__( 'Enter Text that Copy to Clipboard', 'copy-the-code' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => isset( $args[ 'default' ] ) ? $args[ 'default' ] : '',
                'rows' => 10,
            ]
        );

        $self->end_controls_section();
    }

    /**
     * Register "Copy Button" Section
     * 
     * @param array $args
     * @param object $self
     */
    public static function register_copy_button_section( $self, $args = [] ) {
        $default = [
            'button_text' => isset( $args[ 'button_text' ] ) ? $args[ 'button_text' ] : esc_html__( 'Copy to Clipboard', 'copy-the-code' ),
            'button_text_copied' => isset( $args[ 'button_text_copied' ] ) ? $args[ 'button_text_copied' ] : esc_html__( 'Copied!', 'copy-the-code' ),
            'show_icon' => 'yes',
            'icon_direction' => 'before',
        ];

        $self->start_controls_section(
            'copy_button_section',
            [
                'label' => esc_html__( 'Copy Button', 'copy-the-code' ),
            ]
        );
        
        $self->add_control(
            'copy_button_text',
            [
                'label' => esc_html__( 'Button Text', 'copy-the-code' ),
                'type' => Controls_Manager::TEXT,
                'default' => $default[ 'button_text' ],
            ]
        );

        $self->add_control(
            'copy_button_text_copied',
            [
                'label' => esc_html__( 'After Copy Text', 'copy-the-code' ),
                'type' => Controls_Manager::TEXT,
                'default' => $default[ 'button_text_copied' ],
            ]
        );

        // Show Icon.
        $self->add_control(
            'copy_show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'copy-the-code' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'copy-the-code' ),
                'label_off' => esc_html__( 'Hide', 'copy-the-code' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $self->add_control(
            'copy_icon_direction',
            [
                'label' => esc_html__( 'Icon Direction', 'copy-the-code' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'copy-the-code' ),
                    'after' => esc_html__( 'After', 'copy-the-code' ),
                ],
                'condition' => [
                    'copy_show_icon' => 'yes',
                ],
            ]
        );

        $self->add_responsive_control(
            'copy_icon_text_gap',
            [
                'label' => esc_html__( 'Icon and Text Gap', 'copy-the-code' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ctc-with-icon' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'copy_show_icon' => 'yes',
                ],
            ]
        );

        $self->end_controls_section();
    }

    /**
     * Register "Copy Button Style" Section
     * 
     * @param object $self
     */
    public static function register_copy_button_style_section( $self ) {
        $self->start_controls_section(
			'copy_button_style_section',
			[
				'label' => esc_html__( 'Copy Button', 'copy-the-code' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $self->add_control(
			'copy_button_align',
			[
				'label' => esc_html__( 'Alignment', 'copy-the-code' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'' => esc_html__( 'Default', 'copy-the-code' ),
					'left' => esc_html__( 'Left', 'copy-the-code' ),
                    'center' => esc_html__( 'Center', 'copy-the-code' ),
                    'right' => esc_html__( 'Right', 'copy-the-code' ),
				],
				'selectors' => [
					'{{WRAPPER}} .ctc-block-actions' => 'text-align: {{VALUE}};',
				],
			]
		);

        // Tabs.
        $self->start_controls_tabs(
            'copy_button_style_tabs'
        );
        
        // button Style Normal.
        $self->start_controls_tab(
            'copy_button_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'copy-the-code' ),
            ]
        );

        $self->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'copy_button_normal_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ctc-block-copy',
                'exclude' => [ 'image' ],
			]
		);

        $self->add_control(
			'copy_button_normal_text_color',
			[
				'label' => esc_html__( 'Text Color', 'copy-the-code' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctc-block-copy' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ctc-block-copy svg' => 'fill: {{VALUE}};',
				],
			]
		);

        $self->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'copy_button_normal_typography',
				'selector' => '{{WRAPPER}} .ctc-block-copy',
			]
		);

        $self->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'copy_button_normal_border',
				'selector' => '{{WRAPPER}} .ctc-block-copy',
			]
		);

        $self->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'copy_button_normal_box_shadow',
				'selector' => '{{WRAPPER}} .ctc-block-copy',
			]
		);

        $self->end_controls_tab();
        // button Style Normal End.

        // button Style Hover.
        $self->start_controls_tab(
            'copy_button_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'copy-the-code' ),
            ]
        );

        $self->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'copy_button_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ctc-block-copy:hover',
                'exclude' => [ 'image' ],
			]
		);

        $self->add_control(
			'copy_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'copy-the-code' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctc-block-copy:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ctc-block-copy:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

        $self->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'copy_button_hover_border',
				'selector' => '{{WRAPPER}} .ctc-block-copy:hover',
			]
		);

        $self->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'copy_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .ctc-block-copy:hover',
			]
		);

        $self->end_controls_tab();
        // button Style Hover End.

        $self->end_controls_tabs();
        // button Tabs.

        $self->add_responsive_control(
            'copy_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'copy-the-code' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ctc-block-copy' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $self->add_responsive_control(
            'copy_button_padding',
            [
                'label' => esc_html__( 'Padding', 'copy-the-code' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ctc-block-copy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $self->add_responsive_control(
            'copy_button_margin',
            [
                'label' => esc_html__( 'Margin', 'copy-the-code' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ctc-block-copy' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $self->end_controls_section();
        // button Style Section End.
    }

    /**
     * Render "Copy Button"
     * 
     * @param object $self
     */
    public static function render_copy_button( $self ) {
        $button_text = $self->get_settings_for_display( 'copy_button_text' );
        $button_text_copied = $self->get_settings_for_display( 'copy_button_text_copied' );
        $show_icon = $self->get_settings_for_display( 'copy_show_icon' );
        $icon_direction = $self->get_settings_for_display( 'copy_icon_direction' );

        echo Helpers::get_copy_button( [
            'as_raw' => 'yes',
            'button_text' => $button_text,
            'button_text_copied' => $button_text_copied,
            'icon_direction' => $icon_direction,
            'show_icon' => $show_icon,
        ] );
    }

    /**
     * Render "Copy Content"
     * 
     * @param object $self
     */
    public static function render_copy_content( $self ) {
        $copy_content = $self->get_settings_for_display( 'copy_content' );
        ?>
        <textarea class="ctc-copy-content" style="display: none;"><?php echo esc_html( $copy_content ); ?></textarea>
        <?php
    }

}