<?php

/**
 * Elementor Email Sample Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block\Email;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * Email Sample Block
 *
 * @since 3.1.0
 */
class Sample extends Widget_Base
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
            'ctc-el-email-sample',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/email-sample/style.css',
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
        return [ 'ctc-el-email-sample' ];
    }
    
    /**
     * Get style dependencies
     */
    public function get_style_depends()
    {
        return [ 'ctc-blocks-core' ];
    }
    
    /**
     * Get name
     */
    public function get_name()
    {
        return 'ctc_copy_email_sample';
    }
    
    /**
     * Get title
     */
    public function get_title()
    {
        return esc_html__( 'Email Sample', 'copy-the-code' );
    }
    
    /**
     * Get icon
     */
    public function get_icon()
    {
        return 'eicon-email-field';
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
            'email',
            'copy',
            'content',
            'template'
        ];
    }
    
    /**
     * Render
     */
    public function render()
    {
        $sample_email = $this->get_settings_for_display( 'sample_email' );
        $button_text = $this->get_settings_for_display( 'button_text' );
        $button_text_copied = $this->get_settings_for_display( 'button_text_copied' );
        $show_icon = $this->get_settings_for_display( 'show_icon' );
        $icon_direction = $this->get_settings_for_display( 'icon_direction' );
        if ( empty($sample_email) ) {
            return;
        }
        $display_content = preg_replace( '/\\[([^\\]]*)\\]/', '<span class="ctc-email-highlight">[$1]</span>', $sample_email );
        $display_content = wpautop( $display_content );
        $with_icon = ( 'yes' === $this->get_settings_for_display( 'show_icon' ) ? 'with-icon' : '' );
        ?>
        <div class="ctc-block ctc-email-sample">
            <div class="ctc-block-content">
                <?php 
        echo  wp_kses_post( $display_content ) ;
        ?>
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
        echo  esc_html( $sample_email ) ;
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
         * Group: Email Section
         */
        $this->start_controls_section( 'email_section', [
            'label' => esc_html__( 'Email Sample', 'copy-the-code' ),
        ] );
        $this->add_control( 'sample_email', [
            'label'       => esc_html__( 'Email Sample', 'copy-the-code' ),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => "Subject: Application for [Job Title] - [Your Name]\r\n\r\nDear [Hiring Manager's Name],\r\n\r\nI hope this email finds you well. I am writing to express my strong interest in the [Job Title] position at [Company Name], as advertised on your website. With my background in [Relevant Skill/Experience] and a passion for [Company's Mission or Industry], I believe I am a strong fit for your team.\r\n\r\nSincerely,\r\n[Your Name]\r\n[Your Contact Information]",
            'rows'        => 10,
            'description' => esc_html__( 'Use [ ] to highlight the text.', 'copy-the-code' ),
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
        $this->start_controls_section( 'button_section', [
            'label' => esc_html__( 'Button', 'copy-the-code' ),
        ] );
        $this->add_control( 'button_text', [
            'label'   => esc_html__( 'Button Text', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Copy to Clipboard', 'copy-the-code' ),
        ] );
        $this->add_control( 'button_text_copied', [
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