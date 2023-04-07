<?php
if (!defined('ABSPATH')) exit;

/**
 * Casino score block view.
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://na.io
 * @since      1.0.1
 *
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/public/partials
 */
?>
<div class="casino-score-block">
    <div class="casino-score-block__inner border-radius-25">
        <div class="casino-score-block__scores">
            <b class="casino-score-block__title"> <?php _e('CASINO SCORES', self::$int_domain) ?></b>
            <div class="casino-score-block__items">
                <?php echo $html_str ?>
            </div>
        </div>
        <div class="casino-score-block__overall">
            <b class="casino-score-block__title"><?php _e('OVERALL', self::$int_domain) ?></b><div class="casino-score-block__value-wrap">
                <div class="casino-score-block__value">
                    <p><?php echo $overall_rating ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php echo $btn ?>
</div>