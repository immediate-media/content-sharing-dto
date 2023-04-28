<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Category
{
    public string $name;
    public string $slug;
    public string $notes;

    public function __construct(string $name, string $slug, string $notes)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->notes = $notes;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }


}