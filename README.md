# Factorial Provider for OAuth 2.0 Client

This package provides Factorial OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

```
composer require Damien-Unsolite/oauth2-factorial
```

## Usage

```php
$factorialProvider = new \DamienUnsolite\OAuth2\Client\Provider\Factorial([
    'clientId'                => 'yourId',          // The client ID assigned to you by Factorial
    'clientSecret'            => 'yourSecret',      // The client password assigned to you by Factorial
    'redirectUri'             => 'yourRedirectUri'  // The return URL you specified for your app on Factorial
]);

// Get authorization code
if (!isset($_GET['code'])) {
    // Options are optional, defaults to 'profile' only
    $options = ['scope' => 'profile postal_code payments:widget payments:shipping_address payments:billing_address'];
    // Get authorization URL
    $authorizationUrl = $factorialProvider->getAuthorizationUrl($options);

    // Get state and store it to the session
    $_SESSION['oauth2state'] = $factorialProvider->getState();

    // Redirect user to authorization URL
    header('Location: ' . $authorizationUrl);
    exit;
// Check for errors
} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }
    exit('Invalid state');
} else {
    // Get access token
    try {
        $accessToken = $factorialProvider->getAccessToken(
            'authorization_code',
            [
                'code' => $_GET['code']
            ]
        );
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit($e->getMessage());
    }

    // Get resource owner
    try {
        $resourceOwner = $factorialProvider->getResourceOwner($accessToken);
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit($e->getMessage());
    }
        
    // Now you can store the results to session etc.
    $_SESSION['accessToken'] = $accessToken;
    $_SESSION['resourceOwner'] = $resourceOwner;
    
    var_dump(
        $resourceOwner->getId(),
        $resourceOwner->getName(),
        $resourceOwner->getPostalCode(),
        $resourceOwner->getEmail(),
        $resourceOwner->toArray()
    );
}
```

For more information see the PHP League's general usage examples.

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/Damien-Unsolite/oauth2-factorial/blob/main/LICENSE) for more information.
