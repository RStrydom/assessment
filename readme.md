# Developer Evaluation - Part 2 - TaskFighter

## Introduction

This evaluation is designed to test your coding skills. The project you will build is a simple task manager with a web interface.

## Setup

This repository includes the initial setup for the evaluation. The project is [Laravel](https://laravel.com/) based and is built using a fresh installation. Please refer to the Laravel documentation for help to setup the environment and get it running.

Setup the environment by:

1. Installing the composer and npm dependancies
2. Connect it to a database.
3. Run the database migrations and seeds.

## Tasks

Please complete the tasks below. It would be helpful for you to commit your work after each step. When finished create a pull request. Once the pull request is made (or for help), please email your contact person at Sendmarc.

1. Change the code in `routes/web.php` to use Controllers, Requests, and Models. Think RESTful/Resourceful API architecture.
2. Produce a basic interface to list the tasks with the name, priority, and number of days until due.
3. Implement unit tests for `app/TaskFighter.php`.
4. Refactor the monstrous code in the `app/TaskFighter.php` class.
5. Add a button on the interface to cause TaskFighter to 'tick'.

Bonus points are awarded for the following, optional, tasks:

1. Using VueJS to build the listing as a single page app.
3. Any additional usability features.
2. Ensuring robustness of the application for use in the wild.

## Rules

Hi and welcome to team TaskFighter. As you know, we build a small application to help people manage their tasks. 

Unfortunately, our users' lists of tasks are constantly growing and changing. Tasks increase in priority as they approach their due date. We have a system in place that updates the task lists for us. It was developed by a no-nonsense type named Leeroy, who has moved on to new adventures.

First an introduction to our system:

- All items have a dueIn value which denotes the number of days in which they have to be completed
- All items have a priority value which denotes how important the item is
- At the end of each day our system lowers the dueIn value and increases the priority value for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the due date has passed, priority increases twice as fast
- The priority of an item is never negative
- "Get Older" actually decreases in priority the older it gets
- The priority of an item is never more than 100
- "Spin the World", being something that just happens, never has to be completed or increase in priority
- "Complete Assessment", like "Get Older, increases in priority as it's dueIn value approaches; Priority increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but priority drops to 0 after the due date.

Just for clarification, an item can never have its priority increase above 100 or below 0, however "Spin the World" is an automatic task and as such its priority is 1000 and it never alters.
