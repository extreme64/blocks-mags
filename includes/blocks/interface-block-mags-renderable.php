<?php
if (!defined('ABSPATH')) exit;

/**
 * Interface Renderable defines the method signature for classes that can be rendered.
 * 
 * @since     1.1.3
 * 
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/includes/blocks
 */
interface Blocks_Mags_Renderable
{
    /**
     * Renders the class.
     * 
     * @param array $attributes An array of attributes for the class.
     * @param string $content The content to be rendered.
     * @param string [$meta] Post meta data.
     * @return string The rendered output.
     * 
     * @since     1.1.3
     */
    public function render($attributes, $content, $meta = []);
}
?>