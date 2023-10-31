<?php

namespace DamienUnsolite\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class FactorialResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource employee_id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'employee_id');
    }

    /**
     * Get resource role
     *
     * @return string|null
     */
    public function getRole()
    {
        return $this->getValueByKey($this->response, 'role');
    }

    /**
     * Get resource email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * Get resource fullname
     *
     * @return string|null
     */
    public function getFullname()
    {
        return $this->getValueByKey($this->response, 'full_name');
    }

    /**
     * Get resource lastname
     *
     * @return string|null
     */
    public function getLastname()
    {
        return $this->getValueByKey($this->response, 'last_name');
    }

    /**
     * Get resource firstname
     *
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->getValueByKey($this->response, 'first_name');
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
