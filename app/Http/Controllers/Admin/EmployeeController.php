<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Appraisal;
use App\Models\Emi;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $page = isset($request->page) ? $request->page : 1;
    //     $employees = Employee::orderBy('id','desc')->paginate(10, ['*'], 'page', $page);
    //     return view('admin.employees.index',compact('employees'));
    // }

    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $employees = Employee::orderBy('id', 'desc')
            ->when($query_search, function ($query) use ($query_search) {
                $query->where('gender', 'like', '%' . $query_search . '%')
                    ->orWhere('salary', 'like', '%' . $query_search . '%');
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.employees.pagination', compact('employees'))->render();
        }

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make('123'),
            'password_2' => '123',
        ]);
        $employee->update(['user_id' => $user->id]);
        return redirect()->route('admin.employees.index')->with('success','Create employee successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }


    function appraisal ($id){
        $employee = Employee::find($id);
        $apprisals = Appraisal::where('user_id',$employee->user_id)->get();
        return view('admin.employees.accounts.apprisals',compact('employee','apprisals'));
    }

    function apprisalSave(Request $request){
        Appraisal::create([
            'user_id' => $request->user_id,
            'date' => Carbon::parse($request->date)->toDateString(),
            'next_date' => Carbon::parse($request->next_date)->toDateString(),
            'salary' => $request->salary,
            'remark' => $request->remark
        ]);
        return redirect()->back()->with('success','Apprisal create successfully');
    }


    function loans($id){
        $employee = Employee::find($id);
        $loan = Loan::where('user_id',$employee->user_id);
        $loans = $loan->get();
        $total_loan_amount = $loan->sum('loan_amount');
        return view('admin.employees.accounts.loans',compact('employee','loans','total_loan_amount'));
    }

    function salaries($id){
        $employee = Employee::find($id);
        $start_date = Carbon::create($employee->date_of_join);
        $current_date = Carbon::now();
        $months = collect([]);
        
        while ($start_date <= $current_date) {
            $months->push([
                'month_name' => $start_date->format('F Y'),
                'month' => $start_date->format('Y-m-d'),
            ]);
            $start_date->addMonth();
        }
        
        $months = $months->reverse();
        // Paginate the $months array
        $perPage = 10; // You can set the number of items per page
        $currentPage = Paginator::resolveCurrentPage('page');
        $currentPageItems = $months->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $salaries = new \Illuminate\Pagination\LengthAwarePaginator($currentPageItems, count($months), $perPage);
        // Include the full URL in pagination links
        $salaries->withPath(url()->current());
        $data = [];
        foreach($salaries as $key=>$val){
            $firstDayOfMonth = Carbon::parse($val['month'])->firstOfMonth();
            $appraisal = Appraisal::where('user_id',$employee->user_id)->whereDate('date', '<=', $firstDayOfMonth)->first();
            $sum = Emi::Where('user_id',$employee->user_id)->whereDate('emi_date',$firstDayOfMonth)->sum('emi');
            $val['salary'] = isset($appraisal->salary) ? $appraisal->salary : $employee->salary;
            $val['emi'] = $sum;
            $val['total_amount_tp_pay'] = $val['salary'] - $sum;

            $deduction = [];
            if($val['emi'] > 0){
                $deduction['Emi'] = $val['emi'];
            }
            

            $val['deduction'] = $deduction;
            $val['total_deduction'] = $sum;
            $data[] = $val;
        }
        return view('admin.employees.accounts.salaries', compact('employee', 'salaries','data'));
    }


}
