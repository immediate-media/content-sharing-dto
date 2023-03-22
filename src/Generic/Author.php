<?php

namespace AdamLambourne\ContentSharingDto\Generic;

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
}