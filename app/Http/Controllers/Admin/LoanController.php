<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Emi;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = isset($request->page) ? $request->page : 1;
        $loans = Loan::orderBy('id','desc')->paginate(10, ['*'], 'page', $page);
        return view('admin.loans.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::latest()->get();
        return view('admin.loans.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = self::getInterestAndPrinciple($request->loan_amount,$request->rate_of_interest,$request->tenure);
            $loan = Loan::create([
                'user_id' => $request->user_id,
                'loan_amount' => $request->loan_amount,
                'tenure' => $request->tenure,
                'emi' => $data['emi'],
                'interest_amount' => $data['total_interest_amount'],
                'total_amount_paid' => $data['total_amount_paid'],
                'rate_of_interest' => $data['rate_of_interest'],
                'start_emi' => Carbon::parse($request->emi_start)->toDateString(),
            ]);
            $emi_data = self::showCalculation($request->loan_amount,$request->rate_of_interest,$request->emi_start,$request->tenure,$data['emi']);
            $loan_id = $loan->id;
            $emi_no = 1;
            foreach($emi_data as $key=>$value){
                $loan = Emi::updateOrCreate(['loan_id' => $loan_id ,'emi_number' => $emi_no],[
                    'loan_id' => $loan_id,
                    'user_id' => $request->user_id,
                    'emi' => $value['emi'],
                    'emi_number' => $emi_no,
                    'interest' => $value['interest'],
                    'principal' => $value['principal'],
                    'emi_date' => Carbon::parse($value['payement_date'])->toDateString(),
                    'due_amount' => $value['emi'],
                ]);
                $emi_no ++;
            }
            DB::commit();
            return redirect()->back()->with('success','Loan create successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['error' =>  $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        $employee = Employee::where('user_id',$loan->user_id)->first();
        $emis = Emi::where('loan_id',$loan->id)->get();
        return view('admin.loans.show',compact('loan','emis','employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }


     function getInterestAndPrinciple($principal,$rate_of_interest,$tenure){
        $principal = $principal;  // Replace with your loan amount
        $annual_interest_rate = $rate_of_interest;  // Replace with your annual interest rate
        $loan_tenure_years = $tenure;  // Replace with your loan tenure in years
    
        // Convert annual interest rate to monthly interest rate
        $monthly_interest_rate = ($annual_interest_rate / 12) / 100;
    
        // Convert loan tenure to months
        $loan_tenure_months = $loan_tenure_years ;
    
        // Calculate EMI using the formula
        if($monthly_interest_rate != 0){
            $emi = ($principal * $monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_tenure_months)) / (pow(1 + $monthly_interest_rate, $loan_tenure_months) - 1);
        }else{
            $emi = $principal / $loan_tenure_months;
        }
    
        // Calculate total interest paid
        $total_interest_paid = $emi * $loan_tenure_months - $principal;
    
        // Calculate total amount paid
        $total_amount_paid = $emi * $loan_tenure_months;
    
    
        return [
            'loan_amount' => round($principal),
            'rate_of_interest' => $annual_interest_rate,
            'tenure' => $loan_tenure_years,
            'emi' => round($emi),
            'total_interest_amount' => round($total_interest_paid),
            'total_amount_paid' => round($total_amount_paid),
        ];

      }


    public static function showCalculation($balance, $interest_rate, $payment_date, $tenure, $emi)
    { 
        $data = [];
        for ($i = 1; $i <= $tenure; $i++) {
            $interest = 0;
            if (is_numeric($interest_rate) && is_numeric($balance)) {
                $interest = (($interest_rate / 100) * $balance) / 12;

            }
            // $interest = (is_numeric($interest_rate / 100 ) * is_numeric($balance))/12;
            $principal = $emi - $interest;
            $balance = $balance - $principal;
            if ($i != 1) {
                $payment_date = date('Y-m-d', strtotime("+1 month", strtotime($payment_date)));
            }
            $principal2 = round($principal, 2);
            $interest2 = round($interest, 2);
            $data[] = ['payement_date' => $payment_date, 'interest' => round($interest2), 'principal' => round($principal2), 'emi' => round($emi)];
            $this_month_date = date('Y-m');
            $emi_month_date = date('Y-m', strtotime($payment_date));
        }
        return $data;
    }


}
