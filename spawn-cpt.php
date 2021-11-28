<?php

/**
 *  Plugin Name: Spawn CPT
 *  Plugin URI: https://www.vincentriva.fr/
 *  Description: Plugins to create easily CPT & taxonomies
 *  Author: Vincent Riva <vincent.riva@outlook.fr>
 *  Version: 1.0.0
 *  Author URI: https://www.vincentriva.fr/
 */

include_once __DIR__ . '/vendor/autoload.php';

use \Spawn\App\CPT;
use \Spawn\App\Taxonomy;

(new CPT('books'))
    ->setIcon('dashicons-book')
    ->setMenuPosition(10)
    ->setSingular('Book')
    ->setPlural('Books')
    ->register();

(new Taxonomy('genres'))
    ->setSingular('Genre')
    ->setPlural('Genres')
    ->setCPT('books')
    ->register();


add_action('wp_loaded', function () {
    // echo '<pre>'.print_r(CPT::findAll('books'), true) . '</pre>';die;
    // echo '<pre>'.print_r(Taxonomy::findAllTerms('genres'), true) . '</pre>';die;
});
