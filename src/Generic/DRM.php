<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class DRM
{


    public const GREEN = 1;
    public const YELLOW = 2;
    public const RED = 3;

    public int $status;
    public string $notes;

    public function __construct(int $status, string $notes)
    {
        $this->status = $status;
        $this->notes = $notes;
    }

}