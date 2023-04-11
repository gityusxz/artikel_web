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
                <a href="">Detail Artikel : {{$show['judul_artikel']}} </a>
            </li>
          
            
        </ul>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">Detail Artikel</h4>
                    </div>
                    
                        <div class="col-md-12">
                            
                                <div class="card-body">
                                    <center> <img style="width:50%" src="{{asset('upload/'.$show['gambar'])}}" alt=""></center>
                                   <center><h3 class="pt-3 page-title">Judul Artikel : {{$show['judul_artikel']}}</h3></center>
                                    <p align="justify">{{$show['isi']}}</p>
                                </div>
                           
                        </div>
                    
                </div>
               
            </div>
    
        
    </div>
</div>







    
@endsection