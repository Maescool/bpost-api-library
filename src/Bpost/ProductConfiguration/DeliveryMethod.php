<?php

namespace TijsVerkoyen\Bpost\Bpost\ProductConfiguration;

use SimpleXMLElement;

class DeliveryMethod
{
    /** @var  string */
    private $name;
    /** @var  string */
    private $visibility;
    /** @var Product[] */
    private $products = array();

    /**
     * @param SimpleXMLElement $xml
     *
     * @return DeliveryMethod
     */
    public static function createFromXML(SimpleXMLElement $xml)
    {
        /*
        <characteristic displayValue="Basic (0-500 EUR)" value="1" name="Insurance range code"/>
        */
        $attributes = $xml->attributes();
        $children = $xml->children();

        $deliveryMethod = new self();
        $deliveryMethod->setName($attributes['name']);
        $deliveryMethod->setVisibility($attributes['visibility']);

        if (isset($children->product)) {
            foreach ($children->product as $productXml) {
                $deliveryMethod->addProduct(Product::createFromXML($productXml));
            }
        }

        return $deliveryMethod;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @return string
     * @see Constants self::VISIBLITY_*
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     *
     * @see Constants self::VISIBLITY_*
     */
    public function setVisibility($visibility)
    {
        $this->visibility = (string) $visibility;
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }


}