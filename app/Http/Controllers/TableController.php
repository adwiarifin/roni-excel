<?php

namespace App\Http\Controllers;

use App\Models\Something;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    public function view()
    {
        return view('table');
    }

    public function data()
    {
        $columns = [
            'id',
            'level1',
            'level2',
            'level3',
            'level4',
            'kecamatan',
            'satuan',
            'value',
            'produsen',
        ];
        $data = Something::select($columns);
        // $data = DB::table('something')->select($columns)->get();
        return DataTables::of($data)->make();
    }
}
