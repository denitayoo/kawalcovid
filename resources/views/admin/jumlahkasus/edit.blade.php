
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>
                Edit
                </div>

                <div class="card-body">
                <form action="{{route('jumlahkasus.update',$jumlahkasus->id)}}" method="POST">
                   @csrf
                   @method('PATCH')
                    <div class="form-group">
                        <label>Rw</label>
                        <select name="id_ew" class="form-control">
                        @foreach ($rw as $data)
                        <option value="{{$data->id}}" {{$data->id == $jumlahkasus->id_rw ? 'selected' : ''}}>{{$data->nama_rw}}</option>
                        @endforeach
                        </select>
                        </div>
                   <div class="form-group">
                        <label>Positif</label>
                        <input type="text" name="jumlah_positif" value="{{$jumlahkasus->jumlah_positif}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Sembuh</label>
                        <input type="text" name="jumlah_sembuh" value="{{$jumlahkasus->jumlah_sembuh}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Meninggal</label>
                        <input type="text" name="jumlah_meninggal" value="{{$jumlahkasus->jumlah_meninggal}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="{{$jumlahkasus->tanggal}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection