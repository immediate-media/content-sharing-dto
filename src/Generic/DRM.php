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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
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