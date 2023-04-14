<?php

namespace ImmediateMedia\ContentSharingDto\Generic;

class Author
{

    public string $name;
    public string $email;
    public string $url;
    public string $image;

    public function __construct(string $name, string $email, string $url, string $image)
    {
        $this->name = $name;
        $this->email = $email;
        $this->url = $url;
        $this->image = $image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}