@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Kelurahan</div>
                <div class="card-body">
                <form action="{{route('kelurahan.store')}}" method="POST">
                   @csrf
                    <div class="form-group">
                        <label>Nama kelurahan</label>
                        <input type="text" name="nama_kelurahan" class="form-control" required>
                        @if ($errors->has('nama_kelurahan'))
                        <span class="text-danger">{{ $errors->first('nama_kelurahan') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nama Kecamatan</label>
                        <select name="id_kecamatan" class="form-control">
                        @foreach ($kecamatan as $data)
                        <option value="{{$data->id}}">{{$data->nama_kecamatan}}</option>
                        @endforeach
                        </select>
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