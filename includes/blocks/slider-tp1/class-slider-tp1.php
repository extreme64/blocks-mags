<?php
if (!defined('ABSPATH')) exit;

/**
 * Custom block Slider Tp1. Customizable slider based around columns.
 * 
 * @since   1.0.0
 */
class Class_Slider_Tp1 extends Blocks_Mag_Block implements Blocks_Mags_Renderable
{

    /**
     * Block ID
     * 
     * @since   1.1.4
     */
    const BLOCK_STRING_ID = 'slider-tp1';

    /**
     * Class constructor.
     * 
     * @since   1.1.3
     */
    public function __construct($name, $enqueue_tag)
    {
        parent::__construct($name, $enqueue_tag);
    }

    /**
     * 
     * @since   1.1.3
     */
    public function addActions()
    {
        // add_action('init', array($this, 'init'));
    }

    /**
     * Initialize block stuff.
     * 
     * @since 1.1.0
     */
    public function init()
    {
        // register_block_type($this->name, [
        //     'editor_script' => $this->enqueue_tag,
        //     'editor_style'  => $this->enqueue_tag,
        //     'render_callback' => [$this, 'render'],
        // ]);
    }

    /**
     * Render block.
     * 
     * @return bool
     * 
     * @inheritdoc Blocks_Mags_Renderable
     * 
     * @since 1.1.4
     */
    public function render($attributes, $content, $meta = []) {
        // return '<div class="slider-tp1">' . $content . '</div>';
    }
}
?>