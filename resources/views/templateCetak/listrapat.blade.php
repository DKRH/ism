<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<center>
		<h5>Data Rapat</h4>
        <hr/>
	</center>
 
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-info">
                    <th>No</th>
                    <th>Tipe</th>
                    <th>Nama</th>
                    <th>Jabatan/Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $v)
                <tr>
                    <td>{{$v['no']}}</td>
                    <td>{{$v['tipe']}}</td>
                    <td>{{$v['nama']}}</td>
                    <td>{{$v['jabatan']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</body>
</html>