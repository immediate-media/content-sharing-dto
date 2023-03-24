<?php

require 'vendor/autoload.php';


use AdamLambourne\ContentSharingDto\Recipe\RecipeDTO;
use AdamLambourne\ContentSharingDto\Generic\Author;
use AdamLambourne\ContentSharingDto\Generic\Image;
use AdamLambourne\ContentSharingDto\Recipe\Ingredient;
use AdamLambourne\ContentSharingDto\Recipe\MethodStep;
use AdamLambourne\ContentSharingDto\Recipe\Nutrition;
use AdamLambourne\ContentSharingDto\Generic\Tag;
use AdamLambourne\ContentSharingDto\Generic\Category;
use AdamLambourne\ContentSharingDto\Generic\DRM;
use AdamLambourne\ContentSharingDto\Recipe\Timing;

$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(new Author(name: 'Adam Lambourne', email: 'adam.lambourne@immediate.co.uk', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef('ABC123');
$recipeDTO->setDrm(new DRM(status: 3, notes: 'Can be used Worldwide'));
$recipeDTO->setSlug('example-recipe-slug');
$recipeDTO->setSiteName('BBCGoodFood');
$recipeDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
$recipeDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
$recipeDTO->setTitle('Example Recipe');
$recipeDTO->setDescription('Example Recipe Description');
$recipeDTO->setUrl('https://www.example.com/recipe');
$recipeDTO->setHeroImage(new Image(url: 'https://www.example.com/image.jpg', alt: 'Hero Image', title: 'Image title'));
$recipeDTO->setThumbnailImage(new Image(url: 'https://www.example.com/image.jpg', alt: 'Thumb Image', title: 'Image title'));

$recipeDTO->setIngredients(new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));
$recipeDTO->setIngredients(new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 1, description: 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(stepNumber: 2, description: 'second step'));

$recipeDTO->setNutrition(new Nutrition(label: 'Calories', value: '100', unit: 'g', high: false, low: false));
$recipeDTO->setNutrition(new Nutrition(label: 'Salt', value: '100', unit: 'g', high: false, low: false));

$recipeDTO->setTags(new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
$recipeDTO->setTags(new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));

$recipeDTO->setCategories(new Category(name: 'Recipes', slug: 'recipes', notes: 'category notes'));
$recipeDTO->setCategories(new Category(name: 'Food', slug: 'food', notes: 'category notes'));

$recipeDTO->setTiming(new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));

echo $recipeDTO->toJSON();
