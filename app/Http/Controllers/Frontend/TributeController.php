<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TributeController extends Controller
{
    
    public function index()
    {
        return view('frontend.tribute');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input('formData'), [
            'name' => 'required|string',
            'title' => 'required|string',
            'tribute_content' => 'nullable|string',
        ]);

        $data = $validator->validated();

        try {
            DB::beginTransaction();

            $tribute = Tribute::create([
                'name' => $data['name'],
                'title' => $data['title'],
                'tribute_content' => $data['tribute_content'],
            ]);

            if (!$tribute) {
                throw new \Exception("Failed to create Tribute.");
            }

            return response()->json(['status' => 'success', 'message' => 'Tribute created successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
