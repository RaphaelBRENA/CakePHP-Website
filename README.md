# CakePHP Application Skeleton

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=5.x)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.


## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.


# Recipe Management Website with CakePHP

## Project Description

This project is a web application that allows administrators to create and manage recipes. Each recipe is linked to ingredients, kitchen utensils, and preparation steps. A recipe also has an image that represents it.

We have added several features to improve the user experience, such as comments, a shopping cart, search functionality, and multi-language support. The application is designed to work even if JavaScript is disabled.


## Project authors

This project is made by Raphael Brena and Maria-Luisa Haranita.
The point of it is to train on how to use CakePHP by creating a website for recipes.
We got the inspiration from Marmiton website and we also got new ideas by reading the other subjects.

---

## Main Features

- **Add, edit, and delete recipes**
- **API REST(recipes/api) in the link**
- **Manage ingredients, kitchen utensils, and preparation steps**
- **Upload images for each recipe**
- **Tagging system** ( 100% veggie, contains meat, summer recipe)
- **Comment system**
- **Recipe rating system (0 to 5 stars)**
- **Add recipes to a shopping cart**
- **Generate a shopping list**
- **Find nearby supermarkets based on user location**
  - With JavaScript: Interactive map
  - Without JavaScript: List of supermarkets
- **Voice search for recipes**
- **Custom 404 page with an interactive game (a rat searching for cheese)**
- **Multi-language support using i18n**
- **Pagination helper for easier navigation**
- **User authentication and role management**
- **CAPTCHA system during registration to prevent bots**
- **Works without JavaScript (basic functionalities remain functional)**

---

## Development Process

### 1. **Project Setup**
- We structured the project using **CakePHP**.
- Created the necessary folders and files.
- Defined the main entities:
  - Recipes
  - Users
  - Ingredients
  - Utensils
  - Comments
  - Tags

### 2. **Basic Recipe Management**
- Developed the system for adding, editing, and deleting recipes.
- Implemented the linking of recipes to ingredients, utensils, and preparation steps.
- Created the recipe display page.

### 3. **Enhancing User Experience**
- Added the ability to upload images for each recipe.
- Implemented the tagging system for recipes.
- Added a comment system for users to give feedback on recipes.
- Implemented the recipe rating system (0 to 5 stars).

### 4. **Advanced Functionalities**
- Developed the shopping cart feature to allow users to add recipes.
- Implemented the shopping list generation system.
- Created a feature to find nearby supermarkets based on user location.
  - Displayed an interactive map when JavaScript is enabled.
  - Displayed a simple list of supermarkets when JavaScript is disabled.

### 5. **Search and Accessibility**
- Implemented voice search for recipes.
- Developed a CAPTCHA system to prevent bot registrations.

### 6. **User Roles and Authentication**
- Implemented an authentication system using **Authenticator**.
- Restricted recipe management to admin users only.

### 7. **Design and Performance**
- Used **CSS and Bootstrap** for styling.
- Ensured the project works properly even if JavaScript is disabled.

### 8. **Error Handling and Navigation**
- Created a custom **404 error page** with a small game where a rat searches for cheese.
- Implemented **pagination** to make browsing easier.

---

## Conclusion

We planned this project carefully and worked on it regularly. The **recipe table** was the core of the database, as it connected all other elements. We ensured that the application was functional, accessible, and user-friendly. The system was tested to work both with and without JavaScript, and we included features like authentication, search, and interactive maps to improve usability.
