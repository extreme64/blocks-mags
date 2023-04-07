<?php
class Class_Slider_Tp1
{
    public function __construct()
    {
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        register_block_type('blocks-mags/class-slider-tp1', array(
            'editor_script' => 'blocks-mags',
            'render_callback' => array($this, 'render_slider_tp1'),
        ));
    }

    public function render_slider_tp1($attributes, $content)
    {
        return '<div class="slider-tp1">' . $content . '</div>';
    }
}
?>