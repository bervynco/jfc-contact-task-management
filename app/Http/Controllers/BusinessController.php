<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateNewBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;

use App\Actions\Business\GetAllBusiness;
use App\Actions\Business\GetBusiness;
use App\Actions\Business\CreateNewBusiness;
use App\Actions\Business\UpdateBusiness;
use App\Actions\TagMapping\CreateTagMapping;
use App\Actions\CategoryMapping\CreateCategoryMapping;

class BusinessController extends Controller
{
    protected $createTagMapping;
    protected $createNewBusiness;
    protected $createCategoryMapping;
    protected $updateBusiness;
    protected $getAllBusiness;
    protected $getBusiness;
    public function __construct(
        CreateTagMapping $createTagMapping,
        CreateNewBusiness $createNewBusiness,
        CreateCategoryMapping $createCategoryMapping,
        UpdateBusiness $updateBusiness,
        GetAllBusiness $getAllBusiness,
        GetBusiness $getBusiness
        )
    {
        $this->getAllBusiness = $getAllBusiness;
        $this->createTagMapping = $createTagMapping;
        $this->createNewBusiness = $createNewBusiness;
        $this->createCategoryMapping = $createCategoryMapping;
        $this->updateBusiness = $updateBusiness;
        $this->getBusiness = $getBusiness;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $business = $this->getAllBusiness->handle();
            return response()->json(['status' => 'success', 'data' => $business], 200);
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewBusinessRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $tags = $request['tags'] ?? [];
            $categories = $request['categories'] ?? [];
            unset($requestData['tags']);
            unset($requestData['categories']);
            $business = $requestData;
            $businessId = $this->createNewBusiness->handle($business);

            $requestTags = array_map(function($tag) use ($businessId) {
                return [
                    'tag_id' => $tag,
                    'business_id' => $businessId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }, $tags);

            $requestCategories = array_map(function($category) use ($businessId) {
                return [
                    'category_id' => $category,
                    'business_id' => $businessId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }, $categories);
            
            $this->createTagMapping->handle($requestTags);
            $this->createCategoryMapping->handle($requestCategories);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Business created successfully'], 200);
        } catch (HttpResponseException $e) {
            DB::rollBack();
            return $e->getResponse();
        } catch(\Exception $e) {
            DB::rollBack();
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while creating the business'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $business = $this->getBusiness->handle($id);
            return response()->json(['status' => 'success', 'data' => $business], 200);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while pulling business'], 500);
        }
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
    public function update(UpdateBusinessRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $tags = $request['tags'] ?? [];
            $categories = $request['categories'] ?? [];
            unset($requestData['tags']);
            unset($requestData['categories']);
            $business = $requestData;
            $this->updateBusiness->handle($business, $id);

            // $requestTags = array_map(function($tag) use ($businessId) {
            //     return [
            //         'tags_id' => $tag,
            //         'business_id' => $businessId,
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now()
            //     ];
            // }, $tags);

            // $requestCategories = array_map(function($category) use ($businessId) {
            //     return [
            //         'category_id' => $category,
            //         'business_id' => $businessId,
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now()
            //     ];
            // }, $categories);
            
            // $this->createTagMapping->handle($requestTags);
            // $this->createCategoryMapping->handle($requestCategories);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Business updated successfully'], 200);
        } catch (HttpResponseException $e) {
            DB::rollBack();
            return $e->getResponse();
        } catch(\Exception $e) {
            DB::rollBack();
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the business'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
