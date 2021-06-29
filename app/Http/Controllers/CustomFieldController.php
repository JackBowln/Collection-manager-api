<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomFieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllBooks()
    {
        $custom_field = Auth::user()->customField()->get();
        return response()->json(['status' => 'success','result' => $custom_field ]);
    }

    public function showOneBook($id)
    {
        return response()->json(CustomField::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'entity' => 'required',
        ]);
        if(Auth::user()->customField()->Create($request->all())){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
        
        $custom_field = CustomField::create($request->all());

        return response()->json($custom_field, 201);
    }

    public function update($id, Request $request)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        Book::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
