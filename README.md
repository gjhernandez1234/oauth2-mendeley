# Mendeley Provider for OAuth 2.0 Client

## Requirements

The following versions of PHP are supported.

* PHP 5.6
* PHP 7.0
* PHP 7.1
* HHVM

[Google Sign In](https://developers.google.com/identity/sign-in/web/sign-in) will also need to be set up, which will provide you with the `{google-app-id}` and `{google-app-secret}` required (see [Usage](#usage) below).

If you're using the default [scopes](#scopes) then you'll also need to enable the [Google+ API](https://developers.google.com/+/web/api/rest/) for your project.

## Installation

To install, use composer:

```json
#composer.json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://gjhernandez1234@bitbucket.org/desarrollosibe/oauth2-client.git"
        }
    ]
}
```

```bash
composer require gjhernandez1234/oauth2-mendeley
```