<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\RelasiRapat as tbl0;
use App\Models\AnggotaDPRD as tbl1;
use App\Models\PerangkatDaerah as tbl2;
use App\Models\Umum as tbl3;
use App\Models\ListRapat as tbl4;
use App\Models\Fork as tbl5;

class FormHadir extends Controller
{
    public function index()
    {
        $z = tbl4::where('stat_aktif', 1)->orderBy('tanggal_rapat');
        if ($z->exists()) {
            $y = $z->first();
            return redirect()->route('formHadir', ['id' => $y->id]);
        }
        return 'Error';
    }
    public function formHadir(Request $request)
    {
        $id = $request->id;
        $z = tbl4::where('id', $id)->orderBy('tanggal_rapat')->first();
        $data1 = tbl1::orderBy('nama')->get();
        $data2 = tbl2::orderBy('nama')->get();
        return view('FormHadir')->with('data1', $data1)->with('data2', $data2)->with('dataRapat', $z);
    }
    public function formHadirSearch(Request $request)
    {
        $text = $request->text;
        $tipe = $request->tipe;
        if ($tipe == "desa") {
            $dd = tbl2::where('nama','LIKE','%'.$text.'%')->get();
        } else if ($tipe == "dprd") {
            $dd = tbl1::where('nama','LIKE','%'.$text.'%')->get();
        } else if ($tipe == "fork") {
            $dd = tbl5::where('nama','LIKE','%'.$text.'%')->get();
        }
        $html = '';
        foreach ($dd as $v) {
            $dewa = 'data-jabatan=""';
            if ($tipe == "desa" || $tipe == "dprd" ) {
                $dewa = 'data-jabatan="'.$v->jabatan.'"';
            }
            $html .= '<tr><td>'.$v->nama.'</td><td><button type="button" class="btn btn-success btnPilih" data-id='.$v->id.' data-nama='.$v->nama.' '.$dewa.' >Pilih</button></td></tr>';
        }
        $data['kode'] = 'sukses';
        $data['msg'] = $html;
        if ($html == '') {
            $data['kode'] = 'error';
            $data['msg'] = 'Tidak ada nama';
        }
        return Response()->json($data);
    }
    public function formHadirCheckin(Request $request)
    {
        $type = $request->tipedata;
        $aid = $request->id;
        if ($type == 'umum') {
            $data   =   tbl3::create(
                            [
                                'nama' => $request->nama,
                                'status' => $request->status,
                                'email' => $request->email,
                            ]
                        );
            $id = $data->id;
            $data   =   tbl0::create(
                            [
                                'nama' => $request->nama,
                                'rapat_id' => $request->rapat_id,
                                'umum_id' => $id,
                                'perangkat_daerah_id' => 0,
                                'anggota_dprd_id' => 0,
                                'fork_id' => 0,
                            ]
                        );
        } else if ($type == 'dprd') {
            $data   =   tbl0::create(
                [
                    'nama' => $request->nama,
                    'rapat_id' => $request->rapat_id,
                    'umum_id' => 0,
                    'perangkat_daerah_id' => 0,
                    'anggota_dprd_id' => $aid,
                    'fork_id' => 0,
                ]
            );
        } else if ($type == 'desa') {
            $data   =   tbl0::create(
                [
                    'nama' => $request->nama,
                    'rapat_id' => $request->rapat_id,
                    'umum_id' => 0,
                    'perangkat_daerah_id' => $aid,
                    'anggota_dprd_id' => 0,
                    'fork_id' => 0,
                ]
            );
        } else if ($type == 'fork') {
            $data   =   tbl0::create(
                [
                    'rapat_id' => $request->rapat_id,
                    'umum_id' => 0,
                    'perangkat_daerah_id' => 0,
                    'anggota_dprd_id' => 0,
                    'fork_id' => $aid,
                ]
            );
        } 
        $dataz['status'] = 'sukses';
        $data2['data'] = $request->id;
        return Response()->json($dataz);
    }
    public function formHadirHitung(Request $request)
    {
        $id = $request->id;
        $dd['hadir'] = tbl0::where('rapat_id',$id)->count();
        $tbl1 = tbl4::where('id',$id)->first();
        $jka = 0;
        $jka = (isset($tbl1)) ? $tbl1->jumlah_kursi : 0;
        $jkb = $jka - $dd['hadir'];
        $dd['kursi'] = ($jkb < 0 ) ? 0 : $jkb;
        return Response()->json($dd);
    }
    
}
