@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Edit Data Sekolah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sekolah.update', $sekolah->id) }}" method="post" id="formTambahGuru">             
                    @method("PATCH")
                    @csrf
                    <div class="form-group">
                        <label for="sekolah">Nama Sekolah</label>
                        <input type="text" class="form-control" name="nama_sekolah" id="sekolah"
                            placeholder="Masukkan Nama Sekolah" value="{{ $sekolah->nama_sekolah}}">
                    </div>
                    <div class="form-group">
                        <label for="selectKota">Kota</label>
                        <select class="form-control select2" name="kota" id="selectKota" style="width: 100%;">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectKecamatan">Kecamatan</label>
                        <select class="form-control select2" name="kecamatan" id="selectKecamatan" style="width: 100%;">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectKelurahan">Kelurahan</label>
                        <select class="form-control select2" name="kelurahan" id="selectKelurahan" style="width: 100%;">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat"  value="{{ $sekolah->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="koordinat">Koordinat</label>
                        <input type="text" class="form-control" name="koordinat" id="koordinat"
                            placeholder="Masukkan Koordinat"  value="{{ $sekolah->koordinat }}">
                    </div>
                    <div class="form-group">
                        <label for="jenjang">Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang" value="{{ $sekolah->jenjang }}">
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
        initSelectKota("{{ $sekolah->kota}}", "{{ $sekolah->kecamatan}}", "{{ $sekolah->kelurahan}}" )
    });

</script>
@endsection
