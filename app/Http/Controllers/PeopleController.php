<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateNewPeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;

use App\Actions\People\GetAllPeople;
use App\Actions\People\GetPeople;
use App\Actions\People\CreateNewPeople;
use App\Actions\People\UpdatePeople;
use App\Actions\TagMapping\CreateTagMapping;
use App\Actions\CategoryMapping\CreateCategoryMapping;

class PeopleController extends Controller
{
    protected $createTagMapping;
    protected $createNewPeople;
    protected $createCategoryMapping;
    protected $updatePeople;
    protected $getAllPeople;
    protected $getPeople;

    public function __construct(
        CreateTagMapping $createTagMapping,
        CreateNewPeople $createNewPeople,
        CreateCategoryMapping $createCategoryMapping,
        UpdatePeople $updatePeople,
        GetAllPeople $getAllPeople,
        GetPeople $getPeople
        )
    {
        $this->getAllPeople = $getAllPeople;
        $this->createTagMapping = $createTagMapping;
        $this->createNewPeople = $createNewPeople;
        $this->createCategoryMapping = $createCategoryMapping;
        $this->updatePeople = $updatePeople;
        $this->getPeople = $getPeople;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $people = $this->getAllPeople->handle();
            return response()->json(['status' => 'success', 'data' => $people], 200);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while pulling all business'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
