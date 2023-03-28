<?php
/*
Plugin Name: Barre de Notification
Plugin URL: https://groupe6.btssiolerebours.org/plugintest
Description: Ce plugin permet d'ajouter une barre de notification personnalisée en haut de votre page ou site.
Version: Bêta 1.0
Author: Samy, Brahim, Anish, Louis en BTS-SIO-1
Author URL: https://groupe6.btssiolerebours.org/plugintest
*/

add_action('wp_body_open', 'tb_head');

function get_user_or_websitename()
{
    if( !is_user_logged_in() )
    {
        if(get_option('Barreduhaut_field')){
            return get_option('Barreduhaut_field');
        } else {
            return 'Bienvenue' . get_bloginfo('name');
        }

    }
    else
    {
        $current_user = wp_get_current_user();
        return 'Bienvenue ' . $current_user -> user_login;
    }
}

function tb_head()
{
    echo '<h3 class="tb">' . get_user_or_websitename() . '</h3>';
}


add_action('wp_print_styles', 'tb_css');

//ajoute le css à la barre
function tb_css()
{
    echo '
        <style>
		h3.tb {color: #000000; margin: 0; padding: 35px; text-align: center; background: skyblue}
        </style>
    ';
}

//Plugin pour la barre

function Barreduhaut_plugin_page() {
    $page_title = 'Barre de Notification Options';
    $menu_title = 'Barre de Notification';
    $capatibily = 'manage_options';
    $slug = 'Barreduhaut-plugin';
    $callback = 'Barreduhaut_page_html';
    $icon = 'dashicons-schedule';
    $position = 60;

    add_menu_page($page_title, $menu_title, $capatibily, $slug, $callback, $icon, $position);
}

add_action('admin_menu', 'Barreduhaut_plugin_page');

function Barreduhaut_register_settings() {
    register_setting('Barreduhaut_option_group', 'Barreduhaut_field');
}

add_action('admin_init', 'Barreduhaut_register_settings');

function Barreduhaut_page_html() { ?>
    <div class="wrap Barreduhaut-wrapper">
        <form method="post" action="options.php">
            <?php settings_errors() ?>
            <?php settings_fields('Barreduhaut_option_group'); ?>
            <label for="Barreduhaut_field_eat">Texte à saisir dans la barre :</label>
            <input name="Barreduhaut_field" id="Barreduhaut_field_eat" type="text" value=" <?php echo get_option('Barreduhaut_field'); ?> ">
            <?php submit_button(); ?>
        </form>
    </div>

<?php }


add_action('admin_head', 'Barreduhautstyle');

function Barreduhautstyle() {
    echo '<style>
	.Barreduhaut-wrapper {display: flex; align-items: center;justify-content: center;margin-top:35px}
	.Barreduhaut-wrapper form {width: 100%; max-width: 800px;}
	.Barreduhaut-wrapper label {font-size: 3em; display: block; line-height:normal; margin-bottom: 30px;font-weigth:bold}
	.Barreduhaut-wrapper input {color:#666;width: 100%; padding: 30px; font-size: 3em}
	.Barreduhaut-wrapper .button {font-size: 2em; text-transform: uppercase; background: rgba(59,173,227,1);
		background: linear-gradient(45deg, rgba(59,173,227,1) 0%, rgba(87,111,230,1) 25%, rgba(152,68,183,1) 51%, rgba(255,53,127,1) 100%);border:none}
  	</style>';
}