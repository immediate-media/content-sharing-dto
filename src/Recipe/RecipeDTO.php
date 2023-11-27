<?php

namespace ImmediateMedia\ContentSharingDto\Recipe;

use ImmediateMedia\ContentSharingDto\BaseDTO;
use ImmediateMedia\ContentSharingDto\Generic\Category;
use ImmediateMedia\ContentSharingDto\Generic\Tag;
use ImmediateMedia\ContentSharingDto\Recipe\Timing;
use ImmediateMedia\ContentSharingDto\Recipe\Nutrition;
use ImmediateMedia\ContentSharingDto\Recipe\Cuisine;
use ImmediateMedia\ContentSharingDto\Recipe\Diet;



/**
 * Class RecipeDTO
 * @package ImmediateMedia\ContentSharingDto\Recipe
 */
class RecipeDTO extends BaseDTO
{

    // Bump this version when you make a breaking change to the DTO
    public string $RECIPE_DTO_VERSION = '1.0.6';

    public string $type = 'recipe';
    public array $ingredients;
    public array $methodSteps;
    public array $nutrition;
    public Timing $timing;
    public string $skillLevel;
    public int $servings;

    // Optional Fields
    public array $cuisines = [];
    public array $diets = [];
    public array $ingredientsGroups = [];

    protected array $validators = ['ingredients', 'methodSteps', 'timing', 'skillLevel', 'servings'];


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


    public function getCuisines(): array
    {
        return $this->cuisines;
    }


    public function setCuisine(Cuisine $cuisine): void
    {
        $this->cuisines[] = $cuisine;
    }


    public function getDiets(): array
    {
        return $this->diets;
    }

    public function setDiet(Diet $diets): void
    {
        $this->diets[] = $diets;
    }

    public function getIngredientsGroups(): array
    {
        return $this->ingredientsGroups;
    }

    public function setIngredientsGroups(array $ingredientsGroups): void
    {
        $this->ingredientsGroups = $ingredientsGroups;
    }


    /**
     * Map JSON Object to RecipeDTO
     * @param string $jsonData RecipeJson
     * @throws \JsonException
     */
    public function map(string $jsonData) : void
    {
        parent::map($jsonData);
        $data = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        $this->setSkillLevel($data->skillLevel);

        $this->setServings($data->servings);

        foreach($data->ingredients as $ingredient) {
            $this->setIngredients(new Ingredient(name: $ingredient->name, quantity: $ingredient->quantity,
                unit: $ingredient->unit, slug: $ingredient->slug, notes: $ingredient->notes, group: $ingredient->group ?? ''));
        }

        foreach($data->methodSteps as $methodStep) {
            $this->setMethodSteps(new MethodStep(stepNumber: $methodStep->stepNumber, description: $methodStep->description));
        }

        if(isset($data->nutrition)) {
            foreach($data->nutrition as $nutrition) {
                $this->setNutrition(new Nutrition(label: $nutrition->label, value: $nutrition->value, unit: $nutrition->unit, high: $nutrition->high, low: $nutrition->low));
            }
        }

        if(isset($data->cuisines)) {
            foreach ($data->cuisines as $cuisine){
                $this->setCuisine(new Cuisine(name: $cuisine->name, slug: $cuisine->slug));
            }
        }

        if(isset($data->diets)) {
            foreach ($data->diets as $diet){
                $this->setDiet(new Diet(name: $diet->name, slug: $diet->slug));
            }
        }

        if(isset($data->ingredientsGroups)) {
            $this->setIngredientsGroups($data->ingredientsGroups);
        }

        $this->setTiming(new Timing(
            cookingMax: $data->timing->cookingMax,
            maxCookingTime: $data->timing->maxCookingTime,
            cookingMin: $data->timing->cookingMin,
            minCookingTime: $data->timing->minCookingTime,
            preparationMax: $data->timing->preparationMax,
            maxPreparationTime: $data->timing->maxPreparationTime,
            preparationMin: $data->timing->preparationMin,
            minPreparationTime: $data->timing->minPreparationTime,
            note: $data->timing->note,
            total: $data->timing->total,
            totalTime: $data->timing->totalTime));

    }




}