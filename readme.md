# Appointment reminders in PHP with Laravel

[![Build Status](https://travis-ci.org/TwilioDevEd/appointment-reminders-laravel.svg?branch=master)](https://travis-ci.org/TwilioDevEd/appointment-reminders-laravel)

This application demostrates how to use the Twilio API to send automated reminders about upcoming appointments.

[Read the full tutorial here](https://www.twilio.com/docs/tutorials/walkthrough/appointment-reminders/php/laravel)!

## Running locally

### The Web Application

1. Clone the repository and `cd` into it.
1. Install the application dependencies with [Composer](https://getcomposer.org/)

   ```bash
   $ composer install
   ```
1. The application uses PostgreSQL as persistence layer. If you
  don't have it already, you should install it. The easiest way is by
  using [Postgres.app](http://postgresapp.com/).

1. Create a database.

  ```bash
  $ createdb appointments
  ```
1. Copy the sample configuration file and edit it to match your configuration.

   ```bash
   $ cp .env.example .env
   ```

  You can find your `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` under
  your
  [Twilio Account Settings](https://www.twilio.com/user/account/settings).

  You can buy Twilio phone numbers at [Twilio numbers](https://www.twilio.com/user/account/phone-numbers/search)
  `TWILIO_NUMBER` should be set to the phone number you purchased above.

1. Generating an `APP_KEY`:

   ```bash
   $ php artisan key:generate
   ```
1. Running the migrations:

   ```bash
   $ php artisan migrate
   ```

1. Running the application using Artisan.

  ```bash
  $ php artisan serve
  ```

### The background scheduler

The messages are sent using Laravel's scheduler. This requires us to execute `php artisan schedule:run` every minute. For development executing the command in an infinite loop should work just fine:
```
while true; do php artisan schedule:run; sleep 60; done
```
