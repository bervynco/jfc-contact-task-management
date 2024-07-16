<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;
use App\Actions\Category\DeleteCategory;

class CategoryController extends Controller
{
    protected $createNewCategory;
    protected $updateCategory;
    protected $cdeleteCategory;
    public function __construct(
        CreateNewCategory $createNewCategory,
        UpdateCategory $updateCategory,
        DeleteCategory $deleteCategory
        )
    {
        $this->createNewCategory = $createNewCategory;
        $this->updateCategory = $updateCategory;
        $this->deleteCategory = $deleteCategory;
    }

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
        //
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
