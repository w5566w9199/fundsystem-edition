<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class SchoolController extends Controller
{
    public function create()
    {
        return Inertia::render('school/create');
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'academy' => ['required','string', 'max:255'],
            'department' => ['required','string', 'max:255', 'unique:school_table,department'],
            ])->validate();
        DB::table('school_table')->insert([
            'academy' =>$request['academy'],
            'department' =>$request['department'],
        ]);
        return Redirect::route('school.create');
    }
}
