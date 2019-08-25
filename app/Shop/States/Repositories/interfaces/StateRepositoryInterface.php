<?php

namespace App\Shop\States\Repositories\interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;

interface StateRepositoryInterface extends BaseRepositoryInterface
{
    public function listStates(string $order = 'id', string $sort = 'desc');

    public function findStateById(int $id);

    public function updateState() : bool;

    public function listCities(int $stateId);

    public function findCountry();

    public function destroy($id);
}