<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Image
{

    public string $url;
    public string $alt;
    public string $title;

    public function __construct(string $url, string $alt, string $title)
    {
        $this->url = $url;
        $this->alt = $alt;
        $this->title = $title;
    }

}