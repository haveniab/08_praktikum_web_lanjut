<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mahasiswas = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('Nim', 'asc')->paginate(3);
        return view('mahasiswas.index', ['mahasiswa' => $mahasiswas,'paginate'=>$paginate]);
        
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $mahasiswas = Mahasiswa::paginate(5);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'Kelas' => 'required',
                'Jurusan' => 'required',
            ]);
    
            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->Nim = $request->get('Nim');
            $Mahasiswa->Nama = $request->get('Nama');
            $Mahasiswa->Jurusan = $request->get('Jurusan');
            $Mahasiswa->save();

            $Kelas = new Kelas;
            $Kelas->id = $request->get('Kelas');

            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($Kelas);
            $Mahasiswa->save();
 

    
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();

        return view('mahasiswas.detail', ['Mahasiswas' => $Mahasiswa]);

    
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $Kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'Kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'Kelas' => 'required',
                'Jurusan' => 'required',
            ]);
            $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
            $Mahasiswa->Nim = $request->get('Nim');
            $Mahasiswa->Nama = $request->get('Nama');
            $Mahasiswa->Jurusan = $request->get('Jurusan');
            $Mahasiswa->save();

            $Kelas = new Kelas;
            $Kelas->id = $request->get('Kelas');

            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($Kelas);
            $Mahasiswa->save();
   
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
            Mahasiswa::find($Nim)->delete();
            return redirect()->route('mahasiswas.index')
                -> with('success', 'Mahasiswa Berhasil Dihapus');
    
    }
}
