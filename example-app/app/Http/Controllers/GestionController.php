<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class GestionController extends Controller
{
    //

    public function index()
    {
       return Product::select('id','title','descritpion','image')->get();

    }

    public function create(Request $request){
        $request->validate([
            'title'=>'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);
        $product=new Product();
        $product->title=$request->title;
        $product->descritpion=$request->description;
        $product->image=$request->image->store('uploads','public');
        $product->save();

        return response()->json([
            'message'=>'creating new product successfuly'
        ]);
    }

    public function show(Product $product){
        return response()->json([
            'message'=>$product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);
        $product->title=$request->title;
        $product->descritpion=$request->description;


        if ($request->hasFile('image')) {
            if($product->image) {
                $path = public_path('storage/'.$product->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $product->image=$request->image->store('uploads','public');
        }
        $product->save();
        return response()->json([
            'message' => 'Item updated successfully'
        ]);
    }


    public function destroy(Product $product)
    {
        if($product->image) {
            $path = public_path('storage/'.$product->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $product->delete();
        return response()->json([
            'message' => 'Item deleted successfully'
        ]);

    }










    public function calcul($nombreCopie)
    {
        if (view()->exists('calcul')) {
            return view('calcul', ['nombreCopie' => $nombreCopie]);
        } else {
            return view('error');
        }
    }

    public function moyenne($nom, $moyenne)
    {
        $decision = '';
        if ($moyenne >= 10) {
            $decision = 'Admis';
        } elseif ($moyenne >= 7) {
            $decision = 'Rattrapage';
        } else {
            $decision = 'Non admis';
        }

        return view('moyenne')->with('nom', $nom)->with('moyenne', $moyenne)->with('decision', $decision);
    }

    public function notes(Request $request)
    {
        $etudiants = [
            ['nom' => 'Ahmed', 'note' => 15],
            ['nom' => 'Mohamed', 'note' => 9],
            ['nom' => 'Khadija', 'note' => 12],
            ['nom' => 'Adam', 'note' => 18],
        ];

        $total_students = count($etudiants);

        $average_grade = array_sum(array_column($etudiants, 'note')) / $total_students;

        $good_students = array_filter($etudiants, function($student) use ($average_grade) {
            return $student['note'] > $average_grade;
        });
        // dd('hi');
        return response()->json([
            'total_students'=>$total_students,
            'good_students'=>$good_students,
            'message'=>$request->all()
        ]);

        // return view('notes', compact('total_students', 'good_students'));
    }



}
