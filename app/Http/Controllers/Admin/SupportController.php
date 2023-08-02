<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Supports\CreateSupportDTO;
use App\DTOs\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service) { }


    public function index(Request $request){

        // $supports = $this->service->getAll($request->filter);
        
        $supports = $this->service->paginate(
            page:         $request->get('page',1),
            totalPerPage: $request->get('totalPerPage',5),
            filter:       $request->get('filter',null),
        );
        
        // dd($supports);
        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }


    public function show(string $id) {
        if (!$support  = $this->service->findOne($id)){
            return back();
        };
        
        return view('admin.supports.show', compact('support'));
    }


    public function create() {
        return view('admin/supports/create');
    }

    
    public function store(StoreUpdateSupportRequest $request, Support $support) {
        
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index')
                        ->with('message', 'Cadastrado com sucesso!');
    }

    
    public function edit(string $id){
        if (!$support  = $this->service->findOne($id)){
            return back();
        };
        return view('admin/supports/edit', compact('support'));
    }


    public function update (StoreUpdateSupportRequest $request,Support $support,string|int $id){
        
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request, $id)
        );
        
        if (!$support){
            return back();
        };

        // $support->update($request->only([
        //     'subject', 'body', 'status']));    

        return view('admin/supports/edit', compact('support'))
                    ->with('message', 'Atualizado com sucesso!');

    }


    public function destroy (string $id) {

        $support_data = Support::where('id', $id)->first();

        if($support_data->image && Storage::exists($support_data->image)) 
        {
            Storage::delete($support_data->image);
        }
        
        $this->service->delete($id);
        
        return redirect()->route('supports.index')
                ->with('message', 'Registro removido com sucesso!');

    }


}
