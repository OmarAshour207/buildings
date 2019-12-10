<?php

namespace App\Http\Controllers;

use App\Building;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        $users = User::all();
        return view('admin.users.index', compact('id'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'image'     => 'sometimes|nullable|image',
            'password'  => 'required|confirmed',
        ]);

        $requested_data = $request->except('password', 'password_confirmation', 'image');
        $requested_data['password'] = bcrypt($request->password);

        if($request->image) {
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $requested_data['image'] = $request->image->hashName();
        }

        User::create($requested_data);
        session()->flash('success', 'تم أضافه العضو بنجاح');
        return redirect()->route('users.index');

    }

    public function edit(User $user, Building $building)
    {
        $unapprovedBuildings = $building->where('user_id', $user->id)->where('status', 0)->paginate(10);
        $approvedBuildings = $building->where('user_id', $user->id)->where('status', 1)->paginate(10);
        return view('admin.users.edit', compact('user', 'unapprovedBuildings', 'approvedBuildings'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => ['required', Rule::unique('users')->ignore($user->id)],
            'image'     => 'nullable|image',
        ]);

        $request_data = $request->except('image');

        if($request->image) {
            if($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user_images/'. $user->image);
            }
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);
        session()->flash('success', 'تم تعديل بيانات العضو بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        if($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/user_images/'. $user->image);
        }
        $user->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('users.index');
    }

    public function anyData(Request $request, User $user)
    {
        if ($request->user_id){
            $users = $user->where('user_id', $request->user_id)->get();
        }else {
            $users = $user->all();
        }
        return DataTables::of($users)
            ->editColumn('image', function ($model){
                return '<img src="' .$model->image_path. '" alt="صوره المستخدم"  style="width: 100px;" class="img-thumbnail">';
            })
            ->editColumn('action', function ($model){

              $all = '<a href= "' . url('/adminpanel/users/' . $model->id . '/edit/') . '" class="btn btn-info btn-circle" > <i class="fa fa-edit"></i> </a>';

              $all .=
                  '<form action="' .route('users.destroy', $model->id) .' " method="post" style="display: inline-block">
                                                    '.  csrf_field() .'  
                                                    '. method_field('delete') .'
                                                    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>
                                                        
                                                    </button>
                                                </form>';

              return $all;
            })->editColumn('myBuildings', function ($model) {
                return '<a href= "' . url('/adminpanel/buildings/'. $model->id ) . '" class="btn btn-info btn-circle" > <i class="fa fa-edit"></i> </a>';

            })->make(true);
    }

}
