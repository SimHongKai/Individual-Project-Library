<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Material;
use DB;

class ManageMaterialController extends Controller
{

    /**
     * Return the view for Admin to add Material for the specified Book and Book Data
     * 
     * @return \Illuminate\Http\Response
     */
    public function addMaterialView(Request $request){
        if ($request->ISBN != null){
            $book = Book::find($request->ISBN);
            return view('admin.catalog.addMaterial')->with(compact('book'));
        }
        else{
            return redirect()->back()->with("Error", "No such Book with specified ISBN found");
        }
    }

    /**
     * Adds book to database
     *
     * @return \Illuminate\Http\Response
     */
    public function addMaterial(Request $request)
    {
        //validate material info before storing to database
        $request->validate([
            'ISBN'=>'required|min:13|max:13|regex:/[0-9]/',
            'call_no'=>'required|unique:materials,call_no|max:255',
            'status' => 'required|min:1|max:4',
            'intake_date'=>'nullable|date_format:Y-m-d|before_or_equal:today',
        ]);
        
        // create new Material to be saved 
        $material = new Material();
        // assign data
        $material->ISBN = $request->ISBN;
        $material->call_no = $request->call_no;
        $material->status = $request->status;
        if ($request->intake_date != null){
            $material->created_at = $request->intake_date;
        }
 
        // save material record
        $res = $material->save();
        $this->updateBookQty($request->ISBN);

        if($res){
            return redirect()->route('manage_book_details', [ $material->ISBN ])
            ->with('Mat Success', 'Material has been added!');
        }
        else{
            return redirect()->back()->with('Fail','Failed to Add Material');
        }
    }

    /**
     * Return the view for Admin to edit Material for the specified Material No and Book
     * 
     * @return \Illuminate\Http\Response
     */
    public function editMaterialView(Request $request){
        if ($request->material_no != null){
            $material = Material::find($request->material_no);
            $book = Book::find($material->ISBN);
            return view('admin.catalog.editMaterial')->with(compact('material', 'book'));
        }
        else{
            return redirect()->back()->with("Fail", "No such Material with specified Material No. found");
        }
    }

    /**
     * Edit Material Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function editMaterial(Request $request){
        //validate material info before storing to database
        $request->validate([
            'material_no'=>'required|exists:materials,material_no|regex:/[0-9]/',
            'call_no'=>'required|max:255|unique:materials,call_no,'.$request->old_call_no.',call_no',
            'status' => 'required|min:1|max:4',
        ]);
        
        // Find the Material to be edited
        $material = Material::find($request->material_no);
        // assign edited data
        $material->call_no = $request->call_no;
        $material->status = $request->status;
        // save material record
        $res = $material->save();

        // success
        if ($res){
            // check and update the Book Qty's
            $this->updateBookQty($material->ISBN);
            // redirect to Book Details
            return redirect()->route('manage_book_details', [ 'ISBN'=> $material->ISBN ])
            ->with('Mat Success', 'Material has been edited');
        }
        // fail
        else{
            return redirect()->back()->with("Fail", "Failed to edit Material");
        }
    }

    /**
     * Delete Specified Material
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteMaterial(Request $request){
        // check material_no passed
        if ($request->material_no != null){
            $material = Material::find($request->material_no);
            if ($material->status == 1 || $material->status == 4){
                $res = $material->delete();
                if ($res){
                    $this->updateBookQty($material->ISBN);
                    return redirect()->route('manage_book_details', [ 'ISBN'=> $material->ISBN ])
                    ->with('Mat Success', 'Material has been deleted');
                }
            }
        }
        // fail
        return redirect()->back()->with("Fail", "Specified Material could not be deleted");
    }

    /**
     * Check and update Book Qty
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBookQty($ISBN)
    {
        $book = Book::find($ISBN);
        $total_qty = DB::table('materials')
                    ->where('ISBN', $ISBN)
                    ->count();
        $available_qty = DB::table('materials')
                    ->where('ISBN', $ISBN)
                    ->where ('status', 1)
                    ->count();

        $book->total_qty = $total_qty;
        $book->available_qty = $available_qty;
        $book->save();
    }
}