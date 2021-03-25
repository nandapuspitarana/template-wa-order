<?php

add_filter('waorder_feature_tab_section','waorder_payment_tab_section', 10 , 2 );
function waorder_payment_tab_section($sections, $current_tab){
    if( $current_tab == 'payment' ):
        $sections['manual'] = 'Pembayaran Manual';
        $sections = apply_filters('waorder_feature_tab_section_ongkir', $sections);
    endif;

    return $sections;
}

add_action('waorder_feature_option_page_payment_general', 'waorder_payment_options_page_general' );
function waorder_payment_options_page_general(){

    $payment_provider = array(
        'manual' => 'Pembayaran Manual',
    );

    $payment_provider = apply_filters('waorder_feature_payment_provider', $payment_provider);

    ob_start();
    ?>
    <table>
        <tr>
            <th scope="row">
                <label><?php _e('Aktifkan Fitur Pilihan Pembayaran ?', 'waorder'); ?></label>
            </th>
            <td>
                <input name="waorder_feature_payment_enable" type="hidden" value="no"/>
                <input name="waorder_feature_payment_enable" type="checkbox" value="yes" <?php echo ( 'yes' == get_option('waorder_feature_payment_enable')) ? 'checked="chekced"': ''; ?> />
                <?php echo __('Aktifkan Fitur Pilihan Pembayaran') ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Provider Pembayaran', 'waorder'); ?></label>
            </th>
            <td>
                <select name="waorder_payment_provider" class="regular-text">

                    <?php foreach( (array) $payment_provider as $key =>$val ): ?>
                        <option value="<?php echo $key; ?>" <?php if(get_option('waorder_payment_provider', 'manual') == $key ){echo 'selected';}?>><?php echo $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
            </th>
            <td>
                <button class="button button-primary" type="submit" name="submit"><?php echo __('Simpan Pengaturan', 'waorder'); ?></button>
            </td>
        </tr>
    </table>
    <?php
    $content = ob_get_contents();
    ob_end_clean();

    echo $content;
}


add_action('waorder_feature_option_page_payment_manual', 'waorder_ongkir_options_page_payment_manual' );
function waorder_ongkir_options_page_payment_manual(){

    $lists = get_option('waorder_payment_manual_lists');

    ob_start();
    ?>
    <div class="waorder-payment-manual">
        <table class="waorder-input-box">
            <tbody>
                <?php foreach( (array)$lists as $key=>$val ): ?>
                    <?php if(empty($val)) continue; ?>
                    <tr class="waorder-shortcoe-field wpapgfield">
                        <td><input type="text" style="width:250px;" name="waorder_payment_manual_lists[<?php echo $key; ?>][bank]" value="<?php echo $val['bank']; ?>"></td>
                        <td><input type="text" type="text" style="width:250px;" name="waorder_payment_manual_lists[<?php echo $key; ?>][name]" value="<?php echo $val['name']; ?>"></td>
                        <td>
                            <div style="text-align:center;height: 30px;line-height: 30px;">
                                <span class="dashicons dashicons-trash waorder-shortcoe-field-remove" style="cursor:pointer;margin-top: 9px;"></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <button class="button add-more" type="button">Tambah Pilihan</button>
                    <td>
                    </td>
                    <td></td>
                <tr>
            </tfoot>
        </table>

        <button class="button button-primary" type="submit" name="submit">Simpan Pengaturan</button>
        <input type="hidden" name="waorder_key" value="global_shortcode"/>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                jQuery(".add-more").click(function(){
                    let field_length = jQuery('.waorder-input-box').find('tr.wpapgfield').length,
                    field_number = field_length + 1;

                    let html = '<tr class="waorder-shortcoe-field wpapgfield">';
                    html += '<td><input type="text" type="text" style="width:250px;" name="waorder_payment_manual_lists['+field_number+'][bank]" placeholder="Bank & No rek"></td>';
                    html += '<td><input type="text" type="text" style="width:250px;" name="waorder_payment_manual_lists['+field_number+'][name]" placeholder="Atas Nama"></td>';
                    html += '<td>';
                    html += '<div style="text-align:center;height: 30px;line-height: 30px;">';
                    html += '<span class="dashicons dashicons-trash waorder-shortcoe-field-remove" style="cursor:pointer;margin-top: 9px;"></span>';
                    html += '</div></td>';
                    html += '</tr>';
                    jQuery('tbody').append(html);
                });

                jQuery("body").on("click",".waorder-shortcoe-field-remove",function(){
                    jQuery(this).parents(".waorder-shortcoe-field").remove();
                });

            });

            function wpapgCopy(ini){
                let input = jQuery(ini).parent().find('input');
                input.select();
                document.execCommand('copy');
            }
        </script>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();

    echo $content;
}
