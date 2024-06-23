<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Profile object
 *
 * Entity Class for Profile object
 *
 * @package Playerpact\Entity
 */
class EProfile implements FInterface
{

    protected $userId;
    protected $type;
    protected $username;
    protected $password;
    protected $email;

    /**
     * Constructor for Profile object
     *
     * Create instance of a Profile object
     *
     * @param int $userid The id of the object
     * @param string $type The type of the user related
     * @param string $username The username of the profile
     * @param string $password The password of the profile
     * @param string $email The email of the profile
     * 
     */
    public function __construct($userId, $type, $username, $password, $email)
    {
        $this->userId = $userId;
        $this->type = $type;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * Return userId of Profile object
     *
     * Return userId of Profile object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return type of Profile object
     *
     * Return type of Profile object
     * 
     * @return string
     * 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return username of Profile object
     *
     * Return username of Profile object
     * 
     * @return string
     * 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Return password of Profile object
     *
     * Return password of Profile object
     * 
     * @return string
     * 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Return email of Profile object
     *
     * Return email of Profile object
     * 
     * @return string
     * 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Serialize object into array
     *
     * Serialize object into array with key=>value
     * 
     * @return array
     * 
     */
    public function getValues()
    {
        $v = array(
            "id" => $this->userId,
            "type" => $this->type,
            "username" => $this->username,
            "password" => $this->password,
            "email" => $this->email
        );
        return $v;
    }

}
