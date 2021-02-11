@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>
                    Daftar Kecamatan
                <a href="{{route('kecamatan.create')}}" class="btn btn-primary float-right">
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
                            <thead>
                                <tr>
                                    <th>Nomor</th>   
                                    <th>Nama Kecamatan</th>
                                    <th>Nama Kota</th>
                                    <th colspan="3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($kecamatan as $data)
                                <form action="{{route('kecamatan.destroy',$data->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <tr>
                                        <td>{{$no++}}</td>            
                                        <td>{{$data->nama_kecamatan}}</td>
                                        <td>{{$data->kota->nama_kota}}</td>
                                        <form action="{{route('kecamatan.destroy',$data->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <td>
                                            <a href="{{route('kecamatan.show',$data->id)}}" class="btn btn-info">Show</a>
                                            <a href="{{route('kecamatan.edit',$data->id)}}" class="btn btn-success">Edit</a>
                                            <button type="submit" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Delete</button>
                                        </td>
                                        </form>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
