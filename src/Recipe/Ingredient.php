<?php

namespace AdamLambourne\ContentSharingDto\Recipe;

class Ingredient
{

    public string $name;
    public string $quantity;
    public string $unit;
    public string $slug;
    public string $notes;

    public function __construct(string $name, string $quantity, string $unit, string $slug, string $notes)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->slug = $slug;
        $this->notes = $notes;
    }


}