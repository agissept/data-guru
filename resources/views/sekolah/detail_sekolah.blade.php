@extends('template/admin')
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="m-0 align-self-center">Data Sekolah</h5>
                <div class="ml-auto row">
                    <a href="{{ route('sekolah.edit', $sekolah->id) }}" class="btn btn-warning mx-2" >
                        Edit
                    </a>
                    <form action="{{ route('sekolah.destroy', $sekolah->id) }}" class="mx-2" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $sekolah->nama_sekolah }}</p>
                <p class="card-text">Alamat : {{ $sekolah->alamat }}</p>
                <p class="card-text">Koordinat : {{ $sekolah->koordinat }}</p>
                <p class="card-text">Kepala Sekolah : {{ $kepalaSekolah }}</p>
                <p class="card-text">Kepala TU : {{ $kepalaTU }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="m-0 align-self-center">Data Guru</h5>
                <a href="{{ route('guru.create') }}" class="btn btn-primary ml-auto">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NIP</th>
                            <th>NUPTK</th>
                            <th>Nama Guru</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listGuru as $guru)
                        <tr>
                            <td>{{ $guru->id }}</td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->nuptk }}</td>
                            <td>
                                <a href="{{ route('guru.show', $guru->id) }}">
                                    {{ $guru->nama }}
                                </a>
                            </td>
                            <td>{{ $guru->jabatan->nama_jabatan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection
