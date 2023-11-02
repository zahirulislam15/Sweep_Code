<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(20);
        return view("home")->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|unique:items",
            "description" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,jpeg",
        ]);

        try {
            $inputs = $request->except("_token", "image");

            if($request->hasFile("image"))
            {
                $fileName = $request->file("image")->hashName();
                $request->file("image")->move(public_path("uploads"), $fileName);
                $inputs['image'] = "uploads/$fileName";
            }

            $inputs['slug'] = \Str::slug($request->title);

            Item::create($inputs);

            return back()->with("success", "Item added successfully");

        } catch (\Exception $e) {
            return back()->withInput()->with("exception", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view("form")->with(compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            "title" => "required|string|unique:items,title,".$item->id.",id",
            "description" => "required|string",
            "price" => "required|numeric",
            "image" => "nullable|image|mimes:png,jpg,jpeg",
        ]);

        try {
            $inputs = $request->except("_token", "image");

            if($request->hasFile("image"))
            {
                $fileName = $request->file("image")->hashName();
                $request->file("image")->move(public_path("uploads"), $fileName);
                $inputs['image'] = "uploads/$fileName";
            }

            $inputs['slug'] = \Str::slug($request->title);

            $item->update($inputs);

            return to_route("items.index")->with("success", "Item updated successfully");

        } catch (\Exception $e) {
            return back()->withInput()->with("exception", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with("success", "Item deleted successfully");
    }
}
