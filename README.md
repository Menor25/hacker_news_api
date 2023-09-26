# SPOOL DATA FROM HACKER NEWS API

## Table of Contents

- [Installation-Setup](#installation-setup)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Project Strategies](#project-strategies)
- [Postman-Collection](#postman-collection)
- [Hacker News API URLs](#hacker-news-api-urls)

## Installation Setup

### Prerequisites

Before getting started, make sure you have the following prerequisites installed on your development environment

1. **PHP**: Laravel requires PHP 7.4 or higher. If you already have it installed you can check you current version by running `php -v` or `php -version` on your terminal.
2. **Composer**: Composer is a PHP package manager used for Laravel's dependency management. You can download composer from [Compoers](getcomposer.org)
3. **Web Server**: You can use any server of your choice for local development, such as Apache [Apache](https://www.apachefriends.org/) or Laravel built-in development server
4. **Database**: Laravel supports multiple database systems, including MySQL, SQLite, PostgreSQL and SQL Server. Ensure you have one of these databases installed and configured.
5. **Git**: Git is a version control system. It will be used for managing the project's source code.

### Installation

#### 1. Clone the Repository

- Clone the Laravery project repository for this project by copying the link below:

    `https://github.com/Menor25/hacker_news_api.git`

- Go to you terminal, navigate to the server directory (such as apache).
- Change directory to the htdocs directory
- Clone the repository link you copied above using the command below:

        `git clone https://github.com/Menor25/hacker_news_api.git`

#### 2. Navigate to your cloned Project Directory

Change your current working directory to the cloned working directory using the command below:

    `cd hacker_news_api`

#### 3. Install Project Dependencies

- Open your terminal or command line and navigate to the cloned project directory
- Run the following command to install all the dependencies using composer:

        `composer install`

#### 4. Copy the Environment File

- Make a copy of the provided `.env.example` file and name it `.env` using the command below:

        `cp .env.example .env`

#### 5. Configure the environment variables

- Go to the root directory of your laravel cloned project, you will find a file name `.env`
- Open the `.env` file in a text editor and configure your databse connnection details as follows:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
NB: The datase should be created already in your local database

- Configure the one for the queue aslo
    QUEUE_CONNECTION=database
    QUEUE_DRIVER=database

#### 6: Generate an application key

- Open your terminal and navigation to the project root directory
- Run the following command to generate the application key:

        `php artisan key:generate`

#### 7: Migrate Database

- Open your terminal and navigate to the root directory

- Run the following command to create all database tables:

        `php artisan migrate`

#### 8: Start Development Server

- Open your terminal and navigate to the project root directory

- Run the following command to start the server:

        `php artisan serve`

This will start a development server at `http://127.0.0.1:8000`

- Open a browser and access the url provided [localhost](http://127.0.0.1:8000/api)

Your laravel api is now fully setup, running on your local machine.

## API Endpoints

### New Stories Endpoints

#### Spooling stories

    `http://127.0.0.1:8000/api/spool-stories`

#### Getting all stories from the database

    `http://127.0.0.1:8000/api/stories`

#### Getting a single story from the database

    `http://127.0.0.1:8000/api/story/${id}`

### Ask Stories Endpoints

#### Spooling ask stories

    `http://127.0.0.1:8000/api/spool-asks-stories`

#### Getting all ask stories from the database

    `http://127.0.0.1:8000/api/asks`

#### Getting a single ask story from the database

    `http://127.0.0.1:8000/api/asks/${id}`

### Job Stories Endpoints

#### Spooling jobs stories

    `http://127.0.0.1:8000/api/spool-jobs-stories`

#### Getting all jobs stories from the database

    `http://127.0.0.1:8000/api/jobs`

#### Getting a single jobs story from the database

    `http://127.0.0.1:8000/api/jobs/${id}`

## Project Strategies

    - Setup a Laravel project
    - Configure the database
    - Create models and migrations
    - Create Jobs
    - Implement Services
    - Implement Laravel Queue system
    - Use Dependency Injection and Containers
    - Spool data from Hacker News API
    - Validate data before storing them in the database
    - Schedule data spooling
    - Testing endpoints

## Postman-Collection

    `https://www.postman.com/grey-star-158150/workspace/hacker-news-api/collection/21425984-9f6e5f64-34c4-4b6e-bd20-333264976ed9?action=share&creator=21425984`

## Hacker News API URLs

### New Stories IDs

    `https://hacker-news.firebaseio.com/v0/newstories.json?print=pretty`

### New Stories

    `https://hacker-news.firebaseio.com/v0/item/{$story_id}.json?print=pretty`

### Ask StoriesIDs

    `https://hacker-news.firebaseio.com/v0/askstories.json?print=pretty`

### Ask Stories

    `https://hacker-news.firebaseio.com/v0/item/{$ask_story_id}.json?print=pretty`

### Job Stories IDs

    `https://hacker-news.firebaseio.com/v0/jobstories.json?print=pretty`

### Job Stories

    `https://hacker-news.firebaseio.com/v0/item/{$job_story_id}.json?print=pretty`

With this guide, you have successfully installed Laravel api service for spooling data from hacker news api and store in the database; initialized your project, install the necessary dependencies and connections. The postman collection to easily test the APIs is also included, API endpoints and Hacker news API URLs.
