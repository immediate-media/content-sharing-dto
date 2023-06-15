<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Video
{

    public string $title;
    public string $description;
    public string $url;
    public string $videoId;
    public string $embedCode;
    public string $channelId;
    public string $channelName;
    public string $channelUrl;
    public string $thumbnailUrl;
    public bool $isEmbeddable;
    public bool $isHero;
    public DRM $drm;


    public function __construct(string $title = '', string $description = '', string $url = '', string $videoId = '',
                                string $embedCode = '', string $channelId = '', string $channelName = '',
                                string $channelUrl = '', string $thumbnailUrl = '', bool $isEmbeddable = true,
                                bool $isHero = false, DRM $drm)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->videoId = $videoId;
        $this->embedCode = $embedCode;
        $this->channelId = $channelId;
        $this->channelName = $channelName;
        $this->channelUrl = $channelUrl;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->isEmbeddable = $isEmbeddable;
        $this->isHero = $isHero;
        $this->drm = $drm;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getVideoId(): string
    {
        return $this->videoId;
    }

    public function setVideoId(string $videoId): void
    {
        $this->videoId = $videoId;
    }

    public function getEmbedCode(): string
    {
        return $this->embedCode;
    }

    public function setEmbedCode(string $embedCode): void
    {
        $this->embedCode = $embedCode;
    }

    public function getChannelId(): string
    {
        return $this->channelId;
    }


    public function setChannelId(string $channelId): void
    {
        $this->channelId = $channelId;
    }

    public function getChannelName(): string
    {
        return $this->channelName;
    }

    public function setChannelName(string $channelName): void
    {
        $this->channelName = $channelName;
    }

    public function getChannelUrl(): string
    {
        return $this->channelUrl;
    }

    public function setChannelUrl(string $channelUrl): void
    {
        $this->channelUrl = $channelUrl;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function isEmbeddable(): bool
    {
        return $this->isEmbeddable;
    }

    public function setIsEmbeddable(bool $isEmbeddable): void
    {
        $this->isEmbeddable = $isEmbeddable;
    }

    public function isHero(): bool
    {
        return $this->isHero;
    }

    public function setIsHero(bool $isHero): void
    {
        $this->isHero = $isHero;
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