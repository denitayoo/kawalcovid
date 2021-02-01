@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>
                    Daftar RW
                <a href="{{route('jumlahkasus.create')}}" class="btn btn-primary float-right">
                Tambah Data</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
            <th>No</th>
            <th>Rw</th>
            <th>Positif</th>
            <th>Sembuh</th>
            <th>Meninggal</th>
            <th>Tanggal</th>
            <th>Aksi</th>
            </tr>
            @php $no=1; @endphp
            @foreach($jumlahkasus as $data)
            <form action="{{route('jumlahkasus.destroy', $data->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <tr>
            <td>{{$no++}}</td>
            <td>{{$data->rw->nama_rw}}</td>
            <td>{{$data->jumlah_positif}}</td>
            <td>{{$data->jumlah_sembuh}}</td>
            <td>{{$data->jumlah_meninggal}}</td>
            <td>{{$data->tanggal}}</td>
            <td>
            <a href="{{route('jumlahkasus.edit',$data->id)}}" class="btn btn-info">Edit</a>
            <a href="{{route('jumlahkasus.show',$data->id)}}" class="btn btn-success">Show</a>
            <button type="submit" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Delete</button>
            </form>
            </td>
            </tr>
         
            @endforeach
            </table>
            </div>
            </div>
            </div>
           </div>
      </div>
</div>
@endsection


