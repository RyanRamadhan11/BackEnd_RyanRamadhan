@extends('Admin.home')
@section('content')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Home</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('posts') }}">Data Master</a></li>
                <li class="breadcrumb-item active">Comments</li>
            </ol>
        </nav>
    <div class="card-header fw-bold">
        <i class="fa fa-folder" style="margin-right:4;"></i>
            DATA COMMENTS
    </div>

    <div class="mt-4" style="width:550px; margin-left:18px;">
        @if(Auth::user()->role != 'Customer')
        <a class="btn btn-sm" title="Tambah Comments" style="background-color: blue; color: white;"
            href=" {{ route('comments.create') }}">
            <i class="fa fa-plus-circle"></i> Add Comments
        </a>

        <a class="btn btn-danger btn-sm" title="Export to PDF" 
            href=" {{ url('comments-pdf') }}">
            <i class="fas fa-file-pdf"></i> Export to PDF
        </a>

        <a class="btn btn-success btn-sm" title="Export to Excel" 
            href=" {{ url('comments-excel') }}">
            <i class="fas fa-file-excel"></i> Export to Excel
        </a>
        @endif
    </div>

    <br />
            @if ($message = Session::get('success'))
            <div class="alert alert-success mt-5">
                <p>{{ $message }}</p>
            </div>
            @endif
            
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Content</th>
                    <th>Nama User</th>
                    <th>Title Post</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php 
					$no= 1; 
				@endphp
                @foreach($comments as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->content }}</td>
                    <td>{{ $row->post->title }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td width="15%">
                        <form method="POST" id="formDelete">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-dark btn-sm" title="Detail Comments"
                                href=" {{ route('comments.show',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            &nbsp;
                            @if(Auth::user()->role != 'Customer')
                            <a class="btn btn-warning btn-sm" title="Ubah Comments"
                                href=" {{ route('comments.edit',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <button type="submit" class="btn btn-danger btn-sm btnDelete" title="Hapus Comments"
                                data-action="{{ route('comments.destroy',$row->id) }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
    $('body').on('click', '.btnDelete', function(e) {
    e.preventDefault();
    var action = $(this).data('action');
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus data ini?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formDelete').attr('action', action);
            $('#formDelete').submit();
        }
    })
})
</script>
@endsection