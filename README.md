# Content Sharing DTO
DTO is a simple object that represents a complex object in a way that can be easily passed around between different applications. 

These DTOs have been designed specifically for use with the Content Sharing API.

## RecipeDTO example

```php
$recipeDTO = new RecipeDTO();

$recipeDTO->setAuthor(author: new Author(name: 'Adam Lambourne', email: 'adam.lambourne@immediate.co.uk', url: 'https://www.example.com', image: 'https://www.example.com/image.jpg'));
$recipeDTO->setClientRef(clientRef: 'ABC123');
$recipeDTO->setDrm(drm: new DRM(status: 3, notes: 'Can be used Worldwide'));
$recipeDTO->setSlug(slug: 'example-recipe-slug');
$recipeDTO->setSiteName(siteName: 'BBCGoodFood');
$recipeDTO->setPublishedDate(publishedDate: '2023-02-08T15:00:39+00:00');
$recipeDTO->setUpdatedDate(updatedDate: '2023-02-08T17:00:39+00:00');
$recipeDTO->setTitle(title: 'Example Recipe');
$recipeDTO->setDescription(description: 'Example Recipe Description');
$recipeDTO->setUrl(url: 'https://www.example.com/recipe');
$recipeDTO->setHeroImage(heroImage: new Image(url: 'https://www.example.com/image.jpg', alt: 'Hero Image', title: 'Image title'));
$recipeDTO->setThumbnailImage(thumbnailImage: new Image(url: 'https://www.example.com/image.jpg', alt: 'Thumb Image', title: 'Image title'));

$recipeDTO->setIngredients(ingredients: new Ingredient(name: 'first Ingredient', quantity: '1.5', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));
$recipeDTO->setIngredients(ingredients: new Ingredient(name: 'second Ingredient', quantity: '2', unit: 'kg', slug: 'my-ingredient', notes: 'My Notes'));

$recipeDTO->setMethodSteps(methodSteps: new MethodStep(stepNumber: 1, description: 'first step'));
$recipeDTO->setMethodSteps(methodSteps: new MethodStep(stepNumber: 2, description: 'second step'));

$recipeDTO->setNutrition(nutrition: new Nutrition(label: 'Calories', value: '100', unit: 'g', high: false, low: false));
$recipeDTO->setNutrition(nutrition: new Nutrition(label: 'Salt', value: '100', unit: 'g', high: false, low: false));

$recipeDTO->setTags(tags: new Tag(name: 'recipe tag 1', slug: 'recipe-tag-1', notes: 'tag notes'));
$recipeDTO->setTags(tags: new Tag(name: 'recipe tag 2', slug: 'recipe-tag-2', notes: 'tag notes'));

$recipeDTO->setCategories(categories: new Category(name: 'Recipes', slug: 'recipes', notes: 'category notes'));
$recipeDTO->setCategories(categories: new Category(name: 'Food', slug: 'food', notes: 'category notes'));

$recipeDTO->setTiming(timing: new Timing(cookingMax: 20, maxCookingTime: 20, cookingMin: 10, minCookingTime: 10, preparationMax: 5, maxPreparationTime: 5, preparationMin: 3, minPreparationTime: 3, note: '', total: 45, totalTime: 45));




$recipeDTO->toJSON();
```


## Example JSON Output
<details>
  <summary>Recipe DTO JSON Output</summary>

```json
{
  "DTO_VERSION": "1.0.0",
  "type": "recipe",
  "clientRef": "ABC123",
  "title": "Example Recipe",
  "siteName": "BBCGoodFood",
  "url": "https:\/\/www.example.com\/recipe",
  "slug": "example-recipe-slug",
  "description": "Example Recipe Description",
  "publishedDate": "2023-02-08T15:00:39+00:00",
  "updatedDate": "2023-02-08T17:00:39+00:00",
  "drm": {
    "status": 3,
    "notes": "Can be used Worldwide"
  },
  "author": {
    "name": "Adam Lambourne",
    "email": "adam.lambourne@immediate.co.uk",
    "url": "https:\/\/www.example.com",
    "image": "https:\/\/www.example.com\/image.jpg"
  },
  "heroImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Hero Image",
    "title": "Image title"
  },
  "thumbnailImage": {
    "url": "https:\/\/www.example.com\/image.jpg",
    "alt": "Thumb Image",
    "title": "Image title"
  },
  "tags": [
    {
      "name": "recipe tag 1",
      "slug": "recipe-tag-1",
      "notes": "tag notes"
    },
    {
      "name": "recipe tag 2",
      "slug": "recipe-tag-2",
      "notes": "tag notes"
    }
  ],
  "categories": [
    {
      "name": "Recipes",
      "slug": "recipes",
      "notes": "category notes"
    },
    {
      "name": "Food",
      "slug": "food",
      "notes": "category notes"
    }
  ],
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
      "value": "100",
      "unit": "g",
      "high": false,
      "low": false
    }
  ],
  "timing": {
    "cookingMax": 20,
    "maxCookingTime": 20,
    "cookingMin": 10,
    "minCookingTime": 10,
    "preparationMax": 5,
    "maxPreparationTime": 5,
    "preparationMin": 3,
    "minPreparationTime": 3,
    "note": "",
    "total": 45,
    "totalTime": 45
  }
}
```
</details>

