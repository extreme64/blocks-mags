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
    public function __construct($name, $enqueue_tag)
    {
        add_action('init', array($this, 'init'));
        $i18n = new Blocks_Mags_i18n();
        $this->int_domain = $i18n->get_i18n_domain();
        
        $this->name = $name;
        $this->enqueue_tag = $enqueue_tag; //"slider-tp1-block";
    }

    /**
     * 
     */
    public function init()
    {
        register_block_type($this->name, [
            'editor_script' => $this->enqueue_tag,
            'editor_style'  => $this->enqueue_tag,
            'render_callback' => [$this, 'render'],
        ]);
    }

    /**
     * 
     */
    public function render($attributes, $content, $meta = []) {
        return '<div class="slider-tp1">' . $content . '</div>';
    }
}

/* .. */
$blocksMagBlock = new Class_Slider_Tp1('blocks-mags/class-slider-tp1', "slider-tp1-block");
// $blocksMagBlock->init();

?>