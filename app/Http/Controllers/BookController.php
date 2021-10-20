<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookValidateRequest;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index',[
            'books' => Book::latest()->get(),
            'members' => Member::all(),
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookValidateRequest $request)
    {
        Book::insert($request->except('_token') + [
            'created_at' => now(),
        ]);
        return back()->with('success' , __('Book issue successfully !!'));
    }

    public function edit(Book $book)
    {
        return view('admin.book.edit',[
            'book'   => $book,
            'members' => Member::all(),
        ]);
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->except('_token','_method') + [
            'created_at' => now(),
           ]);
           return redirect('book')->with('success', __($book->book_name.' Book update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('book')->with('delete', __("book Delete successfully!!"));
    }

    public function pending($id){
        Book::findOrFail($id)->update([
            'return_status' => 2,
        ]);
        return redirect('book')->with('success', __("book return successfully!!"));
    }
    public function returned($id){
        Book::findOrFail($id)->update([
            'return_status' => 1,
        ]);
        return redirect('book')->with('delete', __("book pending!!"));
    }
}
