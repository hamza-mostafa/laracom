<?php

namespace App\Shop\Cities\Repositories;

use App\Shop\Cities\Exceptions\CityInvalidArgumentException;
use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;
use App\Shop\Cities\Exceptions\CityNotFoundException;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Shop\Cities\City;
use Illuminate\Support\Collection;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    /**
     * CityRepository constructor.
     *
     * @param City $city
     */
    public function __construct(City $city)
    {
        parent::__construct($city);
        $this->model = $city;
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return mixed
     */
    public function listCities(string $orderBy = 'name', string $sortBy = 'asc')
    {
        return $this->all(['*'], $orderBy, $sortBy);
    }

    /**
     * @param int $id
     * @return City
     * @throws CityNotFoundException
     *
     * @deprecated @findCityByName
     */
    public function findCityById(int $id) : City
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException('City not found.');
        }
    }

    /**
     * @param array $params
     *
     * @param $id
     * @return boolean
     * @throws CityNotFoundException
     */
    public function updateCity(array $params, int $id) : bool
    {
        try {
            $this->findCityById($id)->update($params);
            return $this->model->save();
        }catch (QueryException $e){
            throw new CityInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param string $state_code
     *
     * @return Collection
     */
    public function listCitiesByStateCode(string $state_code) : Collection
    {
        return $this->model->where(compact('state_code'))->get();
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws CityNotFoundException
     */
    public function findCityByName(string $name) : City
    {
        try {
            return $this->model->where(compact('name'))->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException('City not found.');
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws CityNotFoundException
     * @deprecated @findCityByName
     */
    public function deleteCityById(int $id) : bool
    {
        try {
            return $this->findCityById($id)->delete();
        } catch (ModelNotFoundException $e) {
            throw new CityNotFoundException('City not found.');
        }
    }
}
