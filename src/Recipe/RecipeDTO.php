<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

use ImmediateMedia\ContentSharingDto\BaseDTO;
use ImmediateMedia\ContentSharingDto\Recipe\Timing;

/**
 * Class RecipeDTO
 * @package ImmediateMedia\ContentSharingDto\Recipe
 */
class RecipeDTO extends BaseDTO
{

    // Bump this version when you make a breaking change to the DTO
    public string $RECIPE_DTO_VERSION = '1.0.0';

    public string $type = 'recipe';
    public array $ingredients;
    public array $methodSteps;
    public array $nutrition;
    public Timing $timing;
    public string $skillLevel;
    public int $servings;

    protected array $validators = ['ingredients', 'methodSteps', 'nutrition', 'timing', 'skillLevel', 'servings'];


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


    public function getTiming(): Timing
    {
        return $this->timing;
    }


    public function setTiming(Timing $timing): void
    {
        $this->timing = $timing;
    }


    public function getSkillLevel(): string
    {
        return $this->skillLevel;
    }


    public function setSkillLevel(string $skillLevel): void
    {
        $this->skillLevel = $skillLevel;
    }


    public function getServings(): int
    {
        return $this->servings;
    }

    public function setServings(int $servings): void
    {
        $this->servings = $servings;
    }





}