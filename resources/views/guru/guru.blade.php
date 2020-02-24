@extends('template/admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Pencarian Data Guru</h5>
            </div>
            <div class="card-body">
                <form action="guru/search" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kataKunci">Kata Kunci</label>
                        <input type="text" class="form-control" name="kata_kunci" id="kataKunci"
                            placeholder="Masukkan NIP, NUPTK, atau Nama">
                    </div>

                    <input name="cari" id="cari" class="btn btn-primary" type="submit" value="Cari">
                </form>
            </div>
        </div>

    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->
@endsection
