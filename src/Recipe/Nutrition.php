<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

class Nutrition
{

    public const GRAMS = 'g';
    public const KCALS = 'kcal';

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

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    public function getHigh(): bool
    {
        return $this->high;
    }

    public function setHigh(bool $high): void
    {
        $this->high = $high;
    }

    public function getLow(): bool
    {
        return $this->low;
    }

    public function setLow(bool $low): void
    {
        $this->low = $low;
    }








}