@extends('Admin.home')
@section('content')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('posts') }}">Posts</a></li>
                <li class="breadcrumb-item active">Detail Posts</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('posts') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @empty($row->foto)
                    <img src="{{ url('assets_user/img/posts/nophoto.png') }}" alt="Profile" width="150px">
                    @else
                    <img src="{{ url('assets_user/img/posts/'.$row->foto) }}" alt="Profile" width="150px">
                    @endempty
                    
                    <h3 class="mt-3">{{ $row->title }}</h3>
                    <h4>Content : {{ $row->content }}</h4>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="alert alert-warning d-flex flex-column align-items-center" style="width:300px; ">
                        <br/>User : {{ $row->user->name }}
                        <br/>Kategori : {{ $row->category->name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection