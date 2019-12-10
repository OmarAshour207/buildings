<?php

namespace App\Http\Controllers\User;

use App\Building;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BuildingController extends Controller
{
    public function showAllBuildings(Building $building)
    {
        $buildings = $building->where('status', 1)->latest()->paginate(12);
//        dd($buildings);
        return view('website.all_buildings', compact('buildings'));
    }

    public function showRent(Building $building)
    {
        $buildings = $building->where('status', 1)->where('rent', 2)->orderBy('id', 'desc')->paginate(12);
        return view('website.all_buildings', compact('buildings'));
    }

    public function showBuy(Building $building)
    {
        $buildings = $building->where('status', 1)->where('rent', 1)->orderBy('id', 'desc')->paginate(12);
        return view('website.all_buildings', compact('buildings'));
    }

    public function showType($type, Building $building)
    {
        if(in_array($type , ['0', '1', '2'])){
            $buildings = $building->where('status', 1)->where('type', $type)->orderBy('id', 'desc')->paginate(12);
            return view('website.all_buildings', compact('buildings'));
        } else {
            return redirect()->back();
        }
    }

    public function showSearch(Request $request, Building $building)
    {
        $requestAll = $request->except('_token');
        $result = '';
        $i = 0;
        foreach ($requestAll as $key => $req) {
            if($req != '') {
                $where = $i == 0 ? " WHERE " : " AND ";
                $result .= $where . ' ' . $key . ' = ' . $req;
                $i = 2;
            }
        }
        $query = "SELECT * FROM buildings " . $result;
        $buildings = DB::select($query);
        $search = 'search';
        return view('website.all_buildings', compact('buildings', 'search'));
    }

    public function showAdvancedSearch(Request $request, Building $building)
    {
        $min = $request->price_from == '' ? '50' : $request->price_from;
        $max = $request->price_to == '' ? '1000000' : $request->price_to;

        $requestAll = $request->except('_token', 'page');

        $query = DB::table('buildings')->select('*');
        $array = [];

        foreach ($requestAll as $key => $req) {
            if($req != '') {
                if($key == 'price_from' || $key == 'price_to') {
                    $query->whereBetween('price', [$min, $max])->get();
                }  else {
                    $query->where($key, $req);
                }
                // this array for breedcrump
                $array[$key] = $req;
            }
        }
        $buildings = $query->paginate(2);

        return view('website.all_buildings', compact(['buildings', 'array']) );
    }

    public function showSingleBuilding($id)
    {
        $building = Building::findOrFail($id);
        if($building->status == 0) {
            return view('website.files.noPermission', compact('building'));
        }
        $sameRent = $this->sameBuildings($building, 'rent', $building->rent);
        $sameType = $this->sameBuildings($building, 'type', $building->type);
        return view('website.building', compact('building', 'sameRent', 'sameType'));
    }

    public function sameBuildings(Building $building, $sameType, $sameTypeInfo)
    {
        return $building->where($sameType, $sameTypeInfo)->orderBy(DB::raw('RAND()'))->take(3)->get();
    }

    public function showContact()
    {
        return view('website.contact.contact');
    }

    public function showEditBuilding(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $building = Building::findOrFail($id);

        if($user_id != $building->user_id || $building->status == 1) {
            return view('website.files.cannotedit', compact('building'));
        }
        return view('website.user_buildings.edit', compact('building'));
    }

    public function editUnprovedBuilding(Request $request, Building $building)
    {
//        dd($request->id);
        $building_info = $building->find($request->id);

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

        $requested_data = $request->except('image');
        $requested_data['description']  = strip_tags(str_limit($requested_data['content'], 160));

        if($request->image) {
            if($request->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/buildings_images/' . $building_info->image);
            }
            Image::make($request->image)->resize(300, null,  function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/buildings_images/' . $request->image->hashName()));

            $requested_data['image'] = $request->image->hashName();
        }
        $requested_data['month'] = date('m');
        $requested_data['year'] = date('Y');
        $building_info->update($requested_data);
        session()->flash('success', 'تم تعديل العقار بنجاح');
        return redirect()->back();
    }
}
