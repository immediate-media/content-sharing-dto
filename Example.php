<?php

require 'vendor/autoload.php';


use AdamLambourne\ContentSharingDto\Recipe\RecipeDTO;
use AdamLambourne\ContentSharingDto\Generic\Author;
use AdamLambourne\ContentSharingDto\Generic\Image;
use AdamLambourne\ContentSharingDto\Recipe\Ingredient;
use AdamLambourne\ContentSharingDto\Recipe\MethodStep;
use AdamLambourne\ContentSharingDto\Recipe\Nutrition;
use AdamLambourne\ContentSharingDto\Generic\Tag;

$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(new Author('Adam Lambourne', 'adam.lambourne@immediate.co.uk', 'https://www.example.com', 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef('ABC123');
$recipeDTO->setSlug('example-recipe-slug');
$recipeDTO->setSiteName('BBCGoodFood');
$recipeDTO->setPublishedDate('2023-02-08T15:00:39+00:00');
$recipeDTO->setUpdatedDate('2023-02-08T17:00:39+00:00');
$recipeDTO->setTitle('Example Recipe');
$recipeDTO->setDescription('Example Recipe Description');
$recipeDTO->setUrl('https://www.example.com/recipe');
$recipeDTO->setHeroImage(new Image('https://www.example.com/image.jpg', 'Hero Image', 'Image title'));
$recipeDTO->setThumbnailImage(new Image('https://www.example.com/image.jpg', 'Thumb Image', 'Image title'));

$recipeDTO->setIngredients(new Ingredient('first Ingredient', '1.5', 'kg', 'my-ingredient', 'My Notes'));
$recipeDTO->setIngredients(new Ingredient('second Ingredient', '2', 'kg', 'my-ingredient', 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(1, 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(2, 'second step'));

$recipeDTO->setNutrition(new Nutrition('Calories', '100', 'g',false, false));
$recipeDTO->setNutrition(new Nutrition('Salt', '100', 'g',false, false));

$recipeDTO->setTags(new Tag('recipe tag 1', 'recipe-tag-1', 'tag notes'));
$recipeDTO->setTags(new Tag('recipe tag 2', 'recipe-tag-2', 'tag notes'));



echo $recipeDTO->toJSON();
