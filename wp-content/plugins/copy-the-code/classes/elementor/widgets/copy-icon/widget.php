<?php

/**
 * Elementor Copy Icon Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * Copy Icon Block
 *
 * @since 3.1.0
 */
class CopyIcon extends Widget_Base
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
            'ctc-el-copy-icon',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/copy-icon/style.css',
            [],
            COPY_THE_CODE_VER
        );
    }
    
    public function get_script_depends()
    {
        return [ 'ctc-clipboard' ];
    }
    
    public function get_style_depends()
    {
        return [ 'ctc-el-copy-icon' ];
    }
    
    public function get_name()
    {
        return 'ctc_copy_icon';
    }
    
    public function get_title()
    {
        return esc_html__( 'Copy Icon', 'copy-the-code' );
    }
    
    public function get_icon()
    {
        return 'eicon-copy';
    }
    
    public function get_categories()
    {
        return [ 'basic' ];
    }
    
    public function get_keywords()
    {
        return [
            'copy',
            'clipboard',
            'content',
            'icon'
        ];
    }
    
    public function render()
    {
        $copy_text = $this->get_settings( 'copy_text' );
        ?>
        <span class="ctc-block ctc-copy-icon">
            <span class="ctc-block-copy ctc-block-copy-icon" role="button" aria-label="Copied">
                <?php 
        echo  Helpers::get_svg_copy_icon() ;
        ?>
                <?php 
        echo  Helpers::get_svg_checked_icon() ;
        ?>
            </span>
            <textarea class="ctc-copy-content" style="display: none;"><?php 
        echo  esc_html( $copy_text ) ;
        ?></textarea>
        </span>
        <?php 
    }
    
    protected function _register_controls()
    {
        $this->start_controls_section( 'copy_text_section', [
            'label' => esc_html__( 'Copy to Clipboard', 'copy-the-code' ),
        ] );
        $this->add_control( 'copy_text', [
            'label'       => esc_html__( 'Enter Text to Copy to Clipboard', 'copy-the-code' ),
            'type'        => Controls_Manager::TEXTAREA,
            'rows'        => 10,
            'description' => esc_html__( 'Enter the text you want to copy to the clipboard.', 'copy-the-code' ),
        ] );
        $this->end_controls_section();
    }

}