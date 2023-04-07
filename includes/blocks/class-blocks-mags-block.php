<?php
if (!defined('ABSPATH')) exit;

/**
 * A parent class for all the custom blocks
 * @since 1.1.4
 */
class Blocks_Mag_Block
{
    /**
     * The name of the block.
     * 
     * @var string $name
     */
    public $name;
 
    /**
     * The text domain of the plugin.
     * 
     * @var string $domain The text domain of the plugin.
     */
    protected $domain;

    /**
     * The enqueue tag of the block.
     *
     * @var string $enqueue_tag The enqueue tag of the block.
     */
    public $enqueue_tag;

    /**
     *Initializes the Block object.
     *
     *@since 1.1.4
     */
    public function __construct($name, $enqueue_tag)
    {
        $this->domain = Blocks_Mags_i18n::$text_domain;
        $this->name = $name;
        $this->enqueue_tag = $enqueue_tag;
    }
    /**
     *Initializes the block in the WordPress editor.
     * 
     * @since 1.1.4
     */
    public function init()
    {
        register_block_type($this->name , array(
            'editor_script' => $this->enqueue_tag,
            'editor_style' => $this->enqueue_tag,
            'render_callback' => array($this, 'render'),
        ));
    }
}


?>