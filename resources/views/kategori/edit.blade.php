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
                <a href="">Edit Data Kategori</a>
            </li>
 
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Kategori : {{$edit['kategori']}}</div>
                </div>
               <form action="{{ route('kategori/update', $edit['id_kategori'])}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email2">Nama Kategori</label>
                                <input type="text" value="{{$edit['kategori']}}" name="kategori" class="form-control {{ $errors->first('kategori') ? "is-invalid" : "" }}"  id="email2" >
 
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
                    <center><button type="submit" class="btn btn-primary"> <i class="icon-refresh"></i> Update</button></center>
                     </div>
            </form>
 
            </div>
 
        </div>
    </div>
</div>
 
@endsection