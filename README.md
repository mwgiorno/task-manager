# Task Manager
A web app for managing task lists.

## General info
### Authentication

![image](https://github.com/mwgiorno/task-manager/assets/43139928/bb5255ec-79b9-405e-88ca-524f95bd4ea0)

![image](https://github.com/mwgiorno/task-manager/assets/43139928/e709e785-04f4-437c-ac74-8cc80c304e16)

### Todo lists
A page where you can create a task list and view all your lists.

![image](https://github.com/mwgiorno/task-manager/assets/43139928/913feaa5-49bb-421b-bfec-6ba72606ec1b)

### Tasks
A page where you can create, search, filter, and update your tasks.

![image](https://github.com/mwgiorno/task-manager/assets/43139928/19c454a8-7eb6-4354-b38e-1f2e22fa8649)

![image](https://github.com/mwgiorno/task-manager/assets/43139928/611b7db3-63a8-4e24-91be-b16b1661a234)

![image](https://github.com/mwgiorno/task-manager/assets/43139928/06c48721-2547-43e9-a47c-8b33ddbed760)

![image](https://github.com/mwgiorno/task-manager/assets/43139928/2f302f2e-dd1d-4eb9-b49d-d1e84d8e2993)

## Technologies
Created with:
* Laravel
* Bootstrap 5
* AlpineJS
* Axios
* MySQL/PostgreSQL
* NodeJS

## How To Run Locally

```bash
# Clone this repository
$ git clone https://github.com/mwgiorno/task-manager.git

# Go into the repository
$ cd task-manager

# Create and configure .env file
# Build the service
$ docker compose build app

# Create and start the containers
$ docker compose up -d

# Start an interactive shell in the app container
$ docker compose exec app bash

# Install the php dependencies
$ composer install

# Generate the application key
$ php artisan key:generate

# Run migrations
$ php artisan migrate

# Create a symbolic link 
$ php artisan storage:link

# To compile assets you need to start an intercative shell in the node container and then run the commands
$ docker compose exec node sh
$ npm install && npm run dev
```
