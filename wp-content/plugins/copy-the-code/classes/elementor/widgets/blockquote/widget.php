<?php

/**
 * Elementor Blockquote Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * Blockquote Block
 *
 * @since 3.1.0
 */
class Blockquote extends Widget_Base
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
            'ctc-el-blockquote',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/blockquote/style.css',
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
        return [ 'ctc-el-blockquote' ];
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
        return 'ctc_copy_blockquote';
    }
    
    /**
     * Get title
     */
    public function get_title()
    {
        return esc_html__( 'Copy Blockquote', 'copy-the-code' );
    }
    
    /**
     * Get icon
     */
    public function get_icon()
    {
        return 'eicon-blockquote';
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
            'blockquote',
            'quote',
            'block',
            'message',
            'sms',
            'wish',
            'shayari'
        ];
    }
    
    /**
     * Render
     */
    public function render()
    {
        $blockquote = $this->get_settings_for_display( 'blockquote' );
        $copy_text = $this->get_settings_for_display( 'copy_text' );
        $author = $this->get_settings_for_display( 'author' );
        $copy_button_text = $this->get_settings_for_display( 'copy_button_text' );
        $copy_button_text_copied = $this->get_settings_for_display( 'copy_button_text_copied' );
        $show_icon = $this->get_settings_for_display( 'show_icon' );
        $icon_direction = $this->get_settings_for_display( 'icon_direction' );
        if ( empty($blockquote) ) {
            return;
        }
        $with_icon = ( 'yes' === $this->get_settings_for_display( 'show_icon' ) ? 'with-icon' : '' );
        ?>
        <div class="ctc-block ctc-blockquote">
            <div class="ctc-block-content">
                <div class="ctc-blockquote-box">
                    <div class="ctc-blockquote-message"><?php 
        echo  wp_kses_post( $blockquote ) ;
        ?></div>
                    <div class="ctc-blockquote-author"><?php 
        echo  esc_html( $author ) ;
        ?></div>
                </div>
            </div>
            <div class="ctc-block-actions">
                <?php 
        echo  Helpers::get_copy_button( [
            'as_raw'                  => 'yes',
            'copy_button_text'        => $copy_button_text,
            'copy_button_text_copied' => $copy_button_text_copied,
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
            'label' => esc_html__( 'Copy Text', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_text', [
            'label'   => esc_html__( 'Copy Text', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => '"Top improve is to change; to be perfect is to change often."

— WINSTON CHURCHILL',
            'rows'    => 10,
        ] );
        $this->end_controls_section();
        /**
         * Group: Blockquote Section
         */
        $this->start_controls_section( 'blockquote_section', [
            'label' => esc_html__( 'Blockquote', 'copy-the-code' ),
        ] );
        $this->add_control( 'blockquote', [
            'label'   => esc_html__( 'Blockquote', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => '"Top improve is to change; to be perfect is to change often."',
            'rows'    => 10,
        ] );
        $this->add_control( 'author', [
            'label'   => esc_html__( 'Author', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '— WINSTON CHURCHILL',
        ] );
        $this->end_controls_section();
        /**
         * Group - Button
         */
        $this->start_controls_section( 'copy_button_section', [
            'label' => esc_html__( 'Button', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_button_text', [
            'label'   => esc_html__( 'Button Text', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Copy Blockquote', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_button_text_copied', [
            'label'   => esc_html__( 'After Copy Text', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Blockquote Copied!', 'copy-the-code' ),
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
    }

}