# Cocoaheads 2016

## Deploying to Heroku

```sh
git push heroku master && heroku run php artisan migrate:refresh --force && heroku run php artisan cocoa:events && heroku run php artisan cocoa:posts
```

## Running this locally

- homebrew
- homebrew php
- php70

```sh
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan cocoa:events
php artisan cocoa:posts
php artisan serve
```


## Writing Posts

You can write posts by creating new entries in posts.yml. These are ingested automatically on deployment.

## API

Return a JSON file with the `next` 'event'.

Return a list of 2016 events with title, sponsor, speakers, location, event bright link

Return a list of sponsors

Return a list of contact details


## Feed

https://github.com/RoumenDamianoff/laravel-feed

## iCal Feed

http://stevethomas.com.au/php/how-to-build-an-ical-calendar-with-php-and-mysql.html

https://github.com/ahmad/ics.generator

Headers (From Existing):

```
Content-Type: text/calendar; charset=UTF-8
Cache-Control: no-cache, no-store, max-age=0, must-revalidate
```

Existing Calendar:

https://calendar.google.com/calendar/ical/rrb183sckdpi5pi4hrk5u36dbc%40group.calendar.google.com/public/basic.ics

```sh
curl -i https://calendar.google.com/calendar/ical/rrb183sckdpi5pi4hrk5u36dbc%40group.calendar.google.com/public/basic.ics
```

## Open Graph

https://github.com/artesaos/seotools

Twitter cards: https://dev.twitter.com/cards/getting-started

Open graph: http://ogp.me


## Graphics

Favicon.ico

## Sitemap

- https://github.com/RoumenDamianoff/laravel-sitemap
- https://github.com/RoumenDamianoff/laravel-sitemap/wiki/Dynamic-sitemap


## JS

 - Imported OwnCarousel.js https://github.com/smashingboxes/OwlCarousel2