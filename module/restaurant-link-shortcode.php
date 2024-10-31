<?php
if (!defined('ABSPATH')) die;

if (!defined('WPINC')) die;

$options = get_option('rest_link_settings');
if (isset($_POST['resrv_button']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (wp_verify_nonce($_REQUEST['_wpnonce'], 'resv_post_action')) {
        if (date("Y-m-d") <= $_POST['resrv_date']) {
            $to_resv = $options['sender_mail'];
            $resv_subject = __('Nouvelle réservation', RESTAURANT_LINK_SLUG);
            $resv_content = "<p><h3>" . __('Bonjour', RESTAURANT_LINK_SLUG) . "</h3></p>";
            $resv_content .= "<p><b>" . __('Vous avez une nouvelle réservation', RESTAURANT_LINK_SLUG) . "</b></p>";
            $resv_content .= "<p><b>" . __('Nom & prénom', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html(($_POST['resv_name'])) . " </p>";
            $resv_content .= "<p><b>" . __('E-mail', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html($_POST['resv_mail']) . " </p>";
            $resv_content .= "<p><b>" . __('Tél', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html($_POST['resv_phone']) . " </p>";
            if (isset($_POST['resrv_heur'])) {
                $resv_content .= "<p><b>" . __('Date de réservation', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html($_POST['resrv_date']) . __(' à ', RESTAURANT_LINK_SLUG) . esc_html($_POST['resrv_heur']) . " </p>";
            } else {
                $resv_content .= "<p><b>" . __('Date de réservation', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html($_POST['resrv_date']) . "</p>";
            }
            $resv_content .= "<p><b>" . __('Nombre des personnes', RESTAURANT_LINK_SLUG) . "</b>: " . esc_html($_POST['resrv_person']) . " </p>";
            $resv_content .= "<p><b>" . __('Table', RESTAURANT_LINK_SLUG) . "</b> : " . esc_html(($_POST['resrv_table'])) . "</p>";
            if (!empty($_POST['resrv_note'])) {
                $resv_content .= "<p><b>" . __('Message', RESTAURANT_LINK_SLUG) . "</b>:<br> " . esc_html($_POST['resrv_note']) . " </p>";
            }

            $headers = array('Content-Type: text/html; charset=UTF-8');

            if (wp_mail($to_resv, $resv_subject, $resv_content, $headers)) {
                echo "<div class='rest_link_content resv_succes'>" . $options['succes_message'] . "</div>";

            } else {
                echo "<div class='rest_link_content resv_error'>" . $options['error_message'] . "</div>";
            }
        } else {
            echo "<div class='rest_link_content resv_error'>" . $options['date_error_message'] . "</div>";
        }
    }

}

?>
<div class="rest_link_content">
    <form method="post" action="" id="rest_link_resv">
        <?php wp_nonce_field('resv_post_action'); ?>
        <div class="rest-form-group">
            <p><?php echo __('Nom et prénom', RESTAURANT_LINK_SLUG) ?></p>
            <input type="text" name="resv_name" required>
        </div>
        <div class="rest-form-group">
            <p><?php echo __('Email', RESTAURANT_LINK_SLUG) ?></p>
            <input type="email" name="resv_mail" required>
        </div>
        <div class="rest-form-group">
            <p><?php echo __('Téléphone', RESTAURANT_LINK_SLUG) ?></p>
            <input type="tel" name="resv_phone" required>
        </div>

        <div class="rest-form-group">
            <p><?php echo __('Date de réservation', RESTAURANT_LINK_SLUG) ?></p>
            <input type="date" name="resrv_date" required>
        </div>
        <div class="rest-form-group">
            <p><?php echo __('Nombre des personnes', RESTAURANT_LINK_SLUG) ?></p>
            <select name="resrv_person" required>
                <?php
                for ($i = $options['min_person']; $i <= $options['max_person']; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>

        </div>

        <div class="rest-form-group">
            <p><?php echo __('Table', RESTAURANT_LINK_SLUG) ?></p>
            <select name="resrv_table" required>

                <?php
                $i = 1;
                foreach ($options['table_size'] as $table) {
                    if (!empty($table)) {
                        $customer = explode(':', $table);
                        if (isset($customer[1])) {
                            echo '<option title="' . __('Pour ', RESTAURANT_LINK_SLUG) . $customer[0] . __(' jusqu\'à ', RESTAURANT_LINK_SLUG) . $customer[1] . __(' personne', RESTAURANT_LINK_SLUG) . '" data-min="' . $customer[0] . '" data-max="' . $customer[1] . '"  value="' . $i . '">' . __('Table ', RESTAURANT_LINK_SLUG) . $i . '</option>';
                        } else {
                            echo '<option title="' . __('Pour ', RESTAURANT_LINK_SLUG) . $customer[0] . __(' personne', RESTAURANT_LINK_SLUG) . '" data-min="1" data-max="' . $customer[0] . '"  value="' . $i . '">' . __('Table ', RESTAURANT_LINK_SLUG) . $i . '</option>';

                        }
                        $i++;
                    }
                }

                ?>
                <option value="<?php echo __('Autre choix', RESTAURANT_LINK_SLUG) ?>"><?php echo __('Autre choix', RESTAURANT_LINK_SLUG) ?></option>
            </select>

        </div>
        <?php if ($options['open_time_midday'] != $options['close_time_midday'] || $options['open_time_evening'] != $options['close_time_evening']) {
            ?>
            <div class="rest-form-group">
                <p><?php echo __('Heure de réservation', RESTAURANT_LINK_SLUG) ?></p>
                <select name="resrv_heur" required>
                    <?php
                    if ($options['open_time_midday'] < $options['close_time_midday']) {
                        $start_midday = $options['open_time_midday'];
                        $end_midday = $options['close_time_midday'];
                        $t_midday_start = strtotime($start_midday);
                        $t_midday_end = strtotime($end_midday);
                        $tNow = $t_midday_start;
                        while ($tNow <= $t_midday_end) {
                            echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                            $tNow = strtotime('+15 minutes', $tNow);
                        }
                    }
                    if ($options['open_time_evening'] < $options['close_time_evening']) {
                        $start_evening = $options['open_time_evening'];
                        $end_evening = $options['close_time_evening'];
                        $t_evening_start = strtotime($start_evening);
                        $t_evening_end = strtotime($end_evening);
                        $tNow = $t_evening_start;
                        while ($tNow <= $t_evening_end) {
                            echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                            $tNow = strtotime('+15 minutes', $tNow);
                        }

                    }

                    ?>
                </select>

            </div>
            <?php
        }
        ?>

        <div class="rest-form-group">
            <p><?php echo __('Message', RESTAURANT_LINK_SLUG) ?></p>
            <textarea name="resrv_note" rows="5"></textarea>
        </div>
        <div class="rest-form-group">

            <button type="submit"
                    name="resrv_button"> <?php echo __('Réserver maintenant', RESTAURANT_LINK_SLUG) ?></button>

        </div>

    </form>

</div>