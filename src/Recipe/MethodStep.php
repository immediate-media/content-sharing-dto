<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

use ImmediateMedia\ContentSharingDto\Generic\Image;

class MethodStep
{

    public int $stepNumber;
    public string $description;
    public Image $image;


    public function __construct(int $stepNumber, string $description)
    {
        $this->stepNumber = $stepNumber;
        $this->description = $description;
    }


    public function getStepNumber(): int
    {
        return $this->stepNumber;
    }


    public function setStepNumber(int $stepNumber): void
    {
        $this->stepNumber = $stepNumber;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function getImage(): Image
    {
        return $this->image;
    }


    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

}