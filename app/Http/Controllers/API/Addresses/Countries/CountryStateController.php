<?php

namespace App\Http\API\Controllers\Front\Addresses;

use App\Http\Controllers\Controller;
use App\Shop\Countries\Repositories\CountryRepository;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CountryStateController extends Controller
{
    private $countryRepo;

    /**
     * CountryStateController constructor.
     *
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepo = $countryRepository;
    }

    /**
     * @param $countryId
     *
     * @return JsonResponse
     */
    public function index($countryId): JsonResponse
    {
        $country = $this->countryRepo->findCountryById($countryId);

        $countryRepo = new CountryRepository($country);
        $data = $countryRepo->listStates();

        return response()->json($countryRepo->listStates());
    }
}