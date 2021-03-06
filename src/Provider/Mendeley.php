<?php

namespace gjhernandez1234\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Provider\AbstractProvider;

class Mendeley extends AbstractProvider
{
    use BearerAuthorizationTrait;
    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'id';
    /**
     * @var string If set, this will be sent to google as the "access_type" parameter.
     * @link https://developers.google.com/accounts/docs/OAuth2WebServer#offline
     */
    protected $accessType="client_credentials";
    
    /**
     * @var array Additional fields to be requested from the user profile.
     *            If set, these values will be included with the defaults.
     */
    protected $userFields = [];
    
    public function getBaseAuthorizationUrl()
    {
        return 'https://api.mendeley.com/oauth/authorize';
    }
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://api.mendeley.com/oauth/token';
    }
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        // fields that are required based on other configuration options
        $configurationUserFields = [];
        $fields = array_merge($this->userFields, $configurationUserFields);
        return 'https://api.mendeley.com/profiles/me?' . http_build_query([
            'fields' => implode(',', $fields),
            'alt'    => 'json',
        ]);
    }
    protected function getAuthorizationParameters(array $options)
    {
        $params = array_merge(
            parent::getAuthorizationParameters($options),
            array_filter([
                'access_type' => $this->accessType,
            ])
        );
        return $params;
    }
    protected function getDefaultScopes()
    {
        return [
            'all',
        ];
    }
    protected function getScopeSeparator()
    {
        return ' ';
    }
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            $code  = 0;
            $error = $data['error'];
            if (is_array($error)) {
                $code  = $error['code'];
                $error = $error['message'];
            }
            throw new IdentityProviderException($error, $code, $data);
        }
    }
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return $user = new MendeleyUser($response);
        
    }
}