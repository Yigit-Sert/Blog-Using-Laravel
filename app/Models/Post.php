<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

//    constructor
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        $files = File::files(resource_path("posts/"));
        return array_map(fn($file) => $file->getContents(), $files);
    }

    public static function find($slug)
    {
//  if the file does not exist, redirect to homepage
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

//    Use caching for expensive operations
        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
    }
}
