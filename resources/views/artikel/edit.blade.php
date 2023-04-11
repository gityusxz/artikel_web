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
                <a href="">Edit Data Artikel</a>
            </li>
 
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Artikel : {{$edit['judul_artikel']}}</div>
                </div>
               <form action="{{ route('artikel.update', $edit['id'])}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email2">Judul Artikel</label>
                                <input type="text" value="{{$edit['judul_artikel']}}" name="judul" class="form-control {{ $errors->first('judul') ? "is-invalid" : "" }}"  id="email2" placeholder="Masukkan Judul">
 
                                @error('judul')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="email2">Nama kategori</label>
                               
                                    
                               
                                <select class="form-control {{ $errors->first('kategori') ? "is-invalid" : "" }}" name="kategori" id="">
                                    @foreach ($kate as $item)
                                    <option hidden>Pilih Kategori</option>
                                    <option @if ($item->id_kategori == $edit['kategori_id'])
                                        {{ "selected" }}
                                    @endif 
                                    value="{{$item->id_kategori}}">{{$item->kategori}}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                
                                
                               
                            </div>
                        </div>
                        
                            <div class="col-md-12">
                        <div class="form-group">
                                <p class="font-weight-bold" for="password">Upload Gambar</p>
                                
                                
                                <img style="width:20%" src="{{asset('upload/'.$edit['gambar'])}}" alt="">
                                <input type="file"  name="gambar"  class=" mt-2 form-control {{ $errors->first('gambar') ? "is-invalid" : "" }}" id="exampleFormControlFile1">
                                @if($edit['gambar'])
                                <small>*kosongkan jika tidak merubah gambar</small>
                                @endif
                                
                                
                                @error('gambar')
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
                                <textarea type="text" name="isi"  class="form-control {{ $errors->first('isi') ? "is-invalid" : "" }}" style="height:40%" placeholder="">{{$edit['isi']}}</textarea>
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
                    <center><button type="submit" class="btn btn-primary"> <i class="icon-refresh"></i> Update</button></center>
                     </div>
            </form>
 
            </div>
 
        </div>
    </div>
</div>
 
@endsection