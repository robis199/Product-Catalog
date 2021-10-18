<?php

class Boat

{
    private string $vehicleId;
    private string $make;
    private string $model;
    private string $price;


    public function __construct(string $vehicleId,string $make, string $model, string $price)
    {
        $this->vehicleId = $vehicleId;
        $this->make = $make;
        $this->model = $model;
        $this->price = $price;
    }



    public function getVehicleId(): string
    {
        return $this->vehicleId;
    }

    public function getPrice(): string
    {
        return $this->price;
    }


    public function getMake(): string
    {
        return $this->make;
    }


    public function getModel(): string
    {
        return $this->model;
    }

}