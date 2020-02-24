@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="m-0 align-self-center">Data Sekolah</h5>
                <a href="{{ route('sekolah.create') }}" class="btn btn-primary ml-auto">Tambah</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Sekolah</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Alamat</th>
                            <th>Jenjang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listSekolah as $sekolah)
                        <tr>
                            <td>{{ $sekolah->id }}</td>
                            <td>
                                <a href="{{ route('sekolah.show', $sekolah->id) }}">
                                    {{ $sekolah->nama_sekolah }}
                                </a>
                            </td>
                            <td>{{ $sekolah->kota }}</td>
                            <td>{{ $sekolah->kecamatan }}</td>
                            <td>{{ $sekolah->kelurahan }}</td>
                            <td>{{ $sekolah->alamat }}</td>
                            <td>{{ $sekolah->jenjang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
</div>
<!-- /.row -->

@endsection
