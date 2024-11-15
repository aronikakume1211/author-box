<?php
if (! defined('ABSPATH')) exit;

$author_id = get_the_author_meta('ID');
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_permalink = get_author_posts_url($author_id);
$avatar = get_user_meta($author_id, 'profile_picture', true);

$bg_color = isset($data['bg_color']) ? $data['bg_color'] : '';
$text_color = isset($data['text_color']) ? $data['text_color'] : '';
$image_width = isset($data['image_width']) ? $data['image_width'] : '';
$image_height = isset($data['image_height']) ? $data['image_height'] : '';
$border_radius = isset($data['border_radius']) ? $data['border_radius'] : '';
$show_link = isset($data['show_link']) ? $data['show_link'] : '';
$read_more_text = isset($data['read_more_text']) ? $data['read_more_text'] : '';
$layout = isset($data['layout']) ? $data['layout'] : '';

?>
<div class="rsab_container <?php echo esc_attr($layout); ?>" style="background-color: <?php echo esc_attr($bg_color); ?>;">
    <img
        src="<?php echo esc_url($avatar); ?>"
        alt="<?php echo esc_attr($author_name); ?>"
        class="rsab_image"
        style="
            width: <?php echo intval($image_width); ?>px; 
            height: <?php echo intval($image_height); ?>px; 
            border-radius: <?php echo intval($border_radius); ?>%;" />
    <div class="rsab_contents">
        <h2 class="rsab_author_name" style="color: <?php echo esc_attr($text_color); ?>;">
            <?php echo esc_html($author_name); ?>
        </h2>
        <p class="rsab_author_desc" style="color: <?php echo esc_attr($text_color); ?>;">
            <?php echo esc_html($author_description); ?>
        </p>
        <?php if (!empty($show_link)): ?>
            <a href="<?php echo esc_url($author_permalink); ?>">
                <?php echo esc_html($read_more_text ?: 'Read More'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>