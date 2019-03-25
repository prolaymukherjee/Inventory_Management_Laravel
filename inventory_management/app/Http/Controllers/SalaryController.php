<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SalaryController extends Controller
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

    public function AddAdvancedSalary()
    {
      return view('advanced_salary');
    }

    public function AllSalary()
    {
      $salary=DB::table('salaries')
             ->join('employees','salaries.employee_id','employees.id')
             ->select('salaries.*','employees.name','employees.salary','employees.photo')
             ->get();
    	return view('all_advanced_salary', compact('salary'));
    }

    public function InsertAdvanced(Request $request)
    {
            $data=array();
	    	$data['employee_id']=$request->emp_id;
	    	$data['salary_month']=$request->month;
	    	$data['paid_amount']=$request->advanced_salary;




    	 $advanced=DB::table('salaries')->insert($data);
    	  if ($advanced) {
                 $notification=array(
                 'messege'=>'Successfully Advanced Paid ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      

    }

    public function PaySalary()
    {

        $employee=DB::table('employees')->get();
        return view('pay_salary', compact('employee')); 

    }




    //Category Function are here------------------------------

    public function AddCategory()
    {
      return view('add_category');
    }

    public function InsertCategory(Request $request)
    {
      $data=array();
      $data['cat_name']=$request->cat_name;
      $cat=DB::table('categories')->insert($data);
       if ($cat) {
                 $notification=array(
                 'messege'=>'Successfully Category Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 

    }

      public function AllCategory()
    {
      $category=DB::Table('categories')->get();
      return view('all_category', compact('category'));
    }

    public function DeleteCategory($id)
    {
      $dlt=DB::table('categories')->where('id',$id)->delete();
      if ($dlt) {
                 $notification=array(
                 'messege'=>'Successfully Category Deleted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 
    }

    public function EditCategory($id)
    {
      $cat=DB::table('categories')->where('id',$id)->first();
      return view('edit_category')->with('cat',$cat);
    }

    public function UpdateCategory(Request $request,$id)
    {
       $data=array();
       $data['cat_name']=$request->cat_name;
       $cat_up=DB::table('categories')->where('id',$id)->update($data);
        if ($cat_up) {
                 $notification=array(
                 'messege'=>'Successfully Category Updated ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all.category')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }
    }

}
