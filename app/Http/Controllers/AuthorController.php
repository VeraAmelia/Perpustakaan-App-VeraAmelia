<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::latest()->get();
        return view('author.index', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required',
            'author_name' => 'required'
        ]);

        $author = Author::create([
            'author_id' => $request->author_id,
            'author_name' => $request->author_name,
            'slug' => Str::slug($request->title)
        ]);

        if ($author) {
            return redirect()
                ->route('author.index')
                ->with([
                    'success' => 'New author has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'author_id' => 'required|string|max:155',
            'author_name' => 'required'
        ]);

        $author = Author::findOrFail($id);

        $author->update([
            'author_id' => $request->author_id,
            'author_name' => $request->author_name,
            'slug' => Str::slug($request->title)
        ]);

        if ($author) {
            return redirect()
                ->route('author.index')
                ->with([
                    'success' => 'Author has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        if ($author) {
            return redirect()
                ->route('author.index')
                ->with([
                    'success' => 'Author has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('author.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
