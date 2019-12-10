<?php

namespace App\Http\Controllers;

use App\Building;
use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
//    public function homePage()
//    {
//        return view('admin.home.index');
//    }
    public function index(User $user, Building $building, Contact $contact)
    {
        $usersCount = User::all()->count();
        $contactCount = $contact->count();
        $mapping = $building->select('latitude', 'longitude', 'name')->get();
        $chart = $building->select(DB::raw('COUNT(*) as counting , month '))->where('year', date('Y'))->groupBy('month')->orderBy('month', 'asc')->get();
        $latestUsers = $user->take('7')->orderBy('id', 'desc')->get();
        $latestBuildings = $building->take('8')->orderBy('id', 'desc')->get();
        $contacts = $contact->take('7')->orderBy('id', 'desc')->get();
        return view('admin.home.index', compact('usersCount', 'contactCount', 'mapping', 'chart', 'latestUsers', 'latestBuildings', 'contacts'));
    }

    public function showYearStatistics(Building $building)
    {
        $year = date('Y');
        $chart = $building->select(DB::raw('COUNT(*) as counting , month '))->where('year', $year)->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
        $arr = [];
        if(isset($chart[0]['month'])) {
            for ($i = 1; $i < $chart[0]['month'];$i++){
                $arr[] = 0;
            }
        }
        $new = array_merge($arr, $chart);
//        dd($new);
        return view('admin.home.statistics', compact('year', 'new'));
    }

    public function showThisYear(Request $request, Building $building)
    {
        $year = $request->year;
        $chart = $building->select(DB::raw('COUNT(*) as counting , month '))->where('year', $year)->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
        $arr = [];
        if(isset($chart[0]['month'])) {
            for ($i = 1; $i < $chart[0]['month'];$i++){
                $arr[] = 0;
            }
        }
        $new = array_merge($arr, $chart);
        return view('admin.home.statistics', compact('year', 'new'));
    }
}
