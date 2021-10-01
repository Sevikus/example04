<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat() {

        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()
        //     ->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);

        return view('admin.category.index', compact('categories', 'trashCat'));
    }



    public function AddCat(Request $request) {

        $valiatedData = $request->validate([
          'category_name' => 'required|unique:categories|max:255',
        ],[
          'category_name.required' => 'Please Input Category Name',
          'category_name.max' => 'Category Less Then 255 Chars',
        ]);

        // Category::insert([
        //   'category_name' => $request->category_name,
        //   'user_id' => Auth::user()->id, 
        //   'created_at' => Carbon::now() 
        // ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data); 

        return redirect()->back()->with('success', 'Category Inserted');   
    }

    public function Edit($id) {
      // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
      return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id) {
      $valiatedData = $request->validate([
          'category_name' => 'required|unique:categories|max:255',
        ],[
          'category_name.required' => 'Please Input Category Name',
          'category_name.max' => 'Category Less Then 255 Chars',
        ]);

      $update = Category::find($id)->update([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
      ]);

      // $data = array();
      // $data['category_name'] = $request->category_name;
      // $data['user_id'] = Auth::user()->id;
      // DB::table('categories')->where('id', $id)->update($data);

      return redirect()->route('all.category')->with('success', 'Category Updated');

    }

    public function SoftDelete($id) {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Soft Delete Successfully');

    }

    public function Restore($id) {
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function PermanentDelete ($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        // $categories = Category::latest()->paginate(5);
        // $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // return view('admin.category.index', compact('categories', 'trashCat'));

        return redirect()->back()->with('success', 'Category Deleted Permanently');
    }
}
