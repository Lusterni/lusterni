<?php

/**
 * Elementor SMS Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * SMS Block
 *
 * @since 3.1.0
 */
class SMS extends Widget_Base
{
    /**
     * Constructor
     * 
     * @param array $data
     * @param array $args
     * 
     * @since 3.1.0
     */
    public function __construct( $data = array(), $args = null )
    {
        parent::__construct( $data, $args );
        // Core.
        wp_enqueue_style(
            'ctc-blocks-core',
            COPY_THE_CODE_URI . 'classes/blocks/assets/css/style.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_enqueue_script(
            'ctc-clipboard',
            COPY_THE_CODE_URI . 'assets/js/clipboard.js',
            [ 'jquery' ],
            COPY_THE_CODE_VER,
            true
        );
        wp_enqueue_script(
            'ctc-blocks-core',
            COPY_THE_CODE_URI . 'classes/blocks/assets/js/core.js',
            [ 'ctc-clipboard' ],
            COPY_THE_CODE_VER,
            true
        );
        // Block.
        wp_enqueue_style(
            'ctc-el-sms',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/sms/style.css',
            [ 'ctc-blocks-core' ],
            COPY_THE_CODE_VER,
            'all'
        );
    }
    
    /**
     * Get script dependencies
     */
    public function get_script_depends()
    {
        return [ 'ctc-el-sms' ];
    }
    
    /**
     * Get style dependencies
     */
    public function get_style_depends()
    {
        return [ 'ctc-clipboard', 'ctc-blocks-core' ];
    }
    
    /**
     * Get name
     */
    public function get_name()
    {
        return 'ctc_sms';
    }
    
    /**
     * Get title
     */
    public function get_title()
    {
        return esc_html__( 'SMS', 'copy-the-code' );
    }
    
    /**
     * Get icon
     */
    public function get_icon()
    {
        return 'eicon-copy';
    }
    
    /**
     * Get categories
     */
    public function get_categories()
    {
        return [ 'basic' ];
    }
    
    /**
     * Get keywords
     */
    public function get_keywords()
    {
        return [
            'sms',
            'sms',
            'sms',
            'sms'
        ];
    }
    
    /**
     * Render
     */
    public function render()
    {
        $sms = $this->get_settings_for_display( 'sms' );
        $copy_text = $this->get_settings_for_display( 'copy_text' );
        $author = $this->get_settings_for_display( 'author' );
        $button_text = $this->get_settings_for_display( 'button_text' );
        $button_text_copied = $this->get_settings_for_display( 'button_text_copied' );
        $show_icon = $this->get_settings_for_display( 'show_icon' );
        $icon_direction = $this->get_settings_for_display( 'icon_direction' );
        if ( empty($sms) ) {
            return;
        }
        $sms = wpautop( $sms );
        $with_icon = ( 'yes' === $this->get_settings_for_display( 'show_icon' ) ? 'with-icon' : '' );
        ?>
        <div class="ctc-block ctc-sms">
            <div class="ctc-block-content">
                <div class="ctc-sms-box">
                    <div class="ctc-sms-text"><?php 
        echo  wp_kses_post( $sms ) ;
        ?></div>
                </div>
            </div>
            <div class="ctc-block-actions">
                <?php 
        echo  Helpers::get_copy_button( [
            'as_raw'                  => 'yes',
            'copy_button_text'        => $button_text,
            'copy_button_text_copied' => $button_text_copied,
            'icon_direction'          => $icon_direction,
            'show_icon'               => $show_icon,
        ] ) ;
        ?>
            </div>
            <textarea class="ctc-copy-content" style="display: none;"><?php 
        echo  esc_html( $copy_text ) ;
        ?></textarea>
        </div>
        <?php 
    }
    
    /**
     * Register controls
     */
    protected function _register_controls()
    {
        /**
         * Group: Copy Text Section
         */
        $this->start_controls_section( 'copy_text_section', [
            'label' => esc_html__( 'Copy to Clipboard', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_text', [
            'label'   => esc_html__( 'Add Text to Copy', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'May your birthday be filled with many happy hours and your life with many happy birthdays.

HAPPY BIRTHDAY !!',
            'rows'    => 10,
        ] );
        $this->end_controls_section();
        /**
         * Group: sms Section
         */
        $this->start_controls_section( 'sms_section', [
            'label' => esc_html__( 'SMS', 'copy-the-code' ),
        ] );
        $this->add_control( 'sms', [
            'label'   => esc_html__( 'SMS', 'copy-the-code' ),
            'type'    => Controls_Manager::WYSIWYG,
            'default' => 'May your birthday be filled with many happy hours and your life with many happy birthdays.

HAPPY BIRTHDAY !!',
        ] );
        // Two paragraph gap in pixcel.
        $this->add_responsive_control( 'line_gap', [
            'label'      => esc_html__( 'Line Gap', 'copy-the-code' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .ctc-sms-text p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_section();
        $this->button();
    }
    
    /**
     * Button
     */
    protected function button()
    {
        /**
         * Group - Button
         */
        $this->start_controls_section( 'copy_button_section', [
            'label' => esc_html__( 'Button', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_button_text', [
            'label'   => esc_html__( 'Button Text', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Copy to Clipboard', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_button_text_copied', [
            'label'   => esc_html__( 'Button Text (After Copied)', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Copied to Clipboard', 'copy-the-code' ),
        ] );
        // Show Icon.
        $this->add_control( 'show_icon', [
            'label'        => esc_html__( 'Show Icon', 'copy-the-code' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'copy-the-code' ),
            'label_off'    => esc_html__( 'Hide', 'copy-the-code' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );
        $this->add_control( 'icon_direction', [
            'label'     => esc_html__( 'Icon Direction', 'copy-the-code' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'before',
            'options'   => [
            'before' => esc_html__( 'Before', 'copy-the-code' ),
            'after'  => esc_html__( 'After', 'copy-the-code' ),
        ],
            'condition' => [
            'show_icon' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'icon_text_gap', [
            'label'      => esc_html__( 'Icon and Text Gap', 'copy-the-code' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'range'      => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
            'em' => [
            'min' => 0,
            'max' => 10,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .ctc-with-icon' => 'gap: {{SIZE}}{{UNIT}};',
        ],
            'condition'  => [
            'show_icon' => 'yes',
        ],
        ] );
        $this->end_controls_section();
        // Group - Button End.
    }

}