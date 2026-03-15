<?php
namespace Hasan\OurFirstUniquePlugin\BlogContentEdit;
class BlogContentEdit
{
    public function init()
    {
        add_action('init', [$this, 'editContent']);
    }

    public function editContent()
    {
        // do something
        add_filter('the_content', [$this, 'addToEndOfBlogContent']);

    }

    public function addToEndOfBlogContent()
    {
        $content = get_the_content();
        if (is_single() && is_main_query()) {
            if (get_post_type() == 'post') {
                $content .= '<p style="color:coral;" class="ofup-red">Added by Our First Unique Plugin</p>';
            }
        }

        return $content;
    }

}

?>