<?php
//show this settings page
function jozzampimageslider_custom_settings_start()
{
 ?>
<div class="wrap jozzampimageslider_adminwrap">
    <h1>AMP Image Slider WP</h1>
    This plugin makes it easy to create a before and after image comparison feature, using <a href="https://amp.dev" target="_blank">AMP</a> technology.<br /> If you prefer to implement an AMP image slider yourself without this plugin check out the related <a href="https://amp.dev/documentation/examples/components/amp-image-slider/" target="_blank">amp-image-slider</a> component.
    <p><i>For best results use the <a href="https://wordpress.org/plugins/amp/" target="_blank">official AMP plugin</a>, with the viewing options below applicable only for this plugin, rending on AMP or non AMP URLs. </i>


<p> To make the image slider appear in your site paste the <code>[jozz-ampimageslider]</code> shortcode into a page or post. 



    <form method="post" action="options.php">
        <?php settings_fields('jozzampimageslider-settings'); ?>
        <table class="form-table">
            <tr>
                <th>
                    <label for="width">Width (in pixels)</label>
                </th>
                <td>
                    <div class="pagebox">
                        <input class="jozzampimageslider_width_field" type="text" name="jozzampimageslider_width"
                            value="<?= esc_attr(get_option('jozzampimageslider_width','600')) ?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="height">Height (in pixels)</label>
                </th>
                <td>
                    <div class="pagebox">
                        <input class="jozzampimageslider_height_field" type="text" name="jozzampimageslider_height"
                            value="<?= esc_attr(get_option('jozzampimageslider_height','300')) ?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <th><label for="viewoption">Viewing options</label></th>
                <td>
                    <select name="viewoption">
                        <option value='<?= esc_attr(get_option('viewoption')) ?>' selected>
                            <?= esc_attr(get_option('viewoption','AMP & Canonical')) ?></option>
                        <option value='AMP only'>AMP only</option>
                        <option value='Canonical only'>Canonical only</option>
                        <option value='AMP & Canonical'>AMP & Canonical</option>
                    </select>
                </td>
            </tr>
            <!-- start image uploader -->
            <hr />
            <tr>
                <th></th>
                <td style="float: left;">
                    <img height="150px" id="showpre1a" src="<?=esc_url( get_option('jozzampimageslider_image_1a') );?>">
                </td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <label for="jozzampimageslider_image_1a"><?php _e( 'Before Image'); ?></label>
                </th>
                <td>
                    <input type="url" name="jozzampimageslider_image_1a" id="jozzampimageslider_img1a"
                        class="regular-text" value="<?=esc_url( get_option('jozzampimageslider_image_1a') );?>" />
                    <span class="button button-primary" id="select_img1a">Select</span>
                    <span class="button button-primary" id="resetMe1a">Reset</span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td style="float: left;">
                    <img height="150px" id="showpre1b" src="<?=esc_url( get_option('jozzampimageslider_image_1b') );?>">
                </td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <label for="jozzampimageslider_image_1b"><?php _e( 'After Image'); ?></label>
                </th>
                <td>
                    <input type="url" name="jozzampimageslider_image_1b" id="jozzampimageslider_img1b"
                        class="regular-text" value="<?=esc_url( get_option('jozzampimageslider_image_1b') );?>" />
                    <span class="button button-primary" id="select_img1b">Select</span>
                    <span class="button button-primary" id="resetMe1b">Reset</span>
                </td>
            </tr>
            <!-- end image uploader -->
        </table>
        <?php submit_button(); ?>

    </form>
</div>
<?php
}