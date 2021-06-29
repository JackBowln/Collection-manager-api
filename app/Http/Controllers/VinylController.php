<?php

namespace App\Http\Controllers;

use App\Models\Vinyl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VinylController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllVinyls(Request $request)
    {
        $per_page = $request->input('per_page');
        $vinyl = Auth::user()->vinyl()->orderBy("created_at", "DESC")->paginate($per_page);;
        return response()->json(['status' => 'success','result' => $vinyl]);
    }

    public function showOneVinyl($id)
    {
        return response()->json(Vinyl::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        if(Auth::user()->vinyl()->Create($request->all())){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
        
        $vinyl = Vinyl::create($request->all());

        return response()->json($vinyl, 201);
    }

    public function update($id, Request $request)
    {
        $vinyl = Vinyl::findOrFail($id);
        $vinyl->update($request->all());

        return response()->json($vinyl, 200);
    }

    public function delete($id)
    {
        Vinyl::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
