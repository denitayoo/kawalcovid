@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>
                Tambah Data</a>
                </div>
                <div class="card-body">
                <form action="{{route('jumlahkasus.store')}}" method="POST">
                   @csrf 
                   <div class="row">
                   <div class="col">
                    @livewireScripts
                    @livewire('dropdowns')
                    @livewireStyles
                 
                   
                    <div class="form-group">
                       <label for="">Reaktif</label>
                       <input type="text" name="reaktif" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <label for="">Positif</label>
                       <input type="text" name="jumlah_positif" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <label for="">Sembuh</label>
                       <input type="text" name="jumlah_sembuh" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <label for="">Meninggal</label>
                       <input type="text" name="jumlah_meninggal" class="form-control" required>
                   </div>
                   <div class="form-group">
                       <label for="">Tanggal</label>
                       <input type="date" name="tanggal" class="form-control" required>
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
</div>
@endsection


