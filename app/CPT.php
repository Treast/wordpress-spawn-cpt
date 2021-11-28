<?php

namespace Spawn\App;

class CPT {
    private string $_name;
    private ?string $_singularName;
    private ?string $_pluralName;
    private int $_menuPosition;
    private bool $_isPublic;
    private bool $_hasArchive;
    private ?string $_icon;
    private array $_supports;
    private ?string $_menuName;
    private bool $_showInRest;

    public function __construct(string $name) {
        $this->_name = $name;
        $this->_menuPosition = 5;
        $this->_isPublic = true;
        $this->_hasArchive = true;
        $this->_showInRest = true;
        $this->_supports = ['title', 'editor', 'thumbnail'];
        
        $this->_menuName = null;
        $this->_singularName = null;
        $this->_pluralName = null;
        $this->_icon = null;

        return $this;
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
            'menu_name'          => __($this->_menuName),
            'name_admin_bar'     => __($this->_singularName),
            'add_new'            => __("Add New {$this->_singularName}"),
            'add_new_item'       => __("Add New {$this->_singularName}"),
            'new_item'           => __("New {$this->_singularName}"),
            'edit_item'          => __("Edit {$this->_singularName}"),
            'view_item'          => __("View {$this->_singularName}"),
            'all_items'          => __("All {$this->_pluralName}"),
            'search_items'       => __("Search {$this->_pluralName}"),
            'parent_item_colon'  => __("Parent: {$this->_pluralName}"),
            'not_found'          => __("No {$lowercaseName} found."),
            'not_found_in_trash' => __("No {$lowercaseName} found in Trash.")
        ];

        $arguments = [
            'labels' => $labels,
            'public' => $this->_isPublic,
            'show_in_rest' => $this->_showInRest,
            'has_archive' => $this->_hasArchive,
            'supports' => $this->_supports,
            'menu_position' => $this->_menuPosition,
            'menu_icon' => $this->_icon,
            'rewrite' => ['slug' => $this->_name]
        ];

        register_post_type($this->_name, $arguments);
    }

    private static function findAllByOptions(string $name, array $customArguments = []) {
        $defaultArguments = [  
            'post_type' => $name,
            'post_status' => 'publish',
            'posts_per_page' => -1, 
            'orderby' => 'date', 
            'order' => 'DESC', 
        ];

        $arguments = array_merge($defaultArguments, $customArguments);

        return get_posts($arguments);
    }

    public static function findAllRaw(string $name, array $customArguments = []) {
        $posts = CPT::findAllByOptions($name, $customArguments);
        
        // Turn posts into objects
        return json_decode(json_encode($posts), FALSE);
    }

    public static function findAll(string $name, array $customArguments = []) {
        $posts = CPT::findAllByOptions($name, $customArguments);
        
        return array_map(function($post) {
            return new Post($post->ID);
        }, $posts);
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

    public function setMenuPosition(int $menuPosition) {
        $this->_menuPosition = $menuPosition;
        return $this;
    }

    public function setIsPublic(bool $isPublic) {
        $this->_isPublic = $isPublic;
        return $this;
    }

    public function setHasArchive(bool $hasArchive) {
        $this->_hasArchive = $hasArchive;
        return $this;
    }

    public function setShowInRest(bool $show_showInRest) {
        $this->_showInRest = $show_showInRest;
        return $this;
    }

    public function setIcon(string $icon) {
        $this->_icon = $icon;
        return $this;
    }

    public function setSupports(array $supports) {
        $this->_supports = $supports;
        return $this;
    }
}