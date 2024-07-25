<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;
use App\Actions\Category\DeleteCategory;
use App\Actions\Category\GetAllCategory;
use App\Actions\Category\GetCategory;
class CategoryController extends Controller
{
    protected $createNewCategory;
    protected $updateCategory;
    protected $deleteCategory;
    protected $getAllCategory;
    protected $getCategory;
    public function __construct(
        CreateNewCategory $createNewCategory,
        UpdateCategory $updateCategory,
        DeleteCategory $deleteCategory,
        GetAllCategory $getAllCategory,
        GetCategory $getCategory
        )
    {
        $this->createNewCategory = $createNewCategory;
        $this->updateCategory = $updateCategory;
        $this->deleteCategory = $deleteCategory;
        $this->getAllCategory = $getAllCategory;
        $this->getCategory = $getCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->getAllCategory->handle()); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            return response()->json($this->createNewCategory->handle($request->validated())); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json($this->getCategory->handle($id)); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->updateCategory->handle($request->validated(), $id)
            ]);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->deleteCategory->handle($id)
            ]);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }
}
