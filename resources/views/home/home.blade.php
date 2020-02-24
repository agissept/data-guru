@extends('template/admin')
@section('content')
<div class="row">
    @foreach ($listSekolah as $key => $sekolah)
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info d-flex">
            <h3 class="widget-user-username m-auto align-self-center">{{$sekolah[0]->jenjang}}</h3>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <a href="sekolah/{{$sekolah[0]->jenjang}}">
                                <h5 class="description-header">{{ $sekolah->count() }}</h5>
                                <span class="description-text">Sekolah</span>
                            </a>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="description-block">
                            <a href="guru/{{$sekolah[0]->jenjang}}">
                                <h5 class="description-header">{{ $listJumlahGuru[array_search($key, array_keys($listJumlahGuru))]->total_guru }}</h5>
                                <span class="description-text">Guru</span>
                            </a>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    @endforeach
</div>
<!-- /.row -->
@endsection
