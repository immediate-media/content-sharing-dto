<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

class Nutrition
{
  public string $label;
  public string $value;
  public string $unit;
  public bool $high;
  public bool $low;

    public function __construct(string $label, string $value, string $unit, bool $high, bool $low)
    {
        $this->label = $label;
        $this->value = $value;
        $this->unit = $unit;
        $this->high = $high;
        $this->low = $low;
    }

}