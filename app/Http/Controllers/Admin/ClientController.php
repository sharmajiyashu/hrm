<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $clients = Client::select('users.first_name as first_name','clients.*')
        ->when($query_search, function ($query) use ($query_search) {
                $query->where('clients.gst_number', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.mobile', 'like', '%' . $query_search . '%')
                ->orWhere('users.email', 'like', '%' . $query_search . '%')
                ->orWhere('clients.company_name', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'clients.user_id', '=', 'users.id') // Join with the 'users' table
            ->paginate(10);
        if ($request->ajax()) {
            return view('admin.clients.pagination', compact('clients'))->render();
        }
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $employee = Client::create($request->validated());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make('123'),
            'password_2' => '123',
            'role' => 3
        ]);
        $employee->update(['user_id' => $user->id]);
        return redirect()->route('admin.clients.index')->with('success','Client create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }


    function invoices($id ,Request $request){
        $client = Client::find($id);
        $page = isset($request->page) ? $request->page : 1;
        $invoices = Invoice::orderBy('id','desc')->paginate(10, ['*'], 'page', $page);
        return view('admin.clients.accounts.invoices',compact('client','invoices'));
    }


}
