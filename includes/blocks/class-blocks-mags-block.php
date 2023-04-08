<?php
if (!defined('ABSPATH')) exit;

/**
 * A parent class for all the custom blocks
 * 
 * @since 1.1.4
 * 
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/includes/blocks
 */
 class Blocks_Mag_Block
{
    /**
     * The name of the block.
     * 
     * @since 1.1.4
     * @var string $name
     */
    public $name;
 
    /**
     * The text domain of the plugin.
     * 
     * @since 1.1.4
     * @var string $domain The text domain of the plugin.
     */
    protected $domain;

    /**
     * The enqueue tag of the block.
     *
     * @since 1.1.4
     * @var string $enqueue_tag The enqueue tag of the block.
     */
    public $enqueue_tag;

    /**
     * Initializes the Block object. Set i18n string, block name and enqueue tag
     *
     * @since 1.1.4
     */
    public function __construct($name, $enqueue_tag)
    {
        $i18n = new Blocks_Mags_i18n();
        $this->domain = $i18n->get_i18n_domain();

        $this->name = $name;
        $this->enqueue_tag = $enqueue_tag;
    }
}
?>