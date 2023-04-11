<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

class Timing
{

    public int $cookingMax;
    public int $maxCookingTime;
    public int $cookingMin;
    public int $minCookingTime;
    public int $preparationMax;
    public int $maxPreparationTime;
    public int $preparationMin;
    public int $minPreparationTime;
    public string $note;
    public int $total;
    public int $totalTime;

    public function __construct(int $cookingMax, int $maxCookingTime, int $cookingMin, int $minCookingTime, int $preparationMax, int $maxPreparationTime, int $preparationMin, int $minPreparationTime, string $note, int $total, int $totalTime)
    {
        $this->cookingMax = $cookingMax;
        $this->maxCookingTime = $maxCookingTime;
        $this->cookingMin = $cookingMin;
        $this->minCookingTime = $minCookingTime;
        $this->preparationMax = $preparationMax;
        $this->maxPreparationTime = $maxPreparationTime;
        $this->preparationMin = $preparationMin;
        $this->minPreparationTime = $minPreparationTime;
        $this->note = $note;
        $this->total = $total;
        $this->totalTime = $totalTime;
    }
}