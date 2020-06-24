<a  href="https://www.twilio.com">
<img  src="https://static0.twilio.com/marketing/bundles/marketing/img/logos/wordmark-red.svg"  alt="Twilio"  width="250"  />
</a>

# Appointment reminders in PHP with Laravel

![Laravel CI](https://github.com/TwilioDevEd/appointment-reminders-laravel/workflows/Laravel%20CI/badge.svg)

## About

This application demostrates how to use the Twilio API to send automated reminders about upcoming appointments.

[Read the full tutorial here](https://www.twilio.com/docs/tutorials/walkthrough/appointment-reminders/php/laravel)!

Implementations in other languages:

| .NET | Java | Python | Ruby | Node |
| :--- | :--- | :----- | :-- | :--- |
| [Done](https://github.com/TwilioDevEd/appointment-reminders-csharp)  | [Done](https://github.com/TwilioDevEd/appointment-reminders-java)  | [Done](https://github.com/TwilioDevEd/appointment-reminders-django)    | [Done](https://github.com/TwilioDevEd/appointment-reminders-rails) | [Done](https://github.com/TwilioDevEd/appointment-reminders-node)  |

## Set up

### Requirements

- [PHP >= 7.2.5](https://www.php.net/) and [composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- A Twilio account - [sign up](https://www.twilio.com/try-twilio)

### Twilio Account Settings

This application should give you a ready-made starting point for writing your own application.
Before we begin, we need to collect all the config values we need to run the application:

| Config&nbsp;Value | Description                                                                                                                                                  |
| :---------------- | :----------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Account&nbsp;Sid  | Your primary Twilio account identifier - find this [in the Console](https://www.twilio.com/console).                                                         |
| Auth&nbsp;Token   | Used to authenticate - [just like the above, you'll find this here](https://www.twilio.com/console).                                                         |
| Phone&nbsp;number | A Twilio phone number in [E.164 format](https://en.wikipedia.org/wiki/E.164) - you can [get one here](https://www.twilio.com/console/phone-numbers/incoming) |

### Local development

After the above requirements have been met:

1. Clone this repository and `cd` into it

    ```bash
    git clone git@github.com:twilio-labs/appointment-reminders-laravel.git
    cd appointment-reminders-laravel
    ```

1. Set your environment variables

    ```bash
    cp .env.example .env
    ```

    See [Twilio Account Settings](#twilio-account-settings) to locate the necessary environment variables.

1. Install dependencies

    ```bash
    make install
    ```

1. Build the frontend assets
    ```bash
    npm run dev
    ```

1. Run the application

    ```bash
    make serve
    ```

1. Navigate to [http://localhost:8000](http://localhost:8000)

    That's it!

### The background scheduler

The messages are sent using Laravel's scheduler. This requires us to execute `php artisan schedule:run` every minute. For development executing the command in an infinite loop should work just fine:

```
make scheduler
```

### Docker

If you have [Docker](https://www.docker.com/) already installed on your machine, you can use our `docker-compose.yml` to setup your project.

1. Make sure you have the project cloned.
2. Setup the `.env` file as outlined in the [Local Development](#local-development) steps.
3. Run `docker-compose up`.

### Unit and Integration Tests

You can run the Unit and Feature tests locally by typing:
```bash
php artisan test
```

### Cloud deployment

Additionally to trying out this application locally, you can deploy it to a variety of host services. Here is a small selection of them.

Please be aware that some of these might charge you for the usage or might make the source code for this application visible to the public. When in doubt research the respective hosting service first.

| Service                           |                                                                                                                                                                                                                           |
| :-------------------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| [Heroku](https://www.heroku.com/) | [![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)                                                                                                                                       |

## Resources

- The CodeExchange repository can be found [here](https://github.com/twilio-labs/code-exchange/).

## Contributing

This template is open source and welcomes contributions. All contributions are subject to our [Code of Conduct](https://github.com/twilio-labs/.github/blob/master/CODE_OF_CONDUCT.md).

## License

[MIT](http://www.opensource.org/licenses/mit-license.html)

## Disclaimer

No warranty expressed or implied. Software is as is.

[twilio]: https://www.twilio.com
