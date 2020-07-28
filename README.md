



<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">Sonyry</h3>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Roadmap](#roadmap)
* [Acknowledgements](#acknowledgements)



<!-- ABOUT THE PROJECT -->
## About The Project

Our project aims to create a website for writing knowledge record and portfolios.

The application should eventually be able to record pages containing all types of information, such as those relating to the students' career path during their training. This will involve the generation of pages that can be filled in as desired by users, with the possibility of placing them in collections (tags) and being able to share them with groups or individuals.

All this information can be exported so that all the work and knowledge can be kept informed about it.

Finally, teachers will have access to its pages and collections for evaluation.


### Built With
This section lists the main frameworks we used to build our project.
* [Bootstrap](https://getbootstrap.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

To obtain a local copy of the project, follow these steps.

### Prerequisites

* [Node.JS](https://nodejs.org/en/)

### Installation

1. Clone the repo
```sh
git clone https://github.com/Fenightix/Sonyry.git
```
2. Access your project directory
```sh
cd Sonyry
```
3. Installing project dependencies from composer
```sh
composer install
```
5. Install NPM dependencies
```sh
npm install
```
6. Create a copy of your .env file
```sh
cp .env.example .env
```
7. Generate your encryption key
```laravel
php artisan key:generate
```
8. Create an empty database for your project
9. Configure your .env file to allow a connection to the database.
```
In the .env file, fill in the options DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME and DB_PASSWORD to match the credentials of the database you just created.
```
10. Add tables and contents of your database with migrations or in sql
```laravel
php artisan migrate
```
```laravel
php artisan db:seed
```



<!-- USAGE EXAMPLES -->
## Usage

Here will be space to show useful examples of how the project can be used. Additional screenshots, sample code and working demos may be present. We will also be able to create links to other resources.



<!-- ROADMAP -->
## Roadmap

See the [open issues](https://app.gitkraken.com/glo/board/XxV90j7jvAARX2qH) for a list of proposed features (and known issues).



<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [Font Awesome](https://fontawesome.com)



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[product-screenshot]: images/screenshot.png
