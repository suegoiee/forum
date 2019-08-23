<?php

namespace App\Helpers;

trait HasSlug
{
    public function slug(): string
    {
        return $this->slug;
    }

    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = $this->generateUniqueSlug($slug);
    }

    public static function findBySlug(string $slug): self
    {
        $replace = array(":", "/", "?", "#", "&", "=", "%", "{", "}");
        $replace_url = array();
        for($i = 0; $i < count($replace); $i++){
            array_push($replace_url, urlencode($replace[$i]));
        }
        $url = str_replace($replace, $replace_url, $slug);
        return static::where('slug', $url)->firstOrFail();
    }

    private function generateUniqueSlug(string $value): string
    {
        //$slug = $originalSlug = str_slug($value);--laravel slug
        $slug = $originalSlug = $this->parseurl($value);
        $counter = 0;

        while ($this->slugExists($slug, $this->exists ? $this->id() : null)) {
            $counter++;
            $slug = $originalSlug.'-'.$counter;
        }

        return $slug;
    }

    private function slugExists(string $slug, int $ignoreId = null): bool
    {
        $query = $this->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->count();
    }

    private function parseurl(string $slug)
    {
        $replace = array(":", "?", "#", "&", "=", "%", "{", "}");
        $replace_url = array();
        for($i = 0; $i < count($replace); $i++){
            array_push($replace_url, urlencode($replace[$i]));
        }
        if (strpos($slug, '/') == true) {
            $slug = str_replace('/', '-', $slug);
        }
        $url = str_replace($replace, $replace_url, $slug);
        return $url;
    }
        
}
