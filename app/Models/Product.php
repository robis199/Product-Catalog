<?php
namespace App\Models;

use Airplane;
use Boat;
use Car;

final class Product
{
    private Car $car;
    private Airplane $airplane;
    private Boat $boat;


    public function __construct(Car $car, Airplane $airplane, Boat $boat)
    {
        $this->car = $car;
        $this->airplane = $airplane;
        $this->boat = $boat;
    }


    public function getCar(): Car
    {
        return $this->car;

        }

        public function getCarById()
        {
            return $this->car->getVehicleId();
        }

        public function getCarMake()
        {
            return $this->car->getMake();
        }

        public function getCarModel()
        {
            return $this->car->getModel();
        }

    public function getCarPrice()
    {
        return $this->car->getPrice();
    }




    public function getBoat(): Boat
    {
        return $this->boat;
    }

    public function getBoatById()
    {
        return $this->boat->getVehicleId();
    }

    public function getBoatMake()
    {
        return $this->boat->getMake();
    }

    public function getBoatModel()
    {
        return $this->boat->getModel();
    }

    public function getBoatPrice()
    {
        return $this->boat->getPrice();
    }


    public function getAirplane(): Airplane
    {
        return $this->airplane;
    }

    public function getAirplaneById()
    {
        return $this->airplane->getVehicleId();
    }

    public function getAirplaneMake()
    {
        return $this->airplane->getMake();
    }

    public function getAirplaneModel()
    {
        return $this->airplane->getModel();
    }

    public function getAirplanePrice()
    {
        return $this->airplane->getPrice();
    }

    public function toArray(): array
    {
        return [
            'vehicle_id'=> $this->getVehicleId(),
            'make'=> $this->getMake(),
            'model'=> $this->getModel(),
            'category'=> $this->getPrice(),

        ];
    }
}