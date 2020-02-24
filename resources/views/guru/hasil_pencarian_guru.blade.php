@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Data Guru</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NIP</th>
                            <th>NUPTK</th>
                            <th>Nama Guru</th>
                            <th>Sekolah</th>
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
                            <td>
                                <a href="{{ route('sekolah.show', $guru->sekolah->id) }}">
                                    {{ $guru->sekolah->nama_sekolah}}
                                </a>
                            </td>
                            <td>{{ $guru->jabatan->nama_jabatan }}</td>
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
