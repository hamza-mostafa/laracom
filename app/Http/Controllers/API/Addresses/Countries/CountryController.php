<?php

namespace App\Http\Controllers\API\Addresses\Countries;

use App\Shop\Countries\Exceptions\CountryNotFoundException;
use App\Shop\Countries\Repositories\CountryRepository;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Countries\Requests\CreateCountryRequest;
use App\Shop\Countries\Requests\UpdateCountryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    private $countryRepo;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepo = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $list = $this->countryRepo->listCountries('created_at', 'desc');

        return response()->json([
            'countries' => $this->countryRepo->paginateArrayResults($list->all(), 10)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $country = $this->countryRepo->findCountryById($id);
        $countryRepo = new CountryRepository($country);
        $provinces = $countryRepo->findProvinces();

        return response()->json([
            'country' => $country,
            'provinces' => $this->countryRepo->paginateArrayResults($provinces->toArray())
        ]);
    }

    /**
     * @param CreateCountryRequest $request
     * @return JsonResponse
     */
    public function create(CreateCountryRequest $request) : JsonResponse
    {
        $request->status = 1;
        $this->countryRepo->createCountry($request);
        return response()->json(['message' => 'Country created successfully', 201]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCountryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCountryRequest $request, int $id) : JsonResponse
    {
        $this->countryRepo->updateCountry($request, $id);
        return response()->json(['message' => 'Country updated successfully', 204]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id) : JsonResponse
    {
        $this->countryRepo->destroy($id);
        return response()->json(['message' => 'Country updated successfully', 204]);
    }
}
