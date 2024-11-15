<?php

namespace RSAB;

if (! defined('ABSPATH')) exit;
class Profile
{
    public function __construct()
    {
        add_action('show_user_profile', [$this, 'rsab_profile_picture']);
        add_action('edit_user_profile', [$this, 'rsab_profile_picture']);
        add_action('personal_options_update', [$this, 'rsab_profile_picture_update']);
        add_action('edit_user_profile_update', [$this, 'rsab_profile_picture_update']);
    }

    /**
     * Add profile picture field to the user profile.
     */
    public function rsab_profile_picture($user)
    {
?>
        <table class="form-table">
            <tr>
                <th><label for="Image"><?php esc_html_e("Profile Picture", 'really-simple-author-box'); ?></label></th>
                <td>
                    <div id="profile-picture-preview" style=" background-image:url(<?php echo esc_attr(get_the_author_meta('profile_picture', $user->ID)) ?: 'https://1.gravatar.com/avatar/d459c0256b4417973ea8b940d7a82021?s=96&d=mm&r=g'; ?>);" class="rounded-circle"> </div>
                    <input type="hidden" name="profile_picture" value="<?php echo esc_attr(get_the_author_meta('profile_picture', $user->ID)); ?>" id="profile_picture" />

                    <div class="flex" style="display: flex; ">
                        <input type='button' class="button-primary" value="<?php echo esc_attr(get_the_author_meta('profile_picture', $user->ID)) ? 'update' : 'Upload Profile'; ?>" id="uploadimage" style="margin-right: 20px;" />
                        <?php if (esc_attr(get_the_author_meta('profile_picture', $user->ID))): ?>
                            <input type='button' class="button-primary" value="Remove " id="remove-picture" />
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
<?php
    }

    /**
     * Update profile picture.
     */
    public function rsab_profile_picture_update($user_id)
    {
        if (
            empty($_POST['_wpnonce']) ||
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), "update-user_$user_id") ||
            !current_user_can('edit_user', $user_id)
        ) {
            return false;
        }
        // Sanitize the profile picture input
        $profile_picture = isset($_POST['profile_picture']) ? sanitize_text_field(wp_unslash($_POST['profile_picture'])) : '';

        // Optionally, if it's meant to be a URL
        $profile_picture = esc_url($profile_picture);

        // Update the user meta with sanitized input
        update_user_meta($user_id, 'profile_picture', $profile_picture);
    }
}
