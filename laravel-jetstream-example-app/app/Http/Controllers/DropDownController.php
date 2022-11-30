<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class DropDownController extends Controller
{
    //

     public function index()
    {
        $counteries = Country::get(['name','id']);
 
        return view('dropdown',compact('counteries'));
    }
 
    public function fatchState(Request $request)
    {
        $data['states'] = State::where('country_id',$request->country_id)->get(['name','id']);
 
        return response()->json($data);
    }
 
    public function fatchCity(Request $request)
    {
        $data['cities'] = City::where('state_id',$request->state_id)->get(['name','id']);
 
        return response()->json($data);
    }

        public function getRole()
    {
        //return Input::get('team');
    }
}
