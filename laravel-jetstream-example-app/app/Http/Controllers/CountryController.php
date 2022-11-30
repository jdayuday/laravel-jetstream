<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $countries = Country::all();
        return view('country',compact('countries'));
    }
}
