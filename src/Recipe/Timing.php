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


    public function getCookingMax(): int
    {
        return $this->cookingMax;
    }

    public function setCookingMax(int $cookingMax): void
    {
        $this->cookingMax = $cookingMax;
    }

    public function getMaxCookingTime(): int
    {
        return $this->maxCookingTime;
    }

    public function setMaxCookingTime(int $maxCookingTime): void
    {
        $this->maxCookingTime = $maxCookingTime;
    }

    public function getCookingMin(): int
    {
        return $this->cookingMin;
    }

    public function setCookingMin(int $cookingMin): void
    {
        $this->cookingMin = $cookingMin;
    }

    public function getMinCookingTime(): int
    {
        return $this->minCookingTime;
    }

    public function setMinCookingTime(int $minCookingTime): void
    {
        $this->minCookingTime = $minCookingTime;
    }

    public function getPreparationMax(): int
    {
        return $this->preparationMax;
    }

    public function setPreparationMax(int $preparationMax): void
    {
        $this->preparationMax = $preparationMax;
    }

    public function getMaxPreparationTime(): int
    {
        return $this->maxPreparationTime;
    }

    public function setMaxPreparationTime(int $maxPreparationTime): void
    {
        $this->maxPreparationTime = $maxPreparationTime;
    }

    public function getPreparationMin(): int
    {
        return $this->preparationMin;
    }

    public function setPreparationMin(int $preparationMin): void
    {
        $this->preparationMin = $preparationMin;
    }

    public function getMinPreparationTime(): int
    {
        return $this->minPreparationTime;
    }

    public function setMinPreparationTime(int $minPreparationTime): void
    {
        $this->minPreparationTime = $minPreparationTime;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getTotalTime(): int
    {
        return $this->totalTime;
    }

    public function setTotalTime(int $totalTime): void
    {
        $this->totalTime = $totalTime;
    }


}