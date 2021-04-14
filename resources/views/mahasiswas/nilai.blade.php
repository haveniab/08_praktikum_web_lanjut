@extends('mahasiswas.layout')
@section('content')
<div class="row">
	<div class="col-lg-12margin-tb">
		<div class="pull-leftmt-2">
			<h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
		</div>
		<p align="center">KARTU HASIL STUDI</p>
</div>
</div>
<br>
<p>Nama : {{$mhs->nama}}</p>
<p>Nim : {{$mhs->nim}}</p>
<p>Jurusan : {{$mhs->jurusan}}</p>
<p>Kelas : {{$mhs->kelas->nama_kelas}}</p>

<table class="table table-bordered">

<tr>
	<th>Mata Kuliah</th>
	<th>SKS</th>
	<th>Jam</th>
	<th>Semester</th>
	<th>Nilai</th>
</tr>
@foreach($mhs->matakuliah as $mm)
<tr>
	<td>{{$mm->nama_matkul}}</td>
	<td>{{$mm->sks}}</td>
	<td>{{$mm->jam}}</td>
	<td>{{$mm->semester}}</td>
	<td>{{$mm->pivot->nilai}}</td>
</tr>
@endforeach
</table>
@endsection 