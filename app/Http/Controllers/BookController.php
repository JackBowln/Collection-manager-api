<?php

namespace App\Http\Controllers;

use App\Book;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllBooks(Request $request)
    {
        $per_page = $request->input('per_page');
        $book = Auth::user()->book()->orderBy("created_at", "DESC")->paginate($per_page);
        return response()->json(['status' => 'success','result' => $book]);
    }

    public function showOneBook($id)
    {
        return response()->json(Book::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        if(Auth::user()->book()->Create($request->all())){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }

        $book = Book::create($request->all());

        return response()->json($book, 201);
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
