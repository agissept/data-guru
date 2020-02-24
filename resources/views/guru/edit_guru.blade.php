@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Edit Data Guru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.update', $guru->id) }}" method="post" id="formTambahGuru">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="namaSekolah">Nama Sekolah</label>
                        <select class="form-control select2" name="id_sekolah" id="namaSekolah" style="width: 100%;">
                            <option></option>
                            @foreach ($listSekolah as $sekolah)
                            <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP" value="{{ $guru->nip }}">
                    </div>
                    <div class="form-group">
                        <label for="nuptk">NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" id="nuptk" placeholder="Masukkan NUPTK" value="{{ $guru->nuptk }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="{{ $guru->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggalLahir">Tanggal Lahir</label>
                        <input type="text" class="form-control datetimepicker-input" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}"
                            placeholder="Masukkan Tanggal Lahir" id="tanggalLahir" data-toggle="datetimepicker"
                            data-target="#tanggalLahir" />
                    </div>
                    <div class="form-group">
                        <label for="pangkat">Pangkat</label>
                        <select class="form-control" name="pangkat" id="pangkat" value="{{ $guru->pangkat }}">
                            @foreach ($listPangkat as $pangkat)
                            <option value="{{ $pangkat->id }}"> {{ $pangkat->nama_pangkat }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tmtPangkatTerakhir">TMT Pangkat Terakhir</label>
                        <input type="text" class="form-control datetimepicker-input" name="tmt_pangkat_terakhir" value="{{ $guru->tmt_pangkat_terakhir }}"
                            placeholder="MasukkanTMT Pangkat Terakhir" id="tmtPangkatTerakhir"
                            data-toggle="datetimepicker" data-target="#tmtPangkatTerakhir" />
                    </div>
                    <div class="form-group">
                        <label for="kgb">Kenaikan Gaji Berkala</label>
                        <input type="text" class="form-control datetimepicker-input" name="kgb" value="{{ $guru->kgb }}"
                            placeholder="Masukkan Kenaikan Gaji Berkala" id="kgb" data-toggle="datetimepicker"
                            data-target="#kgb" />
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" name="jabatan" id="jabatan" value="{{ $guru->jabatan->nama_jabatan }}">
                            @foreach ($listJabatan as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->

<script>
    $(document).ready(function () {
        initView('tambah_guru', false)
    });
</script>
@endsection
