# Simple Web Gallery App
Simple web gallery app created with Laravel, Bootstrap and MySQL/PostgreSQL

## General info
### Home Page 

Here you can view images. Click on the image to expand. You can also sort images by tags and categories.

![](https://i.ibb.co/QrZbntg/Screenshot-7.png)

### Dashboard

On this page, the admin can add, edit and delete images.

![](https://i.ibb.co/rvVrKZS/Screenshot-8.png)

### Create Image Form

To create an image, the admin must fill in the details and upload the image.
To add tags, you need to enter a name and press enter.
The image metadata is stored in the database, and the image file itself is stored on the local file system.

![](https://i.ibb.co/8cNzvkT/Screenshot-2.png)

## Technologies
Project is created with:
* Laravel
* Bootstrap
* MySQL/PostgreSQL
* NodeJS

## How To Use

```bash
# Clone this repository
$ git clone https://github.com/Souii/webgallery.git

# Go into the repository
$ cd webgallery

# Install php dependencies
$ composer install

# Generate the application key
$ php artisan key:generate

# Run migrations
$ php artisan migrate

# To compile assets
$ npm install && npm run dev
```
