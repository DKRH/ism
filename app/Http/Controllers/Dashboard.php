<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\ListRapat as tbl;
use App\Models\Admin as tbl1;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }
    public function login() {
        return view('adminlogin');
    }
    public function login_validation(Request $request) {
        $msg = [];
        if (!tbl1::where('nip', $request->nip)->where('password', $request->password)->exists()) {
            $msg['status'] = 'error';
            $msg['text'] = 'NIP/Password Salah';
            return Response()->json($msg);
        }
        $d = tbl1::where('nip', $request->nip)->where('password', $request->password)->first();
        $msg['status'] = 'sukses';
        $msg['text'] = '';
        Session::put('id', $d->id);
        Session::put('nip', $d->nip);
        Session::put('nama', $d->nama);
        return Response()->json($msg);
    }
    public function logout() {
        Session::flush();
        return redirect('/login');
    }
    public function ganti_password() {
        return view('adminganti');
    }
    public function ganti_password_simpan(Request $request) {
        $id = Session::get('id');
        $nip = Session::get('nip');
        if (!tbl1::where('nip', $nip)->where('password', $request->passwordlama)->exists()) {
            $msg['status'] = 'error';
            $msg['text'] = 'Password Lama tidak sesuai (Salah)';
            return Response()->json($msg);
        }
        if ($request->passwordbaru != $request->passwordbaru2) {
            $msg['status'] = 'error';
            $msg['text'] = 'Password Baru dan Password Baru 2 tidak sama';
            return Response()->json($msg);
        }
        tbl1::where('id', $id)
            ->update(['password' => $request->passwordbaru]);

        $msg['status'] = 'sukses';
        $msg['text'] = '';
        return Response()->json($msg);
    }
    public function profil() {
        return view('adminprofil');
    }
    public function chart() {
        $databulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulannow = date('M');
        $arr = [];
        $arr2 = [];
        for($x=1; $x<=11; $x++) {
            $arr[] = date("M",strtotime("-$x month")).' '.date("Y",strtotime("-$x month"));
            $arrtgl = date('Y',strtotime("-$x month")).'-'.date("m",strtotime("-$x month"));
            $arr2[] = tbl::where('tanggal_rapat','LIKE','%'.$arrtgl.'%')->count();

        }
        $arr = array_reverse($arr);
        $arr2 = array_reverse($arr2);
        $arr[] = date('M').' '.date("Y");
        $arrtgl = date('Y').'-'.date("m");
        $arr2[] = tbl::where('tanggal_rapat','LIKE','%'.$arrtgl.'%')->count();
        $data['labels'] = $arr;

        $data['datas'] = $arr2;
        $data['jumlahmax'] = max($arr2) + ceil(max($arr2)*10/100);



        return Response()->json($data);
    }
    public function chart2() {
        $aaa = tbl::all();
        $databulan = [];
        $datahadir = [];
        foreach ($aaa as $val) {
            $databulan[] = $val->judul_rapat;

            $datahadir[] = count($val->list_peserta);
        }
        array_slice($databulan, 0, 12);
        array_slice($datahadir, 0, 12);
        $data['labels'] = $databulan;
        $data['datas'] = $datahadir;
        $data['jumlahmax'] = max($datahadir)+10;
        if ( (max($datahadir) % 10) > 0 ) {
            $sel = max($datahadir) % 10;
            $h = 10 - $sel;
            $data['jumlahmax'] += $h;
        }
        return Response()->json($data);
    }
}
