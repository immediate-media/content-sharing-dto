<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Image
{

    public string $url;
    public string $alt;
    public string $title;
    public int $width;
    public int $height;
    public bool $isUpscaled;
    public string $srcImage;
    public array $exif = [];
    public array $labels = [];
    public array $objects = [];
    public DRM $drm;


    public function __construct(string $url, string $alt, string $title, int $width, int $height, DRM $drm,
                                bool $isUpscaled = false, string $srcImage = '')
    {
        $this->url = $url;
        $this->alt = $alt;
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
        $this->drm = $drm;
        $this->isUpscaled = $isUpscaled;
        $this->srcImage = $srcImage;
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

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getDrm(): DRM
    {
        return $this->drm;
    }

    public function setDrm(DRM $drm): void
    {
        $this->drm = $drm;
    }

    public function isUpscaled(): bool
    {
        return $this->isUpscaled;
    }

    public function setIsUpscaled(bool $isUpscaled): void
    {
        $this->isUpscaled = $isUpscaled;
    }

    public function getSrcImage(): string
    {
        return $this->srcImage;
    }

    public function setSrcImage(string $srcImage): void
    {
        $this->srcImage = $srcImage;
    }

    public function getExif(): array
    {
        return $this->exif;
    }

    public function setExif(array $exif): void
    {
        $this->exif = $exif;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function setLabels(array $labels): void
    {
        $this->labels = $labels;
    }

    public function getObjects(): array
    {
        return $this->objects;
    }

    public function setObjects(array $objects): void
    {
        $this->objects = $objects;
    }

}