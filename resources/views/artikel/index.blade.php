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
                <form action="{{route('artikel.index')}}" method="get" class="navbar-left navbar-form nav-search mr-md-3">
							
                    <div class="input-group" style="height:35px">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon" style="font-size: 15px"></i>
                            </button>
                        </div>
                        <input name="search" type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </li>
        </ul>
    </div>

    {{-- buat ngecek apakah variabel status ada nilainya atau gak --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"> 
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

    
        
       
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2"><h4 class="page-title float-left">Data Artikel</h4></div>
                    <div class="col-md-4">
                        {{-- <button type="submit" class="btn btn-secondary d-inline"><i class="fa fa-search" ></i></button>
                        <input style="width:70%" type="text" class="form-control d-inline" name="search"> --}}
                        
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('artikel.export')}}" title="export to excel" style="text-decoration: none;">
                        <button style="margin-left: 15%" class="btn btn-success btn-round "> <i class="fas fa-download"></i>  Export Excel</button> &nbsp;
                        </a>   
                        <a href="{{route('artikel.impor')}}" title="import from excel" style="text-decoration: none;">
                        <button class="btn btn-success btn-round " > <i class="fas fa-upload"></i>  Import Excel</button> &nbsp;
                        </a>  
                        <a href="{{route('artikel.create')}}" style="text-decoration: none;">
                           <button class="btn btn-primary btn-round "> <i class="fas fa-plus-circle"></i> Tambah</button> &nbsp;
                        </a>
                    </div>
                </div>
                    
                    
                </div>
               
                <div class="card-body">

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col" style="width:20%">Judul Artikel</th>
                                <th scope="col" style="width:20%">Isi</th>
                                <th scope="col" >Gambar</th>
                                <th scope="col" >Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            


                            {{-- taro looping data disini --}}
                            @foreach($data as $item)
                            <tr>
                                <td>{{++$no}}</td>
                                <td>{{$item->judul_artikel}}</td>
                                <td>{{ substr($item->isi, 0, 50) . "....."}}</td>
                                <td>     
                                <div class="avatar">
                                    <img src="{{asset('upload/'.$item->gambar)}}" alt="..." class="avatar-img rounded-circle">
                                </div>
                                </td>
                                <td>{{$item->kategori}}</td>
                                <td>
                                    <a href="{{route('artikel.show', $item->id)}}" style="text-decoration: none">
                                    <button type="button" class="btn btn-icon btn-round btn-info">
                                        <i class="fa fa-info-circle"></i>
                                    </button> &nbsp;
                                    </a>
                                    <a href="{{route('artikel.edit', $item->id)}}" style="text-decoration: none">
                                    <button type="button" class="btn btn-icon btn-round btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    </a>
                                    <a href="{{route('artikel.destroy', $item->id)}}" style="text-decoration: none">
                                    <button  onclick="return confirm('yakin mau apus?')"  type="button" class="btn btn-icon btn-round btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button> &nbsp;
                                    </a>
                                </td>
                            </tr>
                          
                            
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="center" colspan="6">{{$data->links()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


