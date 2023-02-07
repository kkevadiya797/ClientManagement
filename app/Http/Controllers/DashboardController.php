<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class DashboardController extends Controller
{
    public function index(Builder $builder) {

        $project_counts = [
            Project::where('complete_status', 0)->count(),
            Project::where('complete_status', 1)->count(),
            Project::where('complete_status', 2)->count()
        ];
        $client_counts = User::where('role_id', 3)->count();
        $staff_counts = User::where('role_id', 2)->count();

        if (request()->ajax()) {
            return $project=DataTables::of(Project::query())
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
            ->rawColumns(['s_id', 'c_id', 'complete_status'])->tojson();
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'id','title'=>'#','searchable' => false],
            ['data' => 'title', 'name' => 'title','title'=>'Project Name','searchable' => true],
            ['data' => 's_id', 'name' => 's_id','title'=>'Assign Team','searchable' => true],
            ['data' => 'c_id', 'name' => 'c_id','title'=>'Assign Team','searchable' => true],
            ['data' => 'start_date', 'name' => 'start_date','title'=>'Deadline','searchable' => true],
            ['data' => 'end_date', 'name' => 'end_date','title'=>'Deadline','searchable' => true],
            ['data' => 'complete_status', 'name' => 'complete_status','title'=>'Status','searchable' => true],
        ])->parameters([
            
        ]);
        
        return view('dashboard.index', ['project_counts'=>$project_counts, "client_counts"=>$client_counts, "staff_counts"=>$staff_counts, 'html'=>$html]);
    }
}
