<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Image
{

    public string $url;
    public string $alt;
    public string $title;
    public DRM $drm;

    public function __construct(string $url, string $alt, string $title, DRM $drm)
    {
        $this->url = $url;
        $this->alt = $alt;
        $this->title = $title;
        $this->drm = $drm;
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


    public function getDrm(): DRM
    {
        return $this->drm;
    }


    public function setDrm(DRM $drm): void
    {
        $this->drm = $drm;
    }

}