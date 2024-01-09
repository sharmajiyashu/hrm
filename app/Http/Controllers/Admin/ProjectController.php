<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Employee;
use App\Models\ManagerMap;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $projects = Project::orderBy('projects.id', 'desc')->select('projects.*','users.first_name as client_first_name','users.last_name as client_last_name')
            ->when($query_search, function ($query) use ($query_search) {
                $query->whereDate('projects.start_date', 'like', '%' . $query_search . '%') 
                ->orWhereDate('projects.end_date', 'like', '%' . $query_search . '%')
                ->orWhere('projects.name', 'like', '%' . $query_search . '%')
                ->orWhere('projects.client', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('projects.category', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'projects.client', '=', 'users.id') // Join with the 'users' table
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.projects.pagination', compact('projects'))->render();
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();
        $employees = Employee::get();
        return view('admin.projects.create',compact('clients','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        if(!empty($request->manager)){
            foreach($request->manager as $manager_id){
                ManagerMap::create([
                    'user_id' => $manager_id,
                    'project_id' => $project->id,
                    'type' => ManagerMap::$manager
                ]);
            }
        }
        if(!empty($request->team)){
            foreach($request->manager as $team_id){
                ManagerMap::create([
                    'user_id' => $team_id,
                    'project_id' => $project->id,
                    'type' => ManagerMap::$team
                ]);
            }
        }
        return redirect()->route('admin.projects.index')->with('success','Project create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::get();
        $employees = Employee::get();
        $project_team = ManagerMap::where('type',ManagerMap::$team)->get()->toArray();
        return view('admin.projects.edit',compact('project','clients','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back()->with('success','Project delete successfully');
    }
}
