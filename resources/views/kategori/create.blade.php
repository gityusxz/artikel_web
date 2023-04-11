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
                <a href="{{route('kategori')}}">Data Kategori</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="">Tambah Data Katagori</a>
            </li>
            
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Kategori</div>
                </div>
               <form action="{{ route('kategori/store')}}" method="post" enctype="multipart/form-data">
                @csrf
        
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email2">Nama Kategori</label>
                                <input type="text" value="{{ old('kategori')}}" name="kategori" class="form-control {{ $errors->first('kategori') ? "is-invalid" : "" }}"  id="email2" placeholder="Masukkan Kategori">
                                
                                @error('kategori')
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
                    </div>
                   </div>
                   
            </form>

            </div>
           
        </div>
    </div>
</div>


    
@endsection