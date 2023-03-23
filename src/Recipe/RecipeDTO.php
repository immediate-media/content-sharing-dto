<?php

namespace AdamLambourne\ContentSharingDto\Recipe;

use AdamLambourne\ContentSharingDto\BaseDTO;

class RecipeDTO extends BaseDTO
{

    public string $type = 'recipe';

    public array $ingredients;
    public array $methodSteps;
    public array $nutrition;


    public function getNutrition(): array
    {
        return $this->nutrition;
    }


    public function setNutrition(Nutrition $nutrition): void
    {
        $this->nutrition[] = $nutrition;
    }


    public function getIngredients(): array
    {
        return $this->ingredients;
    }


    public function setIngredients(Ingredient $ingredients): void
    {
        $this->ingredients[] = $ingredients;
    }


    public function getMethodSteps(): array
    {
        return $this->methodSteps;
    }


    public function setMethodSteps(MethodStep $methodSteps): void
    {
        $this->methodSteps[] = $methodSteps;
    }


}