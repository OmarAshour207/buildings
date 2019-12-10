<?php

namespace App\Http\Controllers\User;

use App\Building;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['index']);
    }

    public function index()
    {
        $user_id =  Auth::user()->id ?  Auth::user()->id : 0;
        $buildings = Building::where('user_id', $user_id)->where('status', 1)->paginate(9);
        return view('website.user_buildings.index', compact('buildings'));
    }

    public function showUnprovedBuildings()
    {
        $user_id =  Auth::user()->id ?  Auth::user()->id : 0;
        $buildings = Building::where('user_id', $user_id)->where('status', 0)->paginate(9);
        return view('website.user_buildings.index', compact('buildings'));
    }

    public function create()
    {
        return view('website.user_buildings.add');
    }

    public function store(Request $request)
    {
        $requested_data = $request->except('image', '_token', '_method');

        $request->validate([
            'name'          => 'required|min:5|max:100|string',
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
            'image'         => 'sometimes|nullable|image',
        ]);

        if($request->image) {
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/buildings_images/' . $request->image->hashName()));

            $requested_data['image'] = $request->image->hashName();
        }
        $requested_data['user_id']  = Auth::user()->id ?: 0;
        $requested_data['description']  = strip_tags(str_limit($requested_data['content'], 160));
//        dd($requested_data);
        $requested_data['month'] = date('m');
        $requested_data['year'] = date('Y');
        Building::create($requested_data);
        session()->flash('success', 'تم اضافه العقار بنجاح');
        return redirect()->route('home');
    }


}
