<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PerangkatDaerah as tbl;

class DataPerangkatDaerah extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $btn = '<button data-id="{{ $id }}" class="btn btn-xs btn-success edit">Ubah</button> '.
                    '<button data-id="{{ $id }}" class="btn btn-xs btn-danger delete">Hapus</button>';
            return Datatables::of(tbl::select('*'))
            ->addColumn('action', $btn)
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('dataperangkat');
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $data   =   tbl::updateOrCreate(
                        [
                            'id' => $id
                        ],
                        [
                            'nama' => $request->nama,
                            'jabatan' => $request->jabatan,
                        ]
                    );
        return Response()->json($data);
    }
    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = tbl::where($where)->first();

        return Response()->json($data);
    }
    public function destroy($id)
    {
        $data = tbl::where('id',$id)->delete();
        return Response()->json($data);
    }
}
