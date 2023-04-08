<?php
if (!defined('ABSPATH')) exit;

/**
 * Custom block Casino Score. Shows ratings withs stars and overall score. Can have CTA btn.
 * 
 * @since   1.0.0
 */
class Class_Casino_Score extends Blocks_Mag_Block implements Blocks_Mags_Renderable
{

    /**
     * Block ID.
     * 
     * @since   1.1.4
     */
    const BLOCK_STRING_ID = 'casino-score';


    /**
     * Class constructor.
     * 
     * @since   1.1.4
     */
    public function __construct($name, $enqueue_tag)
    {
        parent::__construct($name, $enqueue_tag);
    }

    /**
     * Initialize block stuff.
     * 
     * @since   1.1.3
     */
    public function init()
    {
        $this->register_block();
    }

    /**
     * Register block.
     * 
     * @since   1.1.3
     */
    public function register_block()
    {
        
        /**
         * @bizm Here is a more up to date example of how to set up a server-side rendered block: https://github.com/imaginarymachines/everything-all-of-the-time/blob/main/blocks/php-block/init.php
         *
         * Two issues with your snippet that need corrected:
         *
         * Use wp_register_script instead of wp_enqueue_script
         * https://github.com/imaginarymachines/everything-all-of-the-time/blob/main/blocks/php-block/init.php#L8
         * Pass the handle of the register script to "editor_script" argument of register_block_type(). WordPress will enqueue the script when block is used.
         * https://github.com/imaginarymachines/everything-all-of-the-time/blob/main/blocks/php-block/init.php#L20
         */
        register_block_type($this->name, [
            'editor_script' => $this->enqueue_tag,
            'editor_style'  => $this->enqueue_tag,
            'render_callback' => function ($attr, $content) {
                $post_id = get_the_ID();
                $casino_custom = [
                    'trust' => get_post_meta($post_id, 'casino_rating_trust', true),
                    'games' => get_post_meta($post_id, 'casino_rating_games', true),
                    'bonus' => get_post_meta($post_id, 'casino_rating_bonus', true),
                    'customer' => get_post_meta($post_id, 'casino_rating_customer', true),
                    'overall' => round(floatval(get_post_meta($post_id, 'casino_overall_rating', true)), 1),
                    'external_link' => get_post_meta($post_id, 'casino_external_link', true)
                ];
                return $this->render($attr, $content, $casino_custom);
            },
            'attributes' => [
                'starStyle' =>              ['type' => 'string', 'default' => '3'],
                'showCTA' =>                ['type' => 'boolean', 'default' => true],
                'textCTA' =>                ['type' => 'string', 'default' => __("PLAY NOW", $this->domain)],
                'styleCTA' =>               ['type' => 'string', 'default' => "ds2"]
            ]
        ]);

        /**
         * Register REST field that adds data from custom post 'casino'
         * 
         * @since   1.0.0
         */
        //FIXME Wrap rest fields registration
        register_rest_field('casino', 'casino_custom', [
            'get_callback' => function () {
                $post_id = get_the_ID();
                return [
                    'trust' => get_post_meta($post_id, 'casino_rating_trust', true),
                    'games' => get_post_meta($post_id, 'casino_rating_games', true),
                    'bonus' => get_post_meta($post_id, 'casino_rating_bonus', true),
                    'customer' => get_post_meta($post_id, 'casino_rating_customer', true),
                    'overall' => round(floatval(get_post_meta($post_id, 'casino_overall_rating', true)), 1),
                    'external_link' => get_post_meta($post_id, 'casino_external_link', true)
                ];
            }
        ]);
    }

    /**
     * Frontend render on server callback
     * 
     * @param   array     $attr       Attributes.
     * @param   string    $content    Post content.
     * @param   array     $meta       Post meta.
     * @return  string    $html       Render markup
     * 
     * @inheritdoc Blocks_Mags_Renderable
     * 
     * @since   1.1.3
     */
    public function render($attr, $content, $meta = [])
    {

        $html_str = '';

        $fa5_star   = '<i class="fas fa-star star %s"></i>';
        $emoji_star = '<i class="star %s">⭐</i>';
        switch ($attr['starStyle']) {
            case '1':
                $star_html = sprintf($fa5_star, "style--1");
                break;
            case '2':
                $star_html = sprintf($fa5_star, "style--2");
                break;
            case '3':
                $star_html = sprintf($emoji_star, "style--3");
            default:
                $star_html = sprintf($emoji_star, "style--3");
                break;
        }
        $star =  $star_html;

        $overall_rating = $meta['overall'];
        $external_link = $meta['external_link'];
        unset($meta['overall']);
        unset($meta['external_link']);

        foreach ($meta as $key => $item) {
            switch ($item) {
                case 1:
                    $rating_stars = $star;
                    break;
                case 2:
                    $rating_stars = $star . ' ' . $star;
                    break;
                case 3:
                    $rating_stars = $star . ' ' . $star . ' ' . $star;
                    break;
                case 4:
                    $rating_stars = $star . ' ' . $star . ' ' . $star . ' ' . $star;
                    break;
                case 5:
                    $rating_stars = $star . ' ' . $star . ' ' . $star . ' ' . $star . ' ' . $star;
                    break;
                default:
                    $rating_stars = '';
                    break;
            }
            $html_str .= '<p class="casino-score-block__score">'
                . '<span class="casino-score-block__score-text">' . __($key, $this->domain) . '</span>'
                . '<span class="casino-score-block__score-icons">' . $rating_stars . '</span></p>';
        }

        // Button used in 
        $template_cta_btn = '';
        $btn_style = '';

        if ($attr['showCTA']) {

            switch ($attr['styleCTA']) {
                case 'dark';
                case 'ds1';
                    $btn_style = 'hover-color-orange-button';
                    break;
                case 'light':
                case 'ls1':
                    $btn_style = 'hover-color-light-button';
                    break;
                default:
                    $btn_style = 'hover-color-orange-button';
                    break;
            }

            $template_cta_btn = "<a target=\"_blank\" href=\"" . $external_link . "\" class=\"border-radius-10 " . $btn_style . " \"><br>
                        <b>" . __($attr['textCTA'], $this->domain) . "</b><br>
                    </a>";
        }


        /* Use partal that displays HTML markup with data */
        $template_path = PLUGIN_ROOT_PATH . 'public\partials\blocks-mags-public-display.php';
        ob_start();
        include $template_path;
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

}
?>