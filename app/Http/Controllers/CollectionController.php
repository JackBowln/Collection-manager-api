<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $collection = Auth::user()->collection()->with('collections')->get();
        return response()->json(['status' => 'success','result' => $collection]);
    }

    public function show($id)
    {
        return response()->json(Collection::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [

        ]);
        if(Auth::user()->collection()->Create($request->all())){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }

        $collection = Collection::create($request->all());

        return response()->json($collection, 201);
    }

    public function update($id, Request $request)
    {
        $collection = Collection::findOrFail($id);
        $collection->update($request->all());

        return response()->json($collection, 200);
    }

    public function delete($id)
    {
        Collection::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
