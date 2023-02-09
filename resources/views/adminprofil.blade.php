
@extends('layouts/admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Profil
        </div>
        <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
            <img src="{{ URL::asset('img/1.jpg') }}" class="img-fluid"/>
            <br/><br/><br/>
            <p style="color:black;text-align: justify;">
                Dewan Perwakilan Rakyat Daerah Kabupaten Malang (disingkat DPRD Kabupaten Malang) adalah lembaga 
                legislatif unikameral yang berkedudukan di Kabupaten Malang, provinsi Jawa Timur. DPRD Kabupaten 
                Malang memiliki 50 orang anggota yang tersebar di 8 fraksi, dengan perolehan suara mayoritas diraih 
                oleh PDI-P dan Partai Kebangkitan Bangsa.
            </p>
            <img src="{{ URL::asset('img/2.jpg') }}" class="img-fluid"/>
            <img src="{{ URL::asset('img/3.jpg') }}" class="img-fluid"/>
            <br/><br/><br/>
            <div style="text-align: center;">
                <b  style="color:black;text-align:center;">FORMASI DAN STRUKTUR JABATAN</b>
            </div>
            <img src="{{ URL::asset('img/4.jpg') }}" class="img-fluid"/>
            <img src="{{ URL::asset('img/1.jpg') }}" class="img-fluid"/>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection