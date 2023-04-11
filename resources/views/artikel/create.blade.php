@extends('template/main')
@section('konten')

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Master Data</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('artikel.index')}}">Data Artikel</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="">Tambah Data Artikel</a>
            </li>
            
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Artikel</div>
                </div>
               <form action="{{ route('artikel.store')}}" method="post" enctype="multipart/form-data">
                @csrf
        
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email2">Judul Artikel</label>
                                <input type="text" value="{{ old('judul')}}" name="judul" class="form-control {{ $errors->first('judul') ? "is-invalid" : "" }}"  id="email2" placeholder="Masukkan Judul">
                                
                                @error('judul')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                            </div>
                        </div>
                            <div class="col-md-6">
                        <div class="form-group">
                                <label for="password">Upload Gambar</label>
                                
                                <input type="file"  name="gambar"  class="form-control {{ $errors->first('gambar') ? "is-invalid" : "" }}" id="exampleFormControlFile1">

                                @error('gambar')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="email2">Nama kategori</label>
                               
                                    
                               
                                <select class="form-control {{ $errors->first('kategori') ? "is-invalid" : "" }}" name="kategori" id="">
                                    @foreach ($data as $item)
                                    <option hidden>Pilih Kategori</option>
                                    <option value="{{$item->id_kategori}}">{{$item->kategori}}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                
                                
                               
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="password">Isi</label>
                                <textarea type="text" name="isi"  class="form-control {{ $errors->first('isi') ? "is-invalid" : "" }}" style="height:40%" placeholder=""></textarea>
                                @error('isi')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                        </div>
                    </div>
                    </div>
                   </div>
                   <div class="card-footer">
                    <center><button type="submit" class="btn btn-primary">Simpan</button></center>
                     </div>
            </form>

            </div>
           
        </div>
    </div>
</div>


    
@endsection