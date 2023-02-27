<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\ListRapat as tbl;
use App\Models\RelasiRapat as tbl0;
use App\Models\AnggotaDPRD as tbl1;
use App\Models\PerangkatDaerah as tbl2;
use App\Models\Umum as tbl3;
use DB;
use PDF;

class ListRapat extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $btn = '<button data-id="{{ $id }}" class="btn btn-xs btn-success edit">Ubah</button> '.
                    '<button data-id="{{ $id }}" class="btn btn-xs btn-danger delete">Hapus</button> '.
                    '<a class="btn btn-xs btn-info" href="{{ url("list-rapat-detail")."/".$id }}">Detail</a> '.
                    '<a class="btn btn-xs btn-primary" target="_blank" href="{{ url("form-hadir")."/".$id }}">Form</a> ';
            return Datatables::of(tbl::select('*')->orderBy('tanggal_rapat'))
            ->addColumn('tanggal_rapat2', function (tbl $post) {
                return date("d/m/Y", strtotime($post->tanggal_rapat));
            })
            ->addColumn('stataktif', function (tbl $post) {
                $html = 'AKTIF';
                if ($post->stat_aktif == 0) {
                    $html = '<button class="btn btn-warning stataktif_aktivasi" data-id="'.$post->id.'">Aktifkan</button>';
                }
                return $html;
            })
            ->addColumn('admin', function (tbl $post) {
                return $post->admin($post->admin_id);
            })
            ->addColumn('total', function (tbl $post) {
                return count($post->list_peserta);
            })
            ->addColumn('action', $btn)
            ->rawColumns(['action','stataktif','admin'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('listrapat');
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $data   =   tbl::updateOrCreate(
                        [
                            'id' => $id
                        ],
                        [
                            'judul_rapat' => $request->judul_rapat,
                            'tanggal_rapat' => $request->tanggal_rapat,
                            'jumlah_kursi' => $request->jumlah_kursi,
                            'deskripsi_rapat' => $request->deskripsi_rapat,
                            'admin_id' => $request->admin_id,
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
    public function stataktif(Request $request) {
        $id = $request->id;
        tbl::query()->update(['stat_aktif' => 0]);
        tbl::where('id', $id)->update(['stat_aktif' => 1]);
        $data['status'] = 'sukses';
        return Response()->json($data);
    }
    private function ts($post) {
        $d = [];
        if ($post->umum_id != 0) {
            $id = $post->umum_id;
            $d['tipe'] = "UMUM";
            $a = $post->getData1($id);
            $d['nama'] = $a->nama;
            $d['jabatan'] = $a->status;
        } else if ($post->perangkat_daerah_id != 0) {
            $id = $post->perangkat_daerah_id;
            $d['tipe'] = "UPD dan Sekretariat";
            $a = $post->getData2($id);
            $d['nama'] = $a->nama;
            $d['jabatan'] = $a->jabatan;
        } else if ($post->anggota_dprd_id != 0) {
            $id = $post->anggota_dprd_id;
            $d['tipe'] = "ANGGOTA DPRD";
            $a = $post->getData3($id);
            $d['nama'] = $a->nama;
            $d['jabatan'] = $a->jabatan;
        } else if ($post->fork_id != 0) {
            $id = $post->fork_id;
            $d['tipe'] = "FORKOPINDA";
            $a = $post->getData4($id);
            $d['nama'] = $a->nama;
            $d['jabatan'] = '';
        }
        return $d;
    }
    public function detail(Request $request) {
        if($request->ajax()) {
            /*$umum = tbl3::select("data_umum.nama as nama","data_umum.status as jabatan",DB::raw("CONCAT('UMUM') as tipe"));
            $dprd = tbl1::select("data_anggota_dprd.nama as nama","data_anggota_dprd.jabatan as jabatan",DB::raw("CONCAT('DPRD') AS tipe"))->union($umum);
            $desa = tbl2::select("data_perangkat_daerah.nama as nama","data_perangkat_daerah.jabatan as jabatan",DB::raw("CONCAT('DESA') AS tipe"))->union($dprd);*/
            
            $detail = tbl0::where('rapat_id', $request->idrapat);
            
            return Datatables::of(tbl0::where('rapat_id', $request->idrapat)->orderBy('created_at'))
            ->addColumn('tipe', function (tbl0 $post) {
                $d = $this->ts($post);
                return $d['tipe'];
            })
            ->addColumn('nama', function (tbl0 $post) {
                $d = $this->ts($post);
                return $d['nama'];
            })
            ->addColumn('jabatan', function (tbl0 $post) {
                $d = $this->ts($post);
                return $d['jabatan'];
            })
            ->rawColumns(['tipe','nama','jabatan'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('listrapatdetail')->with('idrapat', $request->idrapat);
    }
    public function cetakpdf(Request $request) {
        $id = $request->idrapat;
        $data = [];
        $detail = tbl0::where('rapat_id', $request->idrapat)->orderBy('created_at')->get();
        $no = 1;
        foreach($detail as $v) {
            $data[$no] = $v->toArray();
            $zz = $this->ts($v);
            $data[$no]['no'] = $no;
            $data[$no]['tipe'] = $zz['tipe'];
            $data[$no]['nama'] = $zz['nama'];
            $data[$no]['jabatan'] = $zz['jabatan'];
            $no++;
        }

        $pdf = PDF::loadView('templateCetak.listrapat', ['data' => $data]);
        return $pdf->stream('resume.pdf');
    }
}
