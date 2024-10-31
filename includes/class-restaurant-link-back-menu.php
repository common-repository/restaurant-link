<?php

class Restaurant_Link_Back_Menu
{

    public function __construct()
    {

        add_action('admin_init', array($this, 'rest_link_settings_init'));
    }

    static function dashboard_rest()
    {
        ?>
        <div class="wrap">
            <div class="rest-link-content">
                <h1 class="wp-heading-inline">
                    <?php printf('%s', __('Reservation LINK', RESTAURANT_LINK_SLUG)) ?>
                </h1>
                <hr class="wp-header-end">
                <form id="rest-link-form-settings" action='options.php' method='post'>


                    <?php
                    $options = get_option('rest_link_settings');

                    settings_fields('RestLinkPluginPage');
                    do_settings_sections('RestLinkPluginPage');
                    submit_button();
                    ?>

                </form>
            </div>
        </div>
        <?php


    }

    public function rest_link_settings_init()
    {

        register_setting('RestLinkPluginPage', 'rest_link_settings');

        /* Description */

        add_settings_section(
            'RestLinkPluginPage_section',
            __('Description', RESTAURANT_LINK_SLUG),
            array($this, 'rest_link_section_callback'),
            'RestLinkPluginPage'
        );

        /* sender mail */

        add_settings_field(
            'sender_mail',
            __('Email pour recevoir les réservations', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="1"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_7_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section',
            array('type' => 'repeater')
        );

        /* minimum person */

        add_settings_field(
            'min_person',
            __('Nombre de personnes minimum par table', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="2"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_0_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );

        /* maximum person */

        add_settings_field(
            'max_person',
            __('Nombre de personnes maximum par table', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="3"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_1_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );


        /* open time first session */

        add_settings_field(
            'open_time_midday',
            __('Heure d\'ouverture du midi', RESTAURANT_LINK_SLUG)
            . ' <a class="rest-link-modal-open curs-point" data-target="9"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_2_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section',
            array('class' => 'rest-link-setting-hour-first-s')
        );

        /* close time first session */

        add_settings_field(
            'close_time_midday',
            __('Heure de fermeture du midi', RESTAURANT_LINK_SLUG),
            array($this, 'rest_link_text_field_3_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section',
            array('class' => 'rest-link-setting-hour-first-s')
        );

        /* open time second session  */

        add_settings_field(
            'open_time_evening',
            __('Heure d\'ouverture du soir', RESTAURANT_LINK_SLUG)
            . ' <a class="rest-link-modal-open curs-point" data-target="10"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_9_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section',
            array('class' => 'rest-link-setting-hour-second-s')
        );

        /* close time second session */

        add_settings_field(
            'close_time_evening',
            __('Heure de fermeture du soir', RESTAURANT_LINK_SLUG),
            array($this, 'rest_link_text_field_10_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section',
            array('class' => 'rest-link-setting-hour-second-s')
        );


        /* succes message */

        add_settings_field(
            'succes_message',
            __('Message de succès', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="5"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_4_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );

        /* error message */

        add_settings_field(
            'error_message',
            __('Message d\'erreur', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="6"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_5_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );

        /* date error message */

        add_settings_field(
            'date_error_message',
            __('Message d\'erreur date de réservation', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="7"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_6_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );

        /* Nb Table */

        add_settings_field(
            'table_size',
            __('Les tables du restaurant', RESTAURANT_LINK_SLUG) . '<span class="rest-link-required">*</span>'
            . ' <a class="rest-link-modal-open curs-point" data-target="8"><span class="dashicons dashicons-editor-help"></span></a>',
            array($this, 'rest_link_text_field_8_render'),
            'RestLinkPluginPage',
            'RestLinkPluginPage_section'
        );


    }

    /* Field description */

    public function rest_link_section_callback()
    {
        echo __('Restaurant link vous offre la possibilité de créer un formulaire de réservation dynamique pour votre site internet.', RESTAURANT_LINK_SLUG);
        ?>
        <div class="rest-link-modal-container" id="rest-link-modal-0">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Copier ce texte &laquo; [restaurant_link_reservation_form] &raquo; et insérer dans le contenu 
                d\'une page à l\'endroit où faire apparaître le formulaire de réservation. 
                Un shortcode vous permet d\'insérer votre module de réservation à l\'endroit 
                qui convient dans le contenu de votre site.', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-1">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Une notification sera envoyée à cette adresse lors de 
                chaque réservation. Une seule adresse email permise.', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-2">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Il ne sera pas possible de faire une réservation pour 
                un nombre inférieur à cette valeur (champ nombre de personnes du formulaire).', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-3">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Il ne sera pas possible de faire une réservation pour 
                un nombre de personnes supérieur à cette valeur (champ nombre de personnes du formulaire).', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>

        <div class="rest-link-modal-container" id="rest-link-modal-5">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Permet de personnaliser le message qui s\'affiche lorsque la 
                demande de réservation a bien été enregistrée, exemple: "Merci, votre réservation a été enregistrée 
                avec succès, un email de confirmation vous a été envoyé."', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-6">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Permet de personnaliser le message qui s\'affiche lorsque la demande 
                de réservation n\'a pas pu être enregistrée correctement, exemple: "Malheureusement, votre réservation 
                n\'a pas pu être enregistrée, merci d\'effectuer une nouvelle tentative. "', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-7">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Permet de personnaliser le message qui s\'affiche lorsque la date de 
                réservation choisie est antérieure à la date du jour, exemple: "La date choisie est passée ! Choisissez 
                une autre date.', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-8">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Les tables du restaurant sont organisées comme suit.', RESTAURANT_LINK_SLUG)) ?></p>
                <p><?php printf('%s', __('Pour chaque table ajoutée (table 1 X:Y) il est possible de définir la 
                capacité minimale (X)et maximale (Y) de la table. En fonction du nombre de personnes saisies dans le 
                formulaire, seules les tables avec une capacité adaptées pourront être sélectionnées. Le bouton "Nouvelle table" 
                permet d\'ajouter une nouvelle table. Chaque table est numérotée en fonction de son ordre de création. 
                Nous vous recommandons donc de suivre la numérotation de vos tables pour les créer dans le plugin. 
                Vous pouvez également supprimer une table. Attention à ne pas oublier d\'enregistrer vos paramètres.', RESTAURANT_LINK_SLUG)) ?></p>
                <p><b><?php printf('%s', __('Vous avez la possibilité de compléter votre page de réservation avec 
                le plan de votre restaurant (sous la forme d\'une image jpeg).', RESTAURANT_LINK_SLUG)) ?></b></p>
            </div>
        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-9">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Permet de définir la plage horaire de réservation du midi.', RESTAURANT_LINK_SLUG)) ?></p>
            </div>

        </div>
        <div class="rest-link-modal-container" id="rest-link-modal-10">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <p><?php printf('%s', __('Permet de définir la plage horaire de réservation du soir.', RESTAURANT_LINK_SLUG)) ?></p>
            </div>
        </div>

        <div class="rest-link-modal-container" id="rest-link-error-modal">
            <div class="rest-link-modal-content">
                <span class="rest-link-modal-close">&times;</span>
                <h3></h3>
                <p>
                    <a class="rest-link-modal-close"><?php printf('%s', __('Ok', RESTAURANT_LINK_SLUG)) ?></a>
                </p>

            </div>

        </div>
        <?php

        $options = get_option('rest_link_settings');

        if ($this->check_filds() == true) {
            ?>
            <h2>Shortcode:<a class="rest-link-modal-open curs-point" data-target="0"><span
                            class="dashicons dashicons-editor-help"></span></a> <span style="font-size: 15px">[restaurant_link_reservation_form]</span>
            </h2>
            <?php
        } else {
            echo "<p style='color: red'><b>" . __('Merci de remplir tous les champs obligatoires pour activer le short code de réservation', RESTAURANT_LINK_SLUG) . "</b></p>";
        }
    }

    /* Check Field */

    static function check_filds()
    {
        $return = false;
        $options = get_option('rest_link_settings');
        if (!empty($options)) {
            if (!empty($options['min_person']) && !empty($options['max_person']) && !empty($options['error_message']) && !empty($options['date_error_message'])
                && !empty($options['succes_message']) && !empty($options['sender_mail']) && !empty($options['table_size'])) {
                $return = true;
            }

        }
        return $return;

    }

    /* Field minimum person */

    public function rest_link_text_field_0_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <input type='number'
               name='rest_link_settings[min_person]'
               value="<?php if (isset($options['min_person'])) echo $options['min_person']; ?>" min="0">
        <?php

    }


    /* Field maximum person */

    public function rest_link_text_field_1_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <input type='number'
               name='rest_link_settings[max_person]'
               value="<?php if (isset($options['max_person'])) echo $options['max_person']; ?>">
        <?php
    }


    /* Field open time midday */

    public function rest_link_text_field_2_render()
    {
        $options = get_option('rest_link_settings');
        ?>
        <select title="<?php echo __('Attention : l\'heure d\'ouverture du midi doit être inférieur à l\'heure de fermeture', RESTAURANT_LINK_SLUG) ?>"
                id="open_time_midday" name='rest_link_settings[open_time_midday]'>

            <?php
            $start = "00:00";
            $end = "23:00";
            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
            while ($tNow <= $tEnd) {
                if (!empty($options['open_time_midday']) && $options['open_time_midday'] == date("H:i", $tNow)) {
                    echo '<option  value="' . date("H:i", $tNow) . '" selected>' . date("H:i", $tNow) . '</option>';
                } else {
                    echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                }
                $tNow = strtotime('+15 minutes', $tNow);
            }
            ?>
        </select>
        <?php
    }


    /* Field close time midday */

    public function rest_link_text_field_3_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <select title="<?php echo __('Attention : l\'heure de fermeture du midi doit être supérieur à l\'heure d\'ouverture', RESTAURANT_LINK_SLUG) ?>"
                id="close_time_midday" name='rest_link_settings[close_time_midday]'>
            <?php
            $start = "00:00";
            $end = "23:00";
            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
            while ($tNow <= $tEnd) {
                if (!empty($options['close_time_midday']) && $options['close_time_midday'] == date("H:i", $tNow)) {
                    echo '<option  value="' . date("H:i", $tNow) . '" selected>' . date("H:i", $tNow) . '</option>';
                } else {
                    echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                }
                $tNow = strtotime('+15 minutes', $tNow);
            }
            ?>
        </select>
        <?php
    }

    /* Field open time evening */

    public function rest_link_text_field_9_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <select title="<?php echo __('Attention : l\'heure d\'ouverture du soir doit être inférieur à l\'heure de fermeture', RESTAURANT_LINK_SLUG) ?>"
                id="open_time_evening" name='rest_link_settings[open_time_evening]'>
            <?php
            $start = "00:00";
            $end = "23:00";
            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
            while ($tNow <= $tEnd) {
                if (!empty($options['open_time_evening']) && $options['open_time_evening'] == date("H:i", $tNow)) {
                    echo '<option  value="' . date("H:i", $tNow) . '" selected>' . date("H:i", $tNow) . '</option>';
                } else {
                    echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                }
                $tNow = strtotime('+15 minutes', $tNow);
            }
            ?>
        </select>
        <?php
    }


    /* Field close time evening */

    public function rest_link_text_field_10_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <select title="<?php echo __('Attention : l\'heure de fermeture du soir doit être supérieur à l\'heure d\'ouverture', RESTAURANT_LINK_SLUG) ?>"
                id="close_time_evening" name='rest_link_settings[close_time_evening]'>

            <?php
            $start = "00:00";
            $end = "23:00";
            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
            while ($tNow <= $tEnd) {
                if (!empty($options['close_time_evening']) && $options['close_time_evening'] == date("H:i", $tNow)) {
                    echo '<option  value="' . date("H:i", $tNow) . '" selected>' . date("H:i", $tNow) . '</option>';
                } else {
                    echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
                }
                $tNow = strtotime('+15 minutes', $tNow);
            }
            ?>


        </select>
        <?php

    }

    /* Field succes message */

    public function rest_link_text_field_4_render()
    {

        $options = get_option('rest_link_settings');

        ?>

        <input type='text'
               name='rest_link_settings[succes_message]' style="width: 400px"
               value="<?php if (isset($options['succes_message'])) echo $options['succes_message']; ?>">
        <?php


    }

    /* Field error message */

    public function rest_link_text_field_5_render()
    {

        $options = get_option('rest_link_settings');
        ?>
        <input type='text'
               name='rest_link_settings[error_message]' style="width: 400px"
               value="<?php if (isset($options['error_message'])) echo $options['error_message']; ?>">
        <?php

    }

    /* Field date error message */

    public function rest_link_text_field_6_render()
    {

        $options = get_option('rest_link_settings');
        ?>

        <input type='text'
               name='rest_link_settings[date_error_message]' style="width: 400px"
               value="<?php if (isset($options['date_error_message'])) echo $options['date_error_message']; ?>">
        <?php

    }

    /* Field sender mail */

    public function rest_link_text_field_7_render()
    {
        $options = get_option('rest_link_settings');
        if (empty($options['sender_mail'])) {
            $email = get_bloginfo('admin_email');
        } else {
            $email = $options['sender_mail'];
        }

        ?>
        <input type='email'
               name='rest_link_settings[sender_mail]' style="width: 400px"
               value="<?php echo $email ?>">
        <?php

    }

    /* Fields Tables */

    public function rest_link_text_field_8_render()
    {
        $options = get_option('rest_link_settings');
        if (!empty($options['table_size'])) {
            $i = 0;
            foreach ($options['table_size'] as $table) {
                if (!empty($table) || $table != 0) {

                    ?>
                    <div>
                        <label id="<?php echo $i + 1 ?>"><?php echo __('Table', RESTAURANT_LINK_SLUG) ?> <span
                                    class="count"><?php echo $i + 1 ?></span> :
                        </label>
                        <input type='text'
                               name='rest_link_settings[table_size][<?php echo $i ?>]' style="margin-bottom: 10px"
                               value="<?php echo $table ?>">
                        <button class="rest-link-jq-remove-table"
                                data-message="<?php echo __('Êtes-vous sûr de supprimer la table', RESTAURANT_LINK_SLUG) ?>"
                                datafld="<?php echo $i + 1 ?>" type="submit"
                                title="<?php echo __('Supprimer', RESTAURANT_LINK_SLUG) ?>"><span
                                    class="dashicons dashicons-no-alt"></span></button>
                    </div>
                    <?php
                    $i++;

                }
            }

        }

        ?>

        <p style="margin-top: 10px">
            <a herf="#" class="show-block-elemnt curs-point">
                <b>
                    <span class="dashicons dashicons-plus-alt"></span>
                    <?php echo __('Nouvelle table', RESTAURANT_LINK_SLUG) ?>
                </b>
            </a>
        </p>
        <div class="hide-block-elemnt" style="display: none">
            <div class="clone">
                <label><?php echo __('Nouvelle table', RESTAURANT_LINK_SLUG) ?> <span class="count">1</span> : </label>
                <input type='text'
                       name='rest_link_settings[table_size][]' style="margin-bottom: 10px"
                       placeholder="<?php echo __('Nombre des personnes', RESTAURANT_LINK_SLUG) ?>"></div>
            <p>
                <i><?php echo __('Pour chaque table saisir le nombre min de personnes:le nombre de personnes Exemple 10:20', RESTAURANT_LINK_SLUG) ?></i>
            </p>
            <a href="#" class="add" rel=".clone"><span class="dashicons dashicons-plus"></span></a>
        </div>
        <?php

    }


    public function admin_menu()
    {

        add_menu_page(RESTAURANT_LINK_NAME, RESTAURANT_LINK_NAME, 'manage_options', RESTAURANT_LINK_SLUG, array($this, 'dashboard_rest'), 'dashicons-store', '100');

    }


}