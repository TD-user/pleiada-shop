<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 08.12.2019
 * Time: 18:47
 */

namespace common\models;

class ProductTemp
{
    public $product_id;
    public $name;
    public $price;
    public $count;
    public $summa;

    public $product;

    public function validateUserData()
    {
        $result = true;

        if($this->product->promotionPrice != 0 and $this->product->promotionPrice != null)
            $tempPrice = $this->product->promotionPrice;
        else
            $tempPrice = $this->product->price;

        if($this->price != $tempPrice)
            $result = false;

        $tempSumma = $tempPrice * $this->count;
        if($this->summa != $tempSumma)
            $result = false;

        return $result;
    }

    public function ifNotValid()
    {
        $this->product_id = $this->product->id;
        $this->name = $this->product->name;
        $this->price = ($this->product->promotionPrice != 0 and $this->product->promotionPrice != null) ? $this->product->promotionPrice : $this->product->price;
        $this->summa = $this->price * $this->count;
    }

}