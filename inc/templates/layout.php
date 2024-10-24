<?php
extract($data);
$author_id = get_the_author_meta('ID');
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_permalink = get_author_posts_url($author_id);
$avatar = get_user_meta($author_id, 'profile_picture', true);

?>
<div class="gatb_container <?php echo $layout;?>" style='background-color: <?php echo $bg_color; ?>;'>
    <img src="<?php echo $avatar; ?>" alt="<?php echo esc_attr($author_name); ?>" class="gatb_image" style='width: <?php echo $image_width; ?>px; height: <?php echo $image_height; ?>px; border-radius: <?php echo $border_radius; ?>%;' />
    <div class="gatb_contents">
        <h2 class="gatb_author_name" style="color: <?php echo $text_color;?>;"><?php echo esc_attr($author_name); ?></h2>
        <p class="gatb_author_desc" style="color: <?php echo $text_color;?>;"><?php echo $author_description; ?></p>
        <a href="<?php echo $author_permalink;?>">Read More</a>
    </div>
</div>