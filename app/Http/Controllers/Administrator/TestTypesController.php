<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestTypesController extends Controller
{
    public function getTestTypes()
    {
        $testTypes = TestType::orderBy('id', 'desc')->get();
        return view('administrator.testTypes', compact('testTypes'));
    }

    public function addTestType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:test_types'],
            'description' => ['required'],
            'price' => ['required', 'numeric','min:0'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $testType = new TestType();
        $testType->name = $request->input('name');
        $testType->description = $request->input('description');
        $testType->price = $request->input('price');
        $testType->save();

        return redirect()->route('administrator.testTypes')->with('success', 'Test Type added successfully.');
    }

    public function viewTestType($id)
    {
        $testType = TestType::findOrFail($id);
        $testTypes = TestType::orderBy('id', 'desc')->get();
        return view('administrator.testTypes', compact('testType', 'testTypes'));
    }

    public function updateTestType(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:test_types,name,' . $id],
            'description' => ['required'],
            'price' => ['required', 'numeric','min:0'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $testType = TestType::findOrFail($id);
        $testType->name = $request->input('name');
        $testType->description = $request->input('description');
        $testType->price = $request->input('price');
        $testType->save();

        return redirect()->route('administrator.testTypes')->with('success', 'Test type updated successfully.');
    }
}
