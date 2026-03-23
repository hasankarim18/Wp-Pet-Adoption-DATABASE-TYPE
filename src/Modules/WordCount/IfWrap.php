<?php

namespace Hasan\TroviaWpWordcount\WordCount;

class IfWrap
{
    public function register()
    {

        add_filter('the_content', [$this, 'ifWrap']);
    }

    public function ifWrap($content) // <--- ACCEPT the variable
    {
        // Use the $content passed in, NOT get_the_content()
        if (
            is_single() && is_main_query() AND
            (
                get_option('wcp_enable_character_count', '1') OR
                get_option('wcp_show_word_count', '1') OR
                get_option('wcp_show_read_time', '1')
            )
        ) {
            return $this->createHTML($content);
        }

        return $content; // Pass it to the screen or next plugin
    }

    function createHTML($content)
    {
        $headline = esc_html(get_option('wcp_headline_text', 'Hello world!'));

        $showWord = get_option('wcp_show_word_count', '1');
        $showChar = get_option('wcp_enable_character_count', '1');
        $showRead = get_option('wcp_show_read_time', '1');

        if ($showWord || $showRead) {
            $wordCount = str_word_count(strip_tags($content));
        }
        ob_start();
        ?>
        <div class="wcp-box">
            <h3><?php echo $headline; ?></h3>

            <?php if ($showWord): ?>
                <p style="margin:0; padding:0; margin-bottom: 5px;">This post has <?php echo $wordCount; ?> words.</p>
            <?php endif; ?>

            <?php if ($showChar): ?>
                <p style="margin:0; padding:0; margin-bottom: 5px;">This post has <?php echo strlen(strip_tags($content)); ?>
                    characters.</p>
            <?php endif; ?>

            <?php if ($showRead): ?>
                <p style="margin:0; padding:0; margin-bottom: 5px;">Read time: <?php echo round($wordCount / 200); ?> minute(s).</p>
            <?php endif; ?>
            <hr>
        </div>

        <?php

        $html = ob_get_clean();



        if (get_option('wcp_location', '0') == '0') {
            return $html . $content;
        } else {
            return $content . $html;
        }
    }
}


?>