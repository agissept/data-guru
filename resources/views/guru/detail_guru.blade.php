@extends('template/admin')
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="m-0 align-self-center">Data Guru</h5>
                <div class="ml-auto row">
                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning mx-2" >
                        Edit
                    </a>
                    <form action="{{ route('guru.destroy', $guru->id) }}" class="mx-2" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">id: {{ $guru->id }}</p>
                <p class="card-text">Sekolah: {{ $guru->sekolah->nama_sekolah }}</p>
                <p class="card-text">NIP: {{ $guru->nip }}</p>
                <p class="card-text">NUPTK: {{ $guru->nuptk }}</p>
                <p class="card-text">Nama : {{ $guru->nama }}</p>
                <p class="card-text">Tanggal Lahir : {{ $guru->tanggal_lahir }}</p>
                <p class="card-text">Pangkat : {{ $guru->pangkat->nama_pangkat }}</p>
                <p class="card-text">Jabatan : {{ $guru->jabatan->nama_jabatan }}</p>
                <p class="card-text">TMT Pangkat Terakhir : {{ $guru->tmt_pangkat_terakhir }}</p>
                <p class="card-text">Kenaikan Gaji Berkala : {{ $guru->kgb }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
