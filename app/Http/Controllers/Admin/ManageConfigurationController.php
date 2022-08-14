<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;
use DB;

class ManageConfigurationController extends Controller
{

    /**
     * Return view for Form to enter Config Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function editConfigurationView(Request $request)
    {
        // Get All Config and Pass to Form View
        $config = Configuration::all();
        return view('admin.editConfiguration')->with(compact('config'));
    }

    /**
     * Submit Form to enter Details 
     * 
     * @return \Illuminate\Http\Response
     */
    public function editConfiguration(Request $request)
    {
        //validate user and material exists
        $request->validate([
            'admin_borrow_no'=>'required|numeric|min:0',
            'admin_borrow_duration'=>'required|numeric|min:0',
            'privileged_borrow_no'=>'required|numeric|min:0',
            'privileged_borrow_duration'=>'required|numeric|min:0',
            'regular_borrow_no'=>'required|numeric|min:0',
            'regular_borrow_duration'=>'required|numeric|min:0',
            'late_fees_base'=>'required|numeric|min:0',
            'late_fees_increment'=>'required|numeric|min:0',
            'point_limit'=>'required|numeric|min:0',
        ]);

        // update all status borrow no of books and duration
        if ($this->updateConfiguration(1, $request->admin_borrow_no, $request->admin_borrow_duration) && 
        $this->updateConfiguration(2, $request->privileged_borrow_no, $request->privileged_borrow_duration) && 
        $this->updateConfiguration(3, $request->regular_borrow_no, $request->regular_borrow_duration)){

            $res = DB::table('configurations')
                    ->update(['late_fees_base' => $request->late_fees_base, 
                    'late_fees_increment' => $request->late_fees_increment,
                    'point_limit' => $request->point_limit]);

            if ($res){
                return redirect()->route('edit_configuration')->with('Success', 'Configuration Edited Successfully');
            }
        }
        return redirect()->route('edit_configuration')->with('Fail', 'Configuration Could Not Be Edited');
    }


    /**
     * Update Config
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateConfiguration($privilege, $borrow_no, $borrow_duration)
    {
        // update
        $config = Configuration::find($privilege);
        $config->no_of_borrows = $borrow_no;
        $config->borrow_duration = $borrow_duration;
        $res = $config->save();

        return $res;
    }
            
}
