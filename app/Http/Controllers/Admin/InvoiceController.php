<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Client;
use App\Models\InvoiceMap;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $invoices = Invoice::orderBy('invoices.id', 'desc')->select('invoices.*','users.first_name','users.last_name','users.email')
            ->when($query_search, function ($query) use ($query_search) {
                $query->where('invoices.sub_total', 'like', '%' . $query_search . '%')
                ->orWhere('invoices.tax', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.mobile', 'like', '%' . $query_search . '%')
                ->orWhere('users.email', 'like', '%' . $query_search . '%')
                ->orWhere('invoices.due_amount', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'invoices.user_id', '=', 'users.id') // Join with the 'users' table
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.invoices.pagination', compact('invoices'))->render();
        }
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = isset($request->user_id)  ? $request->user_id :'';
        $projects = Project::orderBy('name','asc');
        if(!empty($user_id)){
            $projects->where('client',$user_id);
        }
        $projects = $projects->get();
        $clients = Client::get();
        return view('admin.invoices.create',compact('projects','clients','user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        // print_r($request->all());die;

        $sub_total = 0;
        for($i = 1 ; $i <= $request->total_tasks ; $i++){
            $quantity = 'quantity_'.$i;
            $quantity = $request->$quantity;
            $sub_total += $quantity;
        }
        $tax_amount = $sub_total * $request->tax_rate / 100;
        $total = $tax_amount + $sub_total;
        $due_amount = $total - $request->paid_amount;
        $invoice = Invoice::create([
            'project_id' =>  $request->project_id,
            'user_id' => $request->user_id,
            'sub_total' => $sub_total,
            'tax' => $tax_amount,
            'tax_rate' => $request->tax_rate,
            'total' => $total,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $due_amount,
            'due_date' => $request->due_date,
            'created_at' => $request->date
        ]);
        for($i = 1 ; $i <= $request->total_tasks ; $i++){
            $task_id = 'task_'.$i;
            $task_id = $request->$task_id;

            $quantity = 'quantity_'.$i;
            $quantity = $request->$quantity;

            $description = 'description_'.$i;
            $description = $request->$description;

            InvoiceMap::create([
                'invoice_id' => $invoice->id,
                'task' => $task_id,
                'cost' => $quantity,
                'description' => $description
            ]);
        }

        return redirect()->route('admin.invoices.index')->with('success','Invoice create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        
        $user = User::find($invoice->user_id);
        $client = Client::where('user_id',$invoice->user_id)->first();
        $invoice_maps = InvoiceMap::where('invoice_id',$invoice->id)->get();
        return view('admin.invoices.show',compact('user','client','invoice_maps','invoice'));
    }

    public function print($id)
    {
        $invoice = Invoice::find($id);
        $user = User::find($invoice->user_id);
        $client = Client::where('user_id',$invoice->user_id)->first();
        $invoice_maps = InvoiceMap::where('invoice_id',$invoice->id)->get();
        return view('admin.invoices.print',compact('user','client','invoice_maps','invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
