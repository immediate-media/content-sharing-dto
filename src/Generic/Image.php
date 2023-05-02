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


    public function getUrl(): string
    {
        return $this->url;
    }


    public function setUrl(string $url): void
    {
        $this->url = $url;
    }


    public function getAlt(): string
    {
        return $this->alt;
    }


    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

}