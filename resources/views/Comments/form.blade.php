@extends('Admin.home')
@section('content')
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('posts') }}">Comments</a></li>
                <li class="breadcrumb-item active">Form Input Comments</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('comments') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Input Posts</h5>

                    <form class="row g-3" method="POST" action="{{ route('comments.store')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Content Posts</label>
                            <input type="text" class="form-control @error('content') is-invalid @enderror" 
                            name="content" placeholder="content posts" value="{{ old('content') }}">
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-6">
                            <label class="form-label">users</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('user_id') is-invalid @enderror" 
                                name="user_id">
                                    <option value="">-- Pilih User --</option>
                                    @foreach($ar_user as $usr)
                                    @php $sel = ( old('user_id') == $usr->id) ? 'selected' : ''; @endphp
                                    <option value="{{ $usr->id }}" {{ $sel }}>{{ $usr->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Posts</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('post_id') is-invalid @enderror" 
                                name="post_id">
                                    <option value="">-- Pilih Posts --</option>
                                    @foreach($ar_posts as $pst)
                                    @php $sel = ( old('post_id') == $pst->id) ? 'selected' : ''; @endphp
                                    <option value="{{ $pst->id }}" {{ $sel }}>{{ $pst->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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