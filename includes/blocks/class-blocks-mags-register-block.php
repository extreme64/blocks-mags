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
class Blocks_Mags_Register_Block
{
    /**
     * Register block to be used in Gutenberg editor
     * 
     * @since 1.1.4
     */
    public static function addBlock(String $blockname)
    {
        switch ($blockname) {
            case Class_Slider_Tp1::BLOCK_STRING_ID:
                // $blocksMagBlock = new Class_Slider_Tp1('blocks-mags/class-slider-tp1', "slider-tp1-block");
                // $blocksMagBlock->addActions();
                break;
            case Class_Casino_Score::BLOCK_STRING_ID:
                $obj = new Class_Casino_Score('blocks-mags/casino-score', "casino-score-block");
                $obj->init();
                break;
            default:
        }
    }
}


?>