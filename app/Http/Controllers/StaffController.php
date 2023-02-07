<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(Builder $builder) {
        if (request()->ajax()) {
            return $user=DataTables::of(User::where('role_id', 2)->get())
            ->editColumn('name', function($user) {
                return $user->title . ' ' . $user->name;
            })
            ->addColumn('action',function($user){
                return '<a href="'. route('staff.edit',['id'=> $user->id]) .'" class="btn btn-icon btn-primary">Edit</a>
                <a href="javascript:void(0)" id="del_' . $user->id . '" onclick=deleteuser('.$user->id.') class="btn btn-icon btn-danger">Delete</a>';
            })
            ->editColumn('profile_pic',function($user){
                return '<img alt="image" src="'. asset($user->profile_pic) .'" class="rounded-circle" width="35" data-toggle="tooltip" title="'. $user->name .'">';
            })
            ->setRowId(function($user){
                return $user->id;
            })
            ->addIndexColumn()
            ->rawColumns(['action','profile_pic'])->tojson();
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'id','title'=>'#','searchable' => false],
            ['data' => 'name', 'name' => 'name','title'=>'Name','searchable' => true],
            ['data' => 'email', 'name' => 'email','title'=>'Email','searchable' => true],
            ['data' => 'phone', 'name' => 'phone','title'=>'Phone','searchable' => true],
            ['data' => 'city', 'name' => 'city','title'=>'City','searchable' => true],
            ['data' => 'profile_pic', 'name' => 'profile_pic','title'=>'Profile','searchable' => false],
            ['data'=>'action','name'=>'action','title'=>'Action','searchable' => false],
        ])->parameters([
            
        ]);
        return view('staff.index',compact('html'));
    }

    public function create() {
        return view('staff.create');
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phone' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'postcode' => 'required',
                'profile' => 'mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->name = $request->name;
            $user->title = $request->title;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->postcode = $request->postcode;
            $user->role_id = 2;
            $user->password = bcrypt($request->password);

            if ($request->hasFile('profile')) {
                $random = Str::random(5);
                $image = substr(($request->input('name')), 0, 10) . $random . '_images_.' . $request->profile->getClientOriginalExtension();

                $request->profile->move(public_path('uploads/profile/'), $image);
                $photo = 'uploads/profile/' . $image;

                $user->profile_pic = $photo;
            }

            $user->save();

            $notification = array(
                'message' => 'staff added successfully!',
                'alert-type' => 'success'
            );

            return Redirect::to('/staff')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' => 'Sorry can`t add staff!',
                'alert-type' => 'error'
            );

            return Redirect::to('/staff')->with($notification);
        }
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        return view('staff.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'postcode' => 'required',
                'profile' => 'mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $params = [];
            $params['name'] = $request->name;
            $params['title'] = $request->title;
            $params['email'] = $request->email;
            $params['phone'] = $request->phone;
            $params['city'] = $request->city;
            $params['state'] = $request->state;
            $params['country'] = $request->country;
            $params['postcode'] = $request->postcode;
            
            if($request->has('password')) {
                $params['password'] = bcrypt($request->password);
            }

            if ($request->hasFile('profile')) {
                $random = Str::random(5);
                $image = substr(($request->input('name')), 0, 10) . $random . '_images_.' . $request->profile->getClientOriginalExtension();

                $request->profile->move(public_path('uploads/profile/'), $image);
                $photo = 'uploads/profile/' . $image;

                if ($request->input('old_profile')) {
                    $path = public_path($request->old_profile);
                    $isExists = File::exists($path);
                    if($isExists)
                    {
                        unlink(public_path($request->old_profile));
                    }
                }

                $params['profile_pic'] = $photo;
            }

            User::whereId($id)->update($params);

            $notification = array(
                'message' => 'Staff updated successfully!',
                'alert-type' => 'success'
            );

            return Redirect::to('/staff')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' => 'Sorry can`t update staff!',
                'alert-type' => 'error'
            );

            return Redirect::to('/staff')->with($notification);
        }
    }

    public function trash() {

    }

    public function removeTrash() {

    }

    public function delete(Request $request) {
        try {
            $user = User::whereId($request->id)->first();

            $path = public_path($user->profile_pic);
            $isExists = File::exists($path);
            if($isExists)
            {
                unlink(public_path($user->profile_pic));
            }

            User::where('id', '=', $request->id)->delete();

            return response()->json('success');

        } catch (\Throwable $th) {

            return response()->json('error');
        }
    }
}
