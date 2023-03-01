<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
        return collect(File::files(resource_path("posts")))   // find every files in posts directory and collect them into collection file
            ->map(fn($file) => YamlFrontMatter::parseFile($file))   //  map over each item parse into a document
            ->map(fn($document) => new Post(    //  map over second time and build Post object
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ));
    }

    public static function find($slug)
    {
        //  of all the blog posts, find the one with a slug that matches the one that was requested.
        return static::all()->firstWhere('slug', $slug);
    }
}
