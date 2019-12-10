<?php

namespace App\Http\Controllers;

use App\Building;
use App\User;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BuildingController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id !== null ? '?user_id='. $request->id : null ;
        return view('admin.buildings.index', compact('id'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.buildings.create', compact('users'));
    }

    public function store(Request $request)
    {
        $requested_data = $request->except('image');

        $request->validate([
            'name'          => 'required|min:5|max:100|string',
            'description'   => 'required|string|max:160',
            'type'          => 'sometimes|nullable|numeric',
            'square'        => 'required|numeric|min:1',
            'rent'          => 'required|numeric',
            'rooms'         => 'required|numeric|min:1',
            'price'         => 'required|numeric',
            'meta'          => 'required|string|min:5|max:200',
            'content'       => 'required|string|min:5',
            'latitude'      => 'sometimes|nullable|numeric',
            'longitude'     => 'sometimes|nullable|numeric',
            'place'         => 'required|numeric',
            'status'        => 'required|numeric',
            'image'         => 'sometimes|nullable|image',
            'user_id'       => 'sometimes|nullable|numeric',
        ]);

        if($request->image) {
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/buildings_images/' . $request->image->hashName()));

            $requested_data['image'] = $request->image->hashName();
        }
        $requested_data['month'] = date('m');
        $requested_data['year'] = date('Y');
        Building::create($requested_data);
        session()->flash('success', 'تم اضافه العقار بنجاح');
        return redirect()->route('buildings.index');
    }

    public function edit(Building $building, User $user)
    {
        $users = User::all();
        if($building->user_id == 0) {
            $ownerUser = '';
        } else {
            $ownerUser = $user->where('id', $building->user_id)->get()[0];
        }
        return view('admin.buildings.edit', compact('building', 'users', 'ownerUser'));
    }

    public function update(Request $request, Building $building)
    {
        $request->validate([
            'name'          => 'required|min:5|max:100|string',
            'description'   => 'required|string|max:160',
            'type'          => 'sometimes|nullable|numeric',
            'square'        => 'required|numeric|min:1',
            'rent'          => 'required|numeric',
            'rooms'         => 'required|numeric|min:1',
            'price'         => 'required|numeric',
            'meta'          => 'required|string|min:5|max:200',
            'content'       => 'required|string|min:5',
            'latitude'      => 'sometimes|nullable|numeric',
            'longitude'     => 'sometimes|nullable|numeric',
            'place'         => 'required|numeric',
            'status'        => 'required|numeric',
            'image'         => 'sometimes|nullable|image',
            'user_id'       => 'sometimes|nullable|numeric',
        ]);

        $requested_data = $request->except('image');

        if($request->image) {
            if($request->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/buildings_images/' . $request->image);
            }
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/buildings_images/' . $request->image->hashName()));

            $requested_data['image'] = $request->image->hashName();
        }
        $requested_data['month'] = date('m');
        $building->update($requested_data);
        session()->flash('success', 'تم التعديل العقار بنجاح');
        return redirect()->route('buildings.index');
    }

    public function destroy(Building $building)
    {
        if($building->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/buildings_images/' . $building->image);
        }
        $building->delete();
        session()->flash('success', 'تم حذف العقار بنجاح');
        return redirect()->route('buildings.index');
    }

    public function anyData(Request $request, Building $building)
    {
        if ($request->user_id){
            $users = $building->where('user_id', $request->user_id)->get();
        } else {
            $users = $building->all();
        }
        return DataTables::of($users)
            ->editColumn('type', function ($model){
                $types = building_type();
                return '<button class="btn btn-primary btn-sm">' . $types[$model->type] . '</button>';
            })
            ->editColumn('status', function ($model) {
                if($model->status == 1) {
                    return '<button class="btn btn-primary btn-sm"> مفعل </button>';
                } elseif ($model->status == 2) {
                    return '<button class="btn btn-info btn-sm"> في انتظار التفعيل </button>';
                }
                return '<button class="btn btn-danger btn-sm"> غير مفعل </button>';
            })
            ->editColumn('action', function ($model){

                $all = '<a href= "' . url('adminpanel/buildings/'. $model->id .'/edit') . '" class="btn btn-info btn-circle" > <i class="fa fa-edit"></i> </a>';

                $all .=
                    '<form action="' .route('buildings.destroy', $model->id) .' " method="post" style="display: inline-block">
                        '.  csrf_field() .'  
                        '. method_field('delete') .'
                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>                            
                        </button>
                    </form>';

                return $all;
            })->make(true);
    }

    public function updateStatusValue($id, $status, Building $building)
    {
        $buildingUpdate = $building->find($id);
        $buildingUpdate->fill(['status' => $status])->save();
        session()->flash('success', 'تم تفعيل المنتج بنجاح');
        return redirect()->back();
    }


}
