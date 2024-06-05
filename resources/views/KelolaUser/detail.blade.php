@extends('Admin.home')
@section('content')
@if(Auth::user()->role == 'Admin')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('kelola_user') }}">Kelola User</a></li>
                <li class="breadcrumb-item active">Detail Kelola User</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('kelola_user') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @empty($row->foto)
                    <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" width="150px">
                    @else
                    <img src="{{ url('assets/img/user/'.$row->foto) }}" alt="Profile" width="150px">
                    @endempty
                    <h3 class="mt-3">{{ $row->name }}</h3>
                    <h4>{{ $row->role }}</h4>
                    <p class="mt-2 badge text-white {{ ($row->isactive == 1) ? 'bg-success' : 'bg-danger'}}">
                        {{ ($row->isactive == 1) ? 'Aktif' : 'Tidak Aktif'}}
                        </p>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="alert alert-warning d-flex flex-column align-items-center" style="width:300px; ">
                        Email : {{ $row->email }}
                        <br/>
                        No HP : {{ $row->no_hp }}
                        <br/>Alamat : {{ $row->alamat }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@else
    @include('Admin.access_denied')
@endif
@endsection