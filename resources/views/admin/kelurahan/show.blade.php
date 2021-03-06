@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Kelurahan</div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Nama Kelurahan</label>
                    <input type="text" name="nama_kelurahan" value="{{$kelurahan->nama_kelurahan}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Asal kecamatan</label>
                        <input type="text" name="id_kecamatan" class="form-control" value="{{$kelurahan->kecamatan->nama_kecamatan}}" readonly>
                    </div>
                    <div class="form-group">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Kembali</a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection