<?php

namespace App\Shop\Cities\Repositories\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Shop\Cities\City;

interface CityRepositoryInterface extends BaseRepositoryInterface
{
    public function listCities(string $orderBy, string $sortBy);

    public function findCityById(int $id) : City;

    public function updateCity(array $params, int $id) : bool;

    public function findCityByName(string $name) : City;

    public function deleteCityById(int $id) : bool;
}
