@extends('Admin.home')
@section('content')
@if(Auth::user()->role == 'Admin')
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('kelola_user') }}">Users</a></li>
                <li class="breadcrumb-item active">Form Input Users</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
            <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('kelola_user') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Input Users</h5>

                    <form class="row g-3" method="POST" action="{{ route('kelola_user.store')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" placeholder="email@gmail.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" placeholder="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">No HP</label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" 
                                name="no_hp" placeholder="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">IsActive</label>

                            <input type="number" class="form-control @error('isactive') is-invalid @enderror" 
                                name="isactive" placeholder="IsActive Isi yes/no/banned" value="{{ old('isactive') }}">
                            @error('isactive')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="form-label">Isactive</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('isactive') is-invalid @enderror" 
                                name="isactive">
                                    <option value="">-- Pilih Isactive --</option>
                                    @foreach($ar_isactive as $is)
                                    @php $sel = ( old('is') == $is) ? 'selected' : ''; @endphp
                                    <option value="{{ $is }}" {{ $sel }}> {{ $is }} </option>
                                    @endforeach
                                </select>
                                @error('isactive')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Role</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('role') is-invalid @enderror" 
                                name="role">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($ar_role as $role)
                                    @php $sel = ( old('role') == $role) ? 'selected' : ''; @endphp
                                    <option value="{{ $role }}" {{ $sel }}> {{ $role }} </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                            name="alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="foto" placeholder="foto" >
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
@else
    @include('Admin.access_denied')
@endif
@endsection