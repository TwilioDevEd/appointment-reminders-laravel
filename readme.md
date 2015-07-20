# Appointment reminders in PHP with Laravel

This application demostrates how to use the Twilio API to send automated reminders about upcoming appointments

## Deploying to Heroku

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy?template=https://github.com/TwilioDevEd/appointment-reminders-laravel)

## Running locally

### The web application

1. Clone the repository, copy the included `env.example` as `.env` and customize it to your needs. The application requires Twilio tokens/account ID to be configured before running.
2. Run the database migrations using `php artisan migrate`. If the database is configured correctly in `.env` this will get you a working database
3. Run the application using `php artisan serve`

### The background scheduler

The messages are sent using Laravel's scheduler. This requires us to execute `php artisan schedule:run` every minute. For development executing the command in an infinite loop should work just fine:
```
while true; do php artisan schedule:run; sleep 60; done
```
