<?php
if (!defined('ABSPATH')) exit;

/**
 * 
 */
class Class_Slider_Tp1 extends Blocks_Mag_Block implements Blocks_Mags_Renderable
{
    /**
     * 
     */
    // protected $int_domain;

    /**
     * 
     */
    // public $enqueue_tag = "slider-tp1-block";

    /**
     * 
     */
    public function __construct($name, $enqueue_tag)
    {
        add_action('init', array($this, 'init'));
        $this->int_domain = Blocks_Mags_i18n::$text_domain;
        $this->name = $name;
        $this->enqueue_tag = $enqueue_tag; //"slider-tp1-block";
        $this->init();
    }

    /**
     * 
     */
    public function init()
    {
        register_block_type($this->name, [
            'editor_script' => $this->enqueue_tag,
            'editor_style'  => $this->enqueue_tag,
            'render_callback' => [$this, $this->render],
        ]);
    }

    /**
     * 
     */
    // public function render_slider_tp1($attributes, $content)
    // {
    //     return '<div class="slider-tp1">' . $content . '</div>';
    // }

    public function render($attributes, $content, $meta = []) {
        return '<div class="slider-tp1">' . $content . '</div>';
    }
}

/* .. */
$blocksMagBlock = new Blocks_Mag_Block('blocks-mags/class-slider-tp1', "slider-tp1-block");
// $blocksMagBlock->init();

?>