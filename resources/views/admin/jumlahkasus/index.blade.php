
@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>Daftar Kasus
                    <a href="{{route('jumlahkasus.create')}}" class="btn btn-primary float-right"> Tambah Data</a>
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
                                        <thead>
                                            <th>No</th>
                                            <th>Lokasi</th>
                                            <th>RW</th>
                                            <th>Total Reaktif</th>
                                            <th>Total Positif</th>
                                            <th>Total Sembuh</th>
                                            <th>Total Meninggal</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1;
                                    @endphp
                                    @foreach($jumlahkasus as $data)
                                        <tr>
                                            <th>{{$no++}}</th>
                                            <td>Provinsi : {{$data->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi}}<br>
                                            Kota / Kabupaten : {{$data->rw->kelurahan->kecamatan->kota->nama_kota}}<br>
                                            Kecamatan : {{$data->rw->kelurahan->kecamatan->nama_kecamatan}}<br>
                                            Kota / Desa : {{$data->rw->kelurahan->nama_kelurahan}}</td>
                                            <td>{{$data->rw->nama_rw}}</td>
                                            <td>{{$data->reaktif}}</td>
                                            <td>{{$data->jumlah_positif}}</td>
                                            <td>{{$data->jumlah_sembuh}}</td>
                                            <td>{{$data->jumlah_meninggal}}</td>
                                            <td>{{$data->tanggal}}</td>
                                            <td>
                                            <form action="{{route('jumlahkasus.destroy',$data->id)}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <a href="{{route('jumlahkasus.show',$data->id)}}" class="btn btn-info">Show</a>
                                            <a href="{{route('jumlahkasus.edit',$data->id)}}" class="btn btn-success">Edit</a>
                                            <button type="submit" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Delete</button>
                                        
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection