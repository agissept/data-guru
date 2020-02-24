@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Tambah Data Sekolah</h5>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('sekolah.store') }}" method="post" id="formTambahGuru">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="sekolah">Nama Sekolah</label>
                        <input type="text" class="form-control" name="nama_sekolah" id="sekolah"
                            placeholder="Masukkan Nama Sekolah">
                    </div>
                    <div class="form-group">
                        <label for="selectKota">Kota</label>
                        <select class="form-control select2" name="kota" id="selectKota" style="width: 100%;" onchange="getKecamatan(this.value)">
                            <option></option>
                            <option value="KABUPATEN BANDUNG">KABUPATEN BANDUNG</option>
                            <option value="KABUPATEN BANDUNG BARAT">KABUPATEN BANDUNG BARAT</option>
                            <option value="KOTA BANDUNG">KOTA BANDUNG</option>
                            <option value="KOTA CIMAHI">KOTA CIMAHI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectKecamatan">Kecamatan</label>
                        <select class="form-control select2" name="kecamatan" id="selectKecamatan" style="width: 100%;"
                            onchange="getKelurahan(this.value)">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectKelurahan">Kelurahan</label>
                        <select class="form-control select2" name="kelurahan" id="selectKelurahan" style="width: 100%;">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="koordinat">Koordinat</label>
                        <input type="text" class="form-control" name="koordinat" id="koordinat" placeholder="Masukkan Koordinat">
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang">
                            <option>SMA</option>
                            <option>SMK</option>
                            <option>SLB</option>
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
        initView('tambah_sekolah', false)
    });
</script>
@endsection
