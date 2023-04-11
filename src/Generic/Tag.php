<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Tag
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
}