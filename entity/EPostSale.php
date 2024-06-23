<?php
include_once realpath(__DIR__."/../entity/EPost.php");

/**
 * Entity Class for PostSale object
 *
 * Entity Class for PostSale object that extends EPost
 *
 * @package Playerpact\Entity
 */
class EPostSale extends EPost
{

    private $price;
    private $image;

    /**
     * Constructor for PostSale object
     *
     * Create instance of a PostSale object
     *
     * @param int $id The id of the object
     * @param int $userId The id of the user related
     * @param string $title The title of the PostSale
     * @param string $description The description of the PostSale
     * @param string $date The date of the PostSale
     * @param float $price The price of the PostSale
     * @param string $image The image of the PostSale
     * 
     */
    public function __construct(int $id,int  $userId,string $title,string $description, $date, $price, $image)
    {
        parent::__construct($id, $userId, $title, $description, $date);
        $this->price = $price;
        $this->image = $image;
    }

    /**
     * Return price of PostSale object
     *
     * Return price of PostSale object
     * 
     * @return float
     * 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Return image of PostSale object
     *
     * Return image of PostSale object
     * 
     * @return string
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
        $v = parent::getValues();
        $v["price"] = $this->price;
        $v["image"] = $this->image;
        return $v;
    }
}
