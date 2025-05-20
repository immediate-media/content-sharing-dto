<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Meta
{
    public ?string $metaTitle;
    public ?string $metaDescription;

    public function __construct(?string $metaTitle, ?string $metaDescription)
    {
        $this->metaTitle = $metaTitle;
        $this->metaDescription = $metaDescription;
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
}
