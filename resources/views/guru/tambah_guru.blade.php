@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Tambah Data Guru</h5>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('guru.store') }}" method="post" id="formTambahGuru">
                    @method('POST')
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
                        <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP">
                    </div>
                    <div class="form-group">
                        <label for="nuptk">NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" id="nuptk" placeholder="Masukkan NUPTK">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nma">
                    </div>
                    <div class="form-group">
                        <label for="tanggalLahir">Tanggal Lahir</label>
                        <input type="text" class="form-control datetimepicker-input" name="tanggal_lahir"
                            placeholder="Masukkan Tanggal Lahir" id="tanggalLahir" data-toggle="datetimepicker"
                            data-target="#tanggalLahir" />
                    </div>
                    <div class="form-group">
                        <label for="pangkat">Pangkat</label>
                        <select class="form-control" name="pangkat" id="pangkat">
                            @foreach ($listPangkat as $pangkat)
                            <option value="{{ $pangkat->id }}"> {{ $pangkat->pangkat }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tmtPangkatTerakhir">TMT Pangkat Terakhir</label>
                        <input type="text" class="form-control datetimepicker-input" name="tmt_pangkat_terakhir"
                            placeholder="MasukkanTMT Pangkat Terakhir" id="tmtPangkatTerakhir"
                            data-toggle="datetimepicker" data-target="#tmtPangkatTerakhir" />
                    </div>
                    <div class="form-group">
                        <label for="kgb">Kenaikan Gaji Berkala</label>
                        <input type="text" class="form-control datetimepicker-input" name="kgb"
                            placeholder="Masukkan Kenaikan Gaji Berkala" id="kgb" data-toggle="datetimepicker"
                            data-target="#kgb" />
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" name="jabatan" id="jabatan">
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
