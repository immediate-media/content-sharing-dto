<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class SEO
{
    public ?string $metaTitle;
    public ?string $metaDescription;
    public ?OpenGraph $openGraph;

    public function __construct(?string $metaTitle, ?string $metaDescription, ?OpenGraph $openGraph)
    {
        $this->metaTitle = $metaTitle;
        $this->metaDescription = $metaDescription;
        $this->openGraph = $openGraph;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function getMetaDescription(): ?string
    {   
        return $this->metaDescription;
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

    public function getOpenGraph(): ?OpenGraph
    {
        return $this->openGraph;
    }

    public function setOpenGraph(?OpenGraph $openGraph): void
    {
        $this->openGraph = $openGraph;
    }
}
