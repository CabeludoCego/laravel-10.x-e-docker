<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    // injeção de dependência: Senão houver, cria objeto Support para usar.
    public function index(Support $support){

        $supports = $support->all();    // collection

        return view('admin/supports/index',
            ['supports' => $supports]
        );
    }

    public function create() {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupportRequest $request, Support $support) {
                
        // dd($request->only(['subject', 'body']));
        // dd($request->body);
        // dd($request->get('body', 'default', 'xpto'));
        
        $data = $request->validated();
        $data['status'] = 'a';

        // // ** Criação estática: Só com request
        // Support::create($data);
        
        // // ** Criação dinâmica: Injeta um Support $support
        $support->create($data);
        return redirect()->route('supports.index');
    }

    
    public function edit(Request $request,Support $support,string|int $id){
        if (!$support  = $support->find($id)){
            return back();
        };
        return view('admin/supports.edit', compact('support'));
    }


    public function update (StoreUpdateSupportRequest $request,Support $support,string|int $id){
        if (!$support  = $support->find($id)){
            return back();
        };

        // $support->update($request->only([
        //     'subject', 'body', 'status']));
        $support->update($request->validated());
    

        return view('admin/supports.edit', compact('support'));
    }


    public function destroy (string|int $id) {
        if (!$support  =  Support::find($id)){
            return back();
        };
        $support->delete();

        return redirect()->route('supports.index');

    }

    
    public function show(string|int $id) {
        // se não existe, ou é nulo:
        if (!$support  = Support::find($id)){
            return back();
        };
        
        return view('admin.supports.show', compact('support'));
    }



}
