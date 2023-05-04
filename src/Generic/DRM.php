<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class DRM
{

    public const GREEN = 1;
    public const YELLOW = 2;
    public const RED = 3;

    public int $status;
    public string $notes;
    public string $creator;
    public string $agency;

    public function __construct(int $status, string $notes, string $creator = 'unknown', string $agency = 'unknown')
    {
        $this->status = $status;
        $this->notes = $notes;
        $this->creator = $creator;
        $this->agency = $agency;
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

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): void
    {
        $this->creator = $creator;
    }

    public function getAgency(): string
    {
        return $this->agency;
    }

    public function setAgency(string $agency): void
    {
        $this->agency = $agency;
    }



}