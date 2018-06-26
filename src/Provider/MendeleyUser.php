<?php

namespace gjhernandez1234\OAuth2\Client\Provider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

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
        if (array_key_exists('first_name', $this->response)) {
            return $this->response['first_name'];
        }
        return null;
    }

    /**
     * Get preferred last name.
     *
     * @return string
     */
    public function getLastName()
    {
        if (array_key_exists('last_name', $this->response)) {
            return $this->response['last_name'];
        }
        return null;
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
        return null;
    }
    
    /**
     * Get photo.
     *
     * @return string|null
     */
    public function getAvatar()
    {
        if (array_key_exists('photo', $this->response)) {
            if(array_key_exists('standard', $this->response["photo"])){
                return $this->response["photo"]["standard"];
            }
        }
        return null;
    }
    
    /**
     * Get scopus_author_ids.
     *
     * @return array|null
     */
    public function getScopusId()
    {
        if (array_key_exists('scopus_author_ids', $this->response)) {
            return $this->response["scopus_author_ids"];
        }
        return null;
    }
    
    /**
     * Get orcid_id.
     *
     * @return string|null
     */
    public function getOrcidId()
    {
        if (array_key_exists('orcid_id', $this->response)) {
            return $this->response["orcid_id"];
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