<?php

/*
Plugin Name: Calculatrice
Plugin URL: https://groupe6.btssiolerebours.org/plugintest
Description: Ce plugin permet d'ajouter une calculatrice sur votre site WordPress
Version: Bêta 1.0
Author: Samy, Brahim, Anish, Louis en BTS-SIO-1
Author URL: https://groupe6.btssiolerebours.org/plugintest
*/

/***
 * Cela permet de vérifier si l'on utilise bien WordPress sinon, le plug-in ne marchera pas
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/***
 * Cette fonction permet d'envoyer au shortcode le formulaire pour la calculatrice
 */
function calculatriceFormulaire(){
    return "
        <p>Calculatrice bêta 1.0</p>
        <br>
        <div style='text-align: center; font-family: Arial'>
            <form action='#' method='post'>
            <p>Saisir le premier nombre :</p>
            <input type='number' name='nombre1'>
            <br>
            <p>Saisir le second nombre :</p>
            <input type='number' name='nombre2'>
            <br>
            <p>Addition</p>
            <input type='radio' name='signe' value='addition'>
            <p>Soustraction</p>
            <input type='radio' name='signe' value='soustraction'>
            <p>Multiplication</p>
            <input type='radio' name='signe' value='multiplication'>
            <p>Divison</p>
            <input type='radio' name='signe' value='division'>
            <br>
            <input type='submit' name='Calculer'>
        </form>
        </div>
    ";
}

/***
 * Cette fonction permet d'afficher le résultat du formulaire de la calculatrice
 * Cela permet d'afficher le résultat n'improte où sous forme de shortcode.
 */
function calculatriceResultat(){
    switch ($_POST['signe']) {
        case 'addition':
            $total = $_POST['nombre1'] + $_POST['nombre2'];
            break;
        case 'soustraction':
            $total = $_POST['nombre1'] - $_POST['nombre2'];
            break;
        case 'multiplication':
            $total = $_POST['nombre1'] * $_POST['nombre2'];
            break;
        case 'division':
            $total = $_POST['nombre1'] / $_POST['nombre2'];
            break;
    }
    return $total;
}

/***
 * Ces lignes de code permet de créer des shortcodes pour le formulaire et l'affichage du résultat
 */
add_shortcode('calculatriceFormulaire', 'calculatriceFormulaire');
add_shortcode('calculatriceResultat', 'calculatriceResultat');


/***
 * Cette ligne de code permet d'afficher un message lors de l'activation du plug-in
 */
echo "<h1 style='text-align: center'>L'extension calculatrice est activé !</h1>";
