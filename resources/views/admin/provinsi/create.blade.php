@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Provinsi</div>
                <div class="card-body">
                <form action="{{route('provinsi.store')}}" method="POST">
                   @csrf
                   
                    <div class="form-group">
                        <label>Kode Provinsi</label>
                        <input type="text" name="kode_provinsi" class="form-control" required>
                        @if ($errors->has('kode_provinsi'))
                        <span class="text-danger">{{ $errors->first('kode_provinsi') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nama Provinsi</label>
                        <input type="text" name="nama_provinsi" class="form-control" required>
                        @if ($errors->has('nama_provinsi'))
                        <span class="text-danger">{{ $errors->first('nama_provinsi') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection