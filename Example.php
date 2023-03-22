<?php

require 'vendor/autoload.php';


use AdamLambourne\ContentSharingDto\Recipe\RecipeDTO;
use AdamLambourne\ContentSharingDto\Generic\Author;
use AdamLambourne\ContentSharingDto\Generic\Image;
use AdamLambourne\ContentSharingDto\Recipe\Ingredient;
use AdamLambourne\ContentSharingDto\Recipe\MethodStep;
use AdamLambourne\ContentSharingDto\Recipe\Nutrition;

$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(new Author('Adam Lambourne', 'adam.lambourne@immediate.co.uk', 'https://www.example.com', 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef('123');
$recipeDTO->setSlug('example-recipe-slug');
$recipeDTO->setSiteName('BBCGoodFood');
$recipeDTO->setTitle('Example Recipe');
$recipeDTO->setUrl('https://www.example.com');
$recipeDTO->setHeroImage(new Image('https://www.example.com/image.jpg', 'My Image', 'My Image'));
$recipeDTO->setThumbnailImage(new Image('https://www.example.com/image.jpg', 'My Image', 'My Image'));
$recipeDTO->setIngredients(new Ingredient('first Ingredient', '1.5', 'kg', 'my-ingredient', 'My Notes'));
$recipeDTO->setIngredients(new Ingredient('second Ingredient', '2', 'kg', 'my-ingredient', 'My Notes'));

$recipeDTO->setMethodSteps(new MethodStep(1, 'first step'));
$recipeDTO->setMethodSteps(new MethodStep(2, 'second step'));
$recipeDTO->setMethodSteps(new MethodStep(3, 'third step'));


$recipeDTO->setNutrition(new Nutrition('Calories', '100', 'g',false, false));
$recipeDTO->setNutrition(new Nutrition('Salt', '100', 'g',false, false));
$recipeDTO->setNutrition(new Nutrition('Sugar', '11', 'g',false, false));


$recipeDTO->toJSON();


echo $recipeDTO->toJSON();
