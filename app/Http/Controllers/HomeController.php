<?php

namespace App\Http\Controllers;

use App\Http\Filters\CategoryFilter;
use App\Http\Filters\TestFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\TestRequest;
use App\Models\Traits\Filterable;
use App\Product;
use App\ProductsView;
use App\PruductCatiegory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use TCG\Voyager\Models\Category;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(FilterRequest $request, TestRequest $requestName)
    {
        $products = ProductsView::all();
        $categorie = PruductCatiegory::all();
        $info = Product::all();

        $data = $request->validated();
        $dataName = $requestName->validated();

        $titleFilter = app()->make(TestFilter::class, ['queryParams' => array_filter($dataName)]);
        $categoryFilter = app()->make(CategoryFilter::class, ['queryParams' => array_filter($data)]);

        $cate = ProductsView::filter($categoryFilter)->get();
        $title = Product::filter($titleFilter)->get();

        $uniqueCategory = $cate->unique('id_product');

        return view(('index'), [
            'products' => $products,
            'categories' => $categorie,
            'info' => $info,
            'title' => $title,
            'uniqueCategory' => $uniqueCategory,
            'cate' => $cate]);
    }


    public function home()
    {
        $products = ProductsView::all();
        $categorie = PruductCatiegory::all();
        $info = Product::all();

        $uniq = $products->unique('id_product');



        return view('home', ['products' => $products, 'categories' => $categorie, 'info' => $info, 'uniq' => $uniq]);
    }

    public function editProduct(Request $request)
    {
        $id = $request['id'];
        $info = Product::find($id);
        $product = ProductsView::where('id_product', $id)->get();
        $info->name = $request->name;
        $info->opis = $request->opis;
        if (isset($request->image)){
            $nameImg = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/img', $nameImg);
            $info->image = $nameImg;
        }
        if (isset($request->category)){
            foreach ($product as $p){
                $p->update(['id_categorie' => $request->category]);
            }
        }

        $info->save();
        return back();
    }

    public function deleteProduct(Request $request){
        $id = $request->id;
        $product = Product::find($id);
        $productView = ProductsView::where('id_product', $id);

        $product->delete();
        $productView->delete();
        return back();
    }

    public function addProduct(Request $request){

        $nameImg = $request->file('image')->getClientOriginalName();
        if (isset($request->image)){
            $path = $request->file('image')->storeAs('public/img', $nameImg);
        }

        $product = Product::create([
            'name' => $request->name,
            'opis' => $request->opis,
            'image' => $nameImg,
        ]);
        foreach ($request->price as $price){
            if (isset($price)){
                $productView = ProductsView::create([
                    'id_product' => $product->id,
                    'id_categorie' => $request->category,
                    'price' => $price
                ]);
            }
        }
        return back();
    }

    public function addCategory (Request $request){
        $category = PruductCatiegory::create([
           'categories' => $request->categories,
        ]);
        return back();
    }

    public function editCategory(Request $request){
        $id = $request->id;
        $category = PruductCatiegory::find($id);
        $category->categories = $request->categories;

        $category->save();
        return back();
    }

    public function deleteCategory(Request $request){
        $id = $request->id_category;
        $category = PruductCatiegory::find($id);
        $category->delete();
        return back();
    }

    public function deleteProductView(Request $request){
        $id = $request->id;
        $product = ProductsView::find($id);

        $product->delete();

        return back();
    }

    public function editProductView(Request $request){

        $id = $request->id;
        $product = ProductsView::find($id);
        $product->id_product = $request->id_product;
        $product->id_categorie = $request->category;
        $product->price = $request->price;

        $product->save();
        return back();
    }

    public function productPage(Request $request){
        $products = ProductsView::all();
        $categories = PruductCatiegory::all();
        $info = Product::all()->where('id', $request['id']);


        foreach ($info as $f) {
            foreach ($products as $p) {
                if ($p->id_product == $f->id) {
                    foreach ($categories as $c) {
                        if ($c->id == $p->id_categorie) {
                            $nameCategory = $c->categories;
                        }
                    }
                }
            }
        }

        return view('productPage', ['products' => $products, 'nameCategory' => $nameCategory, 'info' => $info]);
    }
}
