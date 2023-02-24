<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use DataTables;

class EmployeesController extends Controller
{

    public function index(Request $request)
    {        
        if ($request->ajax()) {
            $data = Employee::select('id','emp_id','name','job_title')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('emp.view', $row->emp_id).'" data-toggle="tooltip"  data-id="'.$row->emp_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployee">Edit</a>';
   
                           $btn = $btn.' <a data-toggle="tooltip"  data-id="'.$row->emp_id.'" data-original-title="Delete" class="btn btn-danger btn-sm " onclick="deleteItem('.$row->id.')">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employees');
    }

    public function excelUpload(Request $request){
            return view('uploadExcel');
        }
 
    public function excelImport(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xlx,xls',
        ]);
        $import = new EmployeeImport();
        $import->import($request->file('file')->store('temp'));
       
         if (sizeof($import->failures())>0) {
                    foreach ($import->failures() as $failure) {           
            $failedEmpid[]=$failure->values()['employeeid'];
        }
        $failedEmpid=implode(" ",$failedEmpid);
         return back()
            ->with('fail',"Records with duplicate entries for Employee Ids $failedEmpid have not inserted.");
    }   
                   
         return back()
            ->with('success','You have successfully uploaded Employee Records.');
            
    }

    public function viewEmployee(Request $request){       
        $employee=Employee::where('emp_id',$request['id'])->get();
        return view('editEmployee',compact('employee'));
        }

    public function editEmployee(Request $request){
        
        $validator = Validator::make($request->all(), [
             'name' => 'required',
             'job_title'=>'required'
        ]);
         if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $employee = Employee::find($request->input('empid'));

        $employee->update($request->all());

        return response()->json(['success' => 'Employee Details Updated.']);

  }

    public function destroy(Request $request){
    Employee::find($request->input('id'))->delete($request->input('id'));
  
    return response()->json([
        'success' => 'Record deleted successfully!'
    ]);
}
}
