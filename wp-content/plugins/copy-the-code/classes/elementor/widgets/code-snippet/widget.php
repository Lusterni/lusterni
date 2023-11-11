<?php

/**
 * Elementor Code Snippet Block
 *
 * @package Copy the Code
 * @since 3.1.0
 */
namespace CopyTheCode\Elementor\Block;

use  CopyTheCode\Helpers ;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
/**
 * Code Snippet Block
 *
 * @since 3.1.0
 */
class CodeSnippet extends Widget_Base
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
        // Prism JS scripts.
        wp_register_script(
            'ctc-prism-default',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-default.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-coy',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-coy.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-dark',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-dark.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-funky',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-funky.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-okaidia',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-okaidia.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-solarizedlight',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-solarizedlight.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-tomorrow',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-tomorrow.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        wp_register_script(
            'ctc-prism-twilight',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-twilight.js',
            [],
            COPY_THE_CODE_VER,
            true
        );
        // Prism CSS styles.
        wp_register_style(
            'ctc-prism-default',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-default.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-coy',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-coy.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-dark',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-dark.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-funky',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-funky.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-okaidia',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-okaidia.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-solarizedlight',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-solarizedlight.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-tomorrow',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-tomorrow.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        wp_register_style(
            'ctc-prism-twilight',
            COPY_THE_CODE_URI . 'classes/blocks/assets/lib/prism/prism-twilight.css',
            [],
            COPY_THE_CODE_VER,
            'all'
        );
        // Block.
        wp_enqueue_style(
            'ctc-el-code-snippet',
            COPY_THE_CODE_URI . 'classes/elementor/widgets/code-snippet/style.css',
            [ 'ctc-blocks-core' ],
            COPY_THE_CODE_VER,
            'all'
        );
    }
    
    public function get_theme()
    {
        return 'ctc-prism-' . apply_filters( 'ctc/elementor/code_snippet/theme', 'default' );
    }
    
    /**
     * Get script dependencies
     */
    public function get_script_depends()
    {
        $theme = $this->get_theme();
        if ( $theme ) {
            return [ $theme, 'ctc-el-code-snippet' ];
        }
        return [ 'ctc-el-code-snippet' ];
    }
    
    /**
     * Get style dependencies
     */
    public function get_style_depends()
    {
        $theme = $this->get_theme();
        if ( $theme ) {
            return [ $theme, 'ctc-blocks-core' ];
        }
        return [ 'ctc-blocks-core' ];
    }
    
    /**
     * Get name
     */
    public function get_name()
    {
        return 'ctc_code_snippet';
    }
    
    /**
     * Get title
     */
    public function get_title()
    {
        return esc_html__( 'Code Snippet', 'copy-the-code' );
    }
    
    /**
     * Get icon
     */
    public function get_icon()
    {
        return 'eicon-code-bold';
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
            'code',
            'snippet',
            'code snippet',
            'copy',
            'paste'
        ];
    }
    
    /**
     * Render
     */
    public function render()
    {
        $code_snippet = $this->get_settings_for_display( 'code_snippet' );
        $language = $this->get_settings_for_display( 'language' );
        $copy_button_text = $this->get_settings_for_display( 'copy_button_text' );
        $copy_button_text_copied = $this->get_settings_for_display( 'copy_button_text_copied' );
        $show_icon = $this->get_settings_for_display( 'show_icon' );
        $icon_direction = $this->get_settings_for_display( 'icon_direction' );
        $file_name = $this->get_settings_for_display( 'file_name' );
        $theme = $this->get_theme();
        $languages = $this->get_languages();
        $language = ( isset( $languages[$language] ) ? $languages[$language] : $language );
        if ( empty($code_snippet) ) {
            return;
        }
        ?>
        <div class="ctc-block ctc-code-snippet <?php 
        echo  esc_attr( $theme ) ;
        ?>">
            <div class="ctc-code-snippet-header">
                <?php 
        
        if ( $file_name ) {
            ?>
                    <div class='ctc-code-snippet-file-name'>
                        <?php 
            echo  do_shortcode( '[copy_inline text="' . esc_html( $file_name ) . '"]' ) ;
            ?>
                    </div>
                <?php 
        }
        
        ?>
                <div class='ctc-code-snippet-language'><?php 
        echo  esc_html( $language ) ;
        ?></div>
            </div>
            <div class="ctc-block-content">
                <pre><code class="language-<?php 
        echo  esc_attr( $language ) ;
        ?>"><?php 
        echo  esc_html( $code_snippet ) ;
        ?></code></pre>
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
        echo  esc_html( $code_snippet ) ;
        ?></textarea>
        </div>
        <?php 
    }
    
    /**
     * Get languages
     */
    public function get_languages()
    {
        return [
            'markup'     => esc_html__( 'Markup', 'copy-the-code' ),
            'html'       => esc_html__( 'HTML', 'copy-the-code' ),
            'css'        => esc_html__( 'CSS', 'copy-the-code' ),
            'javascript' => esc_html__( 'JavaScript', 'copy-the-code' ),
            'php'        => esc_html__( 'PHP', 'copy-the-code' ),
            'python'     => esc_html__( 'Python', 'copy-the-code' ),
            'ruby'       => esc_html__( 'Ruby', 'copy-the-code' ),
            'sass'       => esc_html__( 'Sass', 'copy-the-code' ),
            'scss'       => esc_html__( 'SCSS', 'copy-the-code' ),
            'sql'        => esc_html__( 'SQL', 'copy-the-code' ),
            'bash'       => esc_html__( 'Bash', 'copy-the-code' ),
            'c'          => esc_html__( 'C', 'copy-the-code' ),
            'cpp'        => esc_html__( 'C++', 'copy-the-code' ),
            'csharp'     => esc_html__( 'C#', 'copy-the-code' ),
            'go'         => esc_html__( 'Go', 'copy-the-code' ),
            'java'       => esc_html__( 'Java', 'copy-the-code' ),
            'kotlin'     => esc_html__( 'Kotlin', 'copy-the-code' ),
            'objectivec' => esc_html__( 'Objective-C', 'copy-the-code' ),
            'swift'      => esc_html__( 'Swift', 'copy-the-code' ),
            'typescript' => esc_html__( 'TypeScript', 'copy-the-code' ),
            'vbnet'      => esc_html__( 'VB.Net', 'copy-the-code' ),
        ];
    }
    
    /**
     * Register controls
     */
    protected function _register_controls()
    {
        /**
         * Group: Code Section
         */
        $this->start_controls_section( 'code_section', [
            'label' => esc_html__( 'Code Snippet', 'copy-the-code' ),
        ] );
        $this->add_control( 'file_name', [
            'label'   => esc_html__( 'File Name', 'copy-the-code' ),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'example.js',
        ] );
        $this->add_control( 'language', [
            'label'   => esc_html__( 'Language', 'copy-the-code' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'javascript',
            'options' => $this->get_languages(),
        ] );
        $this->add_control( 'code_snippet', [
            'label'   => esc_html__( 'Code Snippet', 'copy-the-code' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => 'console.log("Hello World");',
            'rows'    => 10,
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