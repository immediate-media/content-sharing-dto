

# RecipeDTO example

```php
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
$recipeDTO->setNutrition(new Nutrition('Salt', '5', 'g',false, false));
$recipeDTO->setNutrition(new Nutrition('Sugar', '11', 'g',false, false));


$recipeDTO->toJSON();
```

## JSON Output

```json
{
  "DTO_VERSION": "1.0.0",
  "type": "recipe",
  "clientRef": "123",
  "title": "Example Recipe",
  "siteName": "BBCGoodFood",
  "url": "https:\/\/www.example.com",
  "slug": "example-recipe-slug",
  "author": {
    "name": "Adam Lambourne",
    "email": "adam.lambourne@immediate.co.uk",
    "url": "https:\/\/www.example.com",
    "image": "https:\/\/www.example.com\/image.jpg"
  },
  "heroImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "My Image",
    "title": "My Image"
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "My Image",
    "title": "My Image"
  },
  "ingredients": [
    {
      "name": "first Ingredient",
      "quantity": "1.5",
      "unit": "kg",
      "slug": "my-ingredient",
      "notes": "My Notes"
    },
    {
      "name": "second Ingredient",
      "quantity": "2",
      "unit": "kg",
      "slug": "my-ingredient",
      "notes": "My Notes"
    }
  ],
  "methodSteps": [
    {
      "stepNumber": 1,
      "description": "first step"
    },
    {
      "stepNumber": 2,
      "description": "second step"
    },
    {
      "stepNumber": 3,
      "description": "third step"
    }
  ],
  "nutrition": [
    {
      "label": "Calories",
      "value": "100",
      "unit": "g",
      "high": false,
      "low": false
    },
    {
      "label": "Salt",
      "value": "5",
      "unit": "g",
      "high": false,
      "low": false
    },
    {
      "label": "Sugar",
      "value": "11",
      "unit": "g",
      "high": false,
      "low": false
    }
  ]
}
```

