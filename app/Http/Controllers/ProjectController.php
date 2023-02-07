<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Builder $builder) {
        if (request()->ajax()) {
            return $project=DataTables::of(Project::query())
            ->addColumn('action',function($project){
                $status_html = "";
                if($project->complete_status == 0) {
                    $status_html = "<a class='dropdown-item has-icon' href='javascript:void(0)' id='status_btn_". $project->id ."' onclick=changeStatus('start','$project->id')><i class='fas fa-play'></i>Start Project</a>";
                } else if($project->complete_status == 1) {
                    $status_html = "<a class='dropdown-item has-icon' href='javascript:void(0)' id='status_btn_". $project->id ."' onclick=changeStatus('end','$project->id')><i class='fas fa-check-square'></i>Mark as Complete</a>";
                } else {
                    $status_html = "<a class='dropdown-item has-icon' href='javascript:void(0)' id='status_btn_". $project->id ."' onclick=changeStatus('reopen','$project->id')><i class='fas fa-undo'></i>Re-open Project</a>";
                }

                return '<div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="'. route('project.edit', ['id'=> $project->id]) .'"><i class="fas fa-edit"></i>Edit</a>
                        <a class="dropdown-item has-icon" href="javascript:void(0)" id="del_' . $project->id . '" onclick=deleteProject('.$project->id.')><i class="fas fa-trash"></i>Delete</a>
                        '. $status_html .'
                    </div>
                </div>';
            })
            ->editColumn('s_id',function($project){
                $staff_ids = json_decode($project->s_id);
                $staff_html = "";
                foreach ($staff_ids as $id) {
                    $staff = User::where('id', $id)->first();
                    $staff_html = $staff_html . '<img alt="image" src="'. asset($staff->profile_pic) .'" class="rounded-circle" width="35" data-toggle="tooltip" title="'. $staff->name .'">';
                }
                return $staff_html;
            })
            ->editColumn('c_id',function($project){
                $client = User::where('id', $project->c_id)->first();
                return '<img alt="image" src="'. asset($client->profile_pic) .'" class="rounded-circle" width="35" data-toggle="tooltip" title="'. $client->name .'">';
            })
            ->editColumn('complete_status', function($project) {
                $btnClass="";
                $btnStatus="";
                if($project->complete_status == 0) {
                    $btnClass="badge-info";
                    $btnStatus="Not Started";
                } else if($project->complete_status == 1) {
                    $btnClass="badge-warning";
                    $btnStatus="In Progress";
                } else {
                    $btnClass="badge-success";
                    $btnStatus="Completed";
                }
                return '<div id="status_'. $project->id .'" class="badge '. $btnClass .'">'. $btnStatus .'</div>';
            })
            ->setRowId(function($project){
                return $project->id;
            })
            ->addIndexColumn()
            ->rawColumns(['action','s_id', 'c_id', 'complete_status'])->tojson();
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'id','title'=>'#','searchable' => false],
            ['data' => 'title', 'name' => 'title','title'=>'Project Name','searchable' => true],
            ['data' => 's_id', 'name' => 's_id','title'=>'Assign Team','searchable' => true],
            ['data' => 'c_id', 'name' => 'c_id','title'=>'Assign Team','searchable' => true],
            ['data' => 'start_date', 'name' => 'start_date','title'=>'Deadline','searchable' => true],
            ['data' => 'end_date', 'name' => 'end_date','title'=>'Deadline','searchable' => true],
            ['data' => 'complete_status', 'name' => 'complete_status','title'=>'Status','searchable' => true],
            ['data'=>'action','name'=>'action','title'=>'Action','searchable' => false],
        ])->parameters([
            
        ]);
        return view('project.index',compact('html'));
    }

    public function create() {
        $clients = User::where('role_id', 3)->get();
        $staffs = User::where('role_id', 2)->get();
        return view('project.create', ['clients'=>$clients, 'staffs' => $staffs]);
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'budget' => 'required',
                'client' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'staff' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $project = new Project();
            $project->title = $request->title;
            $project->description = $request->description;
            $project->budget = $request->budget;
            $project->c_id = $request->client;
            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->s_id = json_encode($request->staff);

            $project->save();

            $notification = array(
                'message' => 'Project added successfully!',
                'alert-type' => 'success'
            );

            return Redirect::to('/project')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' => 'Sorry can`t add Project!',
                'alert-type' => 'error'
            );

            return Redirect::to('/project')->with($notification);
        }
    }

    public function edit($id) {
        $project = Project::where('id', $id)->first();
        $clients = User::where('role_id', 3)->get();
        $staffs = User::where('role_id', 2)->get();
        return view('project.edit', ['project'=>$project, 'clients'=>$clients, 'staffs' => $staffs]);
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'budget' => 'required',
                'client' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'staff' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $params = [];
            $params['title'] = $request->title;
            $params['description'] = $request->description;
            $params['budget'] = $request->budget;
            $params['c_id'] = $request->client;
            $params['s_id'] = json_encode($request->staff);
            $params['start_date'] = $request->start_date;
            $params['end_date'] = $request->end_date;

            Project::whereId($id)->update($params);

            $notification = array(
                'message' => 'Project updated successfully!',
                'alert-type' => 'success'
            );

            return Redirect::to('/project')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' => 'Sorry can`t update project!',
                'alert-type' => 'error'
            );

            return Redirect::to('/project')->with($notification);
        }
    }

    public function delete(Request $request) {
        try {
            Project::where('id', '=', $request->id)->delete();

            return response()->json('success');

        } catch (\Throwable $th) {

            return response()->json('error');
        }
    }

    public function changeStatus(Request $request) {
        try {
            $params = [];
            if($request->status == 'start') {
                $params['complete_status'] = 1;
            } else if($request->status == 'end') {
                $params['complete_status'] = 2; 
            } else {
                $params['complete_status'] = 1;
            }

            Project::whereId($request->id)->update($params);

            return response()->json('success');

        } catch (\Throwable $th) {

            return response()->json('error');
        }
    }
}
