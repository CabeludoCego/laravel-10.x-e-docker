<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use App\DTOs\Supports\CreateSupportDTO;
use App\DTOs\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service,
    )  { }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page:         $request->get('page',1),
            totalPerPage: $request->get('per_page',1),
            filter:       $request->get('filter',null),
        );
        // dd($supports);
        // dd($supports->items());
        return ApiAdapter::toJson($supports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupportRequest $request, Support $support) {
        
        $support = $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        // return redirect()->route('supports.index');
        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request, $id)
        );

        if(!$support){
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }
        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}