<?php

/**
 * Elementor Phone Number Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * Phone Number Block
 *
 * @since 3.1.0
 */
class PhoneNumber extends Widget_Base
{
    public function __construct( $data = array(), $args = null )
    {
        parent::__construct( $data, $args );
        // Core.
        wp_enqueue_script(
            'ctc-clipboard',
            COPY_THE_CODE_URI . 'assets/js/clipboard.js',
            [ 'jquery' ],
            COPY_THE_CODE_VER,
            true
        );
        // Block.
        wp_enqueue_style(
            'ctc-el-phone-number',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/phone-number/style.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
    }
    
    public function get_script_depends()
    {
        return [ 'ctc-clipboard' ];
    }
    
    public function get_style_depends()
    {
        return [ 'ctc-el-phone-number' ];
    }
    
    public function get_name()
    {
        return 'ctc_copy_phone_number';
    }
    
    public function get_title()
    {
        return esc_html__( 'Phone Number', 'copy-the-code' );
    }
    
    public function get_icon()
    {
        return 'eicon-phone-call';
    }
    
    public function get_categories()
    {
        return [ 'basic' ];
    }
    
    public function get_keywords()
    {
        return [
            'number',
            'copy',
            'phone',
            'mobile',
            'contact'
        ];
    }
    
    public function render()
    {
        $number = $this->get_settings( 'number' );
        if ( empty($number) ) {
            return;
        }
        ?>
        <span class="ctc-block ctc-phone-number">
            <a href="tel:<?php 
        echo  esc_attr( $number ) ;
        ?>" class="ctc-block-content">
                <?php 
        echo  esc_html( $number ) ;
        ?>
            </a>
            <?php 
        echo  do_shortcode( '[copy_inline text="' . $number . '" hidden="yes"]' ) ;
        ?>
        </span>
        <?php 
    }
    
    protected function _register_controls()
    {
        $this->start_controls_section( 'phone_number_section', [
            'label' => esc_html__( 'Phone Number', 'copy-the-code' ),
        ] );
        $this->add_control( 'number', [
            'label'   => esc_html__( 'Phone Number', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '+91 1234567890',
        ] );
        $this->end_controls_section();
    }

}