<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

use App\Actions\Tag\CreateNewTag;
use App\Actions\Tag\UpdateTag;
use App\Actions\Tag\DeleteTag;
use App\Actions\Tag\GetAllTag;
use App\Actions\Tag\GetTag;

class TagController extends Controller
{
    protected $createNewTag;
    protected $updateTag;
    protected $deleteTag;
    protected $getAllTag;
    protected $getTag;
    public function __construct(
        CreateNewTag $createNewTag,
        UpdateTag $updateTag,
        DeleteTag $deleteTag,
        GetAllTag $getAllTag,
        GetTag $getTag
        )
    {
        $this->createNewTag = $createNewTag;
        $this->updateTag = $updateTag;
        $this->deleteTag = $deleteTag;
        $this->getAllTag = $getAllTag;
        $this->getTag = $getTag;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->getAllTag->handle()); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
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
    public function store(CreateTagRequest $request)
    {
        try {
            return response()->json($this->createNewTag->handle($request->validated())); 
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
            return response()->json($this->getTag->handle($id)); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
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
    public function update(UpdateTagRequest $request, string $id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->updateTag->handle($request->validated(), $id)
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
                'data' => $this->deleteTag->handle($id)
            ]);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }
}
