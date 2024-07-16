<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\Business\CreateNewBusiness;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewBusinessRequest $request, CreateNewBusiness $createNewBusiness)
    {
        $requestData = $request->validated();
        $tags = $request['tags'];
        $categories = $request['categories'];
        unset($requestData['tags']);
        unset($requestData['categories']);
        $business = $requestData;
        $id = $createNewBusiness->handle($requestData);
        foreach($tags as $index => $tag) {
            $tag['business_id'] = $id;
        }

        foreach($categories as $index => $category) {
            $category['business_id'] = $id;
        }
        $createNewTagMapping->handle($tags);
        $createNewCategoriesMapping->handle($categories);
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
