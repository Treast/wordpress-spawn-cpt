<?php

namespace Spawn\App;

class Post {
    public int $id;
    public string $title;
    public string $permalink;
    public string $content;
    public string $thumbnail;

    public function __construct(int $id) {
        $this->id = $id;

        $this->title = get_the_title($this->id);
        $this->permalink = get_the_permalink($this->id);
        $this->content = get_the_content($this->id);
        $this->thumbnail = get_the_post_thumbnail($this->id);
    }
}