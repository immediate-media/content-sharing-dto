<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class DRM
{

    public int $status;
    public string $notes;

    public function __construct(int $status, string $notes)
    {
        $this->status = $status;
        $this->notes = $notes;
    }

}