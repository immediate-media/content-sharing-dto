<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class OpenGraph
{
    public ?string $title;
    public ?string $description;
    public ?Image $image;

    public function __construct(?string $title, ?string $description, ?Image $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    
    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }
}
