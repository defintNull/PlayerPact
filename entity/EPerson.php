<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Person object
 *
 * Entity Class for Person object
 *
 * @package Playerpact\Entity
 */
class EPerson implements FInterface
{

    protected $id;
    protected $username;
    protected $password;
    protected $name;
    protected $surname;
    protected $birthDate;
    protected $email;
    protected $image;

    /**
     * Constructor for Person object
     *
     * Create instance of a Person object
     *
     * @param int $id The id of the object
     * @param string $username The username of the Person object
     * @param string $password The password of the Person object
     * @param string $name The name of the Person object
     * @param string $surname The surname of the Person object
     * @param string $birthDate The birthDate of the Person object
     * @param string $email The email of the Person object
     * @param $image The image of the Person object
     * 
     */
    public function __construct(int $id,string $username,string $password,string $name,string $surname,string $birthDate,string $email, $image)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->image = $image;
    }

    /**
     * Return id of Person object
     *
     * Return id of Person object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return username of Person object
     *
     * Return username of Person object
     * 
     * @return string
     * 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Return password of Person object
     *
     * Return password of Person object
     * 
     * @return string
     * 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Return name of Person object
     *
     * Return name of Person object
     * 
     * @return string
     * 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return surname of Person object
     *
     * Return surname of Person object
     * 
     * @return string
     * 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Return birthDate of Person object
     *
     * Return birthDate of Person object
     * 
     * @return string
     * 
     */
    public function getBirthdate()
    {
        return $this->birthDate;
    }

    /**
     * Return email of Person object
     *
     * Return email of Person object
     * 
     * @return string
     * 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Return image of Person object
     *
     * Return image of Person object
     * 
     */
    public function getImage()
    {
        return $this->image;
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
            "id" => $this->id,
            "username" => $this->username,
            "password" => $this->password,
            "name" => $this->name,
            "surname" => $this->surname,
            "birthDate" => $this->birthDate,
            "email" => $this->email,
            "image" => $this->image
        );
        return $v;
    }

}
