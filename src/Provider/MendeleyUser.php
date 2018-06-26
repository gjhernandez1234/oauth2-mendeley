<?php

namespace gjhernandez1234\OAuth2\Client\Provider;

class MendeleyUser implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    protected $response;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        if (array_key_exists('sub', $this->response)) {
            return $this->response['sub'];
        }
        return $this->response['id'];
    }

    /**
     * Get preferred display name.
     *
     * @return string
     */
    public function getName()
    {
        if (array_key_exists('name', $this->response) && is_string($this->response['name'])) {
            return $this->response['name'];
        }
        return $this->response['displayName'];
    }

    /**
     * Get preferred first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        if (array_key_exists('given_name', $this->response)) {
            return $this->response['given_name'];
        }
        return $this->response['name']['givenName'];
    }

    /**
     * Get preferred last name.
     *
     * @return string
     */
    public function getLastName()
    {
        if (array_key_exists('family_name', $this->response)) {
            return $this->response['family_name'];
        }
        return $this->response['name']['familyName'];
    }

    /**
     * Get email address.
     *
     * @return string|null
     */
    public function getEmail()
    {
        if (array_key_exists('email', $this->response)) {
            return $this->response['email'];
        }
        if (!empty($this->response['emails'])) {
            return $this->response['emails'][0]['value'];
        }
        return null;
    }

    /**
     * Get user data as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}