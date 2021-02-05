<div>
    <div class="form-group">
        <label class="">Provinsi</label>
            <select wire:model="selectedProvinsi" class="form-control">
                <option value="" selected>Pilih Provinsi</option>
                @foreach($provinsis as $provinsi)
                    <option value={{ $provinsi->id }}>{{ $provinsi->nama_provinsi }}</option>
                @endforeach
            </select>     
    </div> 
   
    <div class="form-group">
        
            <label class="">Kota</label>
                <select wire:model="selectedKota" class="form-control">
                    <option value="" selected>Pilih Kota</option>
                    @foreach($kotas as $kota)
                        <option value={{ $kota->id }}>{{ $kota->nama_kota }}</option>
                    @endforeach
                </select>
                </div>  
            
    <div class="form-group">
        
        <label class="">Kecamatan</label>
            <select wire:model="selectedKecamatan" class="form-control">
                <option value="" selected>Pilih Kecamatan</option>
                @foreach($kecamatans as $kecamatan)
                    <option value={{ $kecamatan->id }}>{{ $kecamatan->nama_kecamatan }}</option>
                @endforeach
            </select>
            </div>
        
    <div class="form-group">
        
        <label class="">Kelurahan</label>
            <select wire:model="selectedKelurahan" class="form-control">
                <option value="" selected>Pilih Kelurahan</option>
                @foreach($kelurahans as $kelurahan)
                    <option value={{ $kelurahan->id }}>{{ $kelurahan->nama_kelurahan }}</option>
                @endforeach
            </select>
            </div>   
            
        <div class="form-group">
        
        <label class="">RW</label>
            <select wire:model="selectedRw" class="form-control"  name="id_rw">
                <option value="" selected>Pilih RW</option>
                @foreach($rws as $rw)
                    <option value={{ $rw->id }}>{{ $rw->nama_rw }}</option>
                @endforeach
            </select>
            </div>

        </div> 