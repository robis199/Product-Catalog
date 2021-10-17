<?php
namespace App\Models;


final class Product
{
    private Car $car;
    private Bike $bike;
    private Boat $boat;


    public function __construct(Car $car, Bike $bike, Boat $boat)
    {
        $this->car = $car;
        $this->bike = $bike;
        $this->boat = $boat;
    }


    public function toArray(): array
    {
        return [
            'product_id'=> $this->getId(),
            'name'=> $this->getName(),
            'amount'=> $this->getAmount(),
            'category'=> $this->getCategory(),

        ];
    }
}