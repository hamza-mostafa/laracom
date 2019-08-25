<?php

namespace App\Http\Controllers\API\Addresses\Cities;

use App\Shop\Cities\City;
use App\Shop\Cities\Repositories\CityRepository;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Shop\Cities\Requests\CreateStateRequest;
use App\Shop\Cities\Requests\UpdateStateRequest;
use App\Http\Controllers\APIController as Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @var CityRepositoryInterface
     */
    private $cityRepo;

    /**
     * CityController constructor.
     *
     * @param CityRepositoryInterface $cityRepository
     */
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepo = $cityRepository;
    }

    /**
     * @OA\Get(
     *      path="/cities",
     *      tags={"Cities"},
     *      summary="Get list of cities",
     *      description="Returns list of cities",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=500, description="Server error")
     *     )
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return response()->json($this->cityRepo->listCities($request['order_by'], $request['sort']));
    }

    /**
     * @param $cityId
     * @return City
     */
    public function show($cityId): City
    {
        return response()->json($this->cityRepo->findCityById($cityId));
    }

    public function create(CreateStateRequest $request)
    {
        $this->cityRepo->create($request);
        return response()->json(['message' => 'City created successfully'], 201);
    }

    /**
     * Update the city
     *
     * @param UpdateStateRequest $request
     * @param int $countryId
     * @param int $provinceId
     * @param $cityId
     * @return JsonResponse
     */
    public function update(UpdateStateRequest $request, $cityId): JsonResponse
    {
        $city = $this->cityRepo->findCityById($cityId);

        $update = new CityRepository($city);
        $update->updateCity($request->only('name'));

        return response()->json(['message' => 'city updated successfully'], 204);
    }

    /**
     *
     * @param $cityId
     * @return JsonResponse
     */
    public function destroy($cityId) : JsonResponse
    {
        $this->cityRepo->deleteCityById($cityId);
        return response()->json(['message' => 'city deleted successfully'], 204);
    }

}
