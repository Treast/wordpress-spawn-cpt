<?php

namespace Spawn\App;

class Taxonomy {
    private string $_name;
    private ?string $_singularName;
    private ?string $_pluralName;
    private ?string $_menuName;
    private bool $_hierarchical;
    private $_cpt;
    
    public function __construct(string $name) {
        $this->_name = $name;
        $this->_hierarchical = true;
        $this->_cpt = [];
        
        $this->_menuName = null;
        $this->_singularName = null;
        $this->_pluralName = null;
    }

    public function register() {
        add_action('init', function() {
            $this->registerInit();
        });
    }

    private function registerInit() {
        $lowercaseName = strtolower($this->_singularName);

        $labels = [
            'name'               => __($this->_pluralName),
            'singular_name'      => __($this->_singularName),
            'menu_name'         => __($this->_menuName),
            'add_new_item'       => __("Add New {$this->_singularName}"),
            'edit_item'          => __("Edit {$this->_singularName}"),
            'update_item'       => __("Update {$this->_singularName}"),
            'all_items'          => __("All {$this->_pluralName}"),
            'search_items'       => __("Search {$this->_pluralName}"),
            'parent_item'  => __("Parent {$this->_pluralName}"),
            'parent_item_colon'  => __("Parent: {$this->_pluralName}"),
            'not_found'          => __("No {$lowercaseName} found."),
            'not_found_in_trash' => __("No {$lowercaseName} found in Trash.")
        ];

        $arguments = [
            'hierarchical'      => $this->_hierarchical,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => $this->_name],
        ];

        register_taxonomy($this->_name, $this->_cpt, $arguments);
    }

    public static function findAllTerms(string $name) {
        return get_terms(['taxonomy' => $name, 'hide_empty' => false]);
    }

    public function setSingular(string $singularName) {
        $this->_singularName = ucfirst($singularName);
        return $this;
    }

    public function setPlural(string $pluralName) {
        $this->_pluralName = ucfirst($pluralName);

        if(!$this->_menuName) {
            $this->_menuName = $pluralName;
        }

        return $this;
    }

    public function setHierarchical(bool $hierarchical) {
        $this->_hierarchical = $hierarchical;
        return $this;
    }

    public function setCPT($cpt) {
        $this->_cpt = $cpt;
        return $this;
    }
}