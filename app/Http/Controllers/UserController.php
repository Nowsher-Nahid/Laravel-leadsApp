<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::query()->where('type', 1)->orderBy('first_name')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('full_name', function($row){
                        $full_name = $row->first_name.' '.$row->last_name;
                        return $full_name;
                    })
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
                                <a href="'.route('user.edit', $row->id).'" class="edit btn btn-primary btn-sm me-1"><i class="fas fa-edit"></i></a>
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['full_name','action'])
                    ->make(true);
        }
        return view('user-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true]);
    }
}
