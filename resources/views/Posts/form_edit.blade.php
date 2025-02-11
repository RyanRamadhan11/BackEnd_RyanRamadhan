@extends('Admin.home')
@section('content')
@php
$ar_kategori = App\Models\Categories::all();
$ar_user = App\Models\Userss::all();
@endphp
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('posts') }}">Posts</a></li>
                <li class="breadcrumb-item active">Form Update</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('posts') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Update</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Terjadi Kesalahan saat input data<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="row g-3" method="POST" action="{{ route('posts.update',$row->id)}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Title Posts</label>
                            <input type="text" class="form-control" name="title" value="{{ $row->title }}" placeholder="Title Posts">
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Content</label>
                            <input type="text" class="form-control" name="content" value="{{ $row->content }}" placeholder="Content Posts">
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="foto" placeholder="foto">
                                @if(!empty($row->foto)) <img src="{{ url('assets_user/img/posts')}}/{{$row->foto}}" 
                                                            width="10%" class="img-thumbnail">
                                <br/>{{$row->foto}}
                                @endif
                        </div>

                        <div class="col-6">
                            <label class="form-label">Kategori</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="category_id">
                                    <option selected>-- Pilih Kategori --</option>
                                    @foreach($ar_kategori as $ktg)
                                    @php $sel = ($ktg->id == $row->category_id) ? 'selected' : ''; @endphp
                                    <option value="{{ $ktg->id }}" {{ $sel }}>{{ $ktg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Users</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="user_id">
                                    <option selected>-- Pilih Users --</option>
                                    @foreach($ar_user as $usr)
                                    @php $sel = ($usr->id == $row->user_id) ? 'selected' : ''; @endphp
                                    <option value="{{ $usr->id }}" {{ $sel }}>{{ $usr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-5 mb-5" style="border-radius: 130px;">
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Simpan</button>
                            <button type="reset" class="btn btn-dark" style="margin-right: 10px;">Batal</button>
                        </div>
                        
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection