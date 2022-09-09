@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xl-12">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-sm-auto">
                            <h4>{{$web['title']}}</h4>
                        </div>
                        <div class="col-sm-auto">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                                    class="ri-add-line align-bottom me-1"></i> Tambah Pengguna</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width: 100%" id="myTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pengguna</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Telpon</th>
                                    <th scope="col">Hak Akses</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $u)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{$u->no_telp}}</td>
                                        <td>{{$u->role}}</td>
                                        <td>
                                            @if ($u->alamat != null)
                                                {{$u->alamat}}
                                            @else
                                                Alamat Belum Diatur
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" onclick="resetAlert({{$u->id}})" class="btn btn-sm btn-primary">Reset Password</a>
                                            <a href="#" onclick="editModal({{$u->id}})" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" onclick="deleteAlert({{$u->id}})" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->


                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end col -->
</div>

<!-- add modals -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Manual Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tambah.user') }}" method="post">
                    @csrf                    
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                Perhatian! Untuk Password User Di Generate Oleh Sistem. <br>
                                Default Password <b>(12345678)</b>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukan nama pengguna">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukan Email">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="no_telp" class="form-label">No Telpon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" required placeholder="Masukan No Telpon">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="aksesSelect">Hak Akses</label>
                                <select class="form-control" id="aksesSelect" name="akses">
                                    <option value="" selected disabled>Pilih Hak Akses</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <label for="alamat" class="form-label">Alamat <i>(Optional)</i></label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat"></textarea>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit modals -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna: <span id="nama_user"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editUserForm">
                    @csrf                    
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" id="nama_edit" name="nama" required placeholder="Masukan nama pengguna">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_edit" name="email" required placeholder="Masukan Email">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="no_telp" class="form-label">No Telpon</label>
                                <input type="text" class="form-control" id="no_telp_edit" name="no_telp" required placeholder="Masukan No Telpon">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="akses_edit">Hak Akses</label>
                                <select class="form-control" id="akses_edit" name="akses">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <label for="alamat" class="form-label">Alamat <i>(Optional)</i></label>
                                <textarea class="form-control" id="alamat_edit" name="alamat" placeholder="Masukan Alamat"></textarea>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('ex-js')
    <script>
        function editModal(id){
            $.ajax({
                url: "{{url('/user/edit')}}"+"/"+id,
                success: function(json){
                    if(json.status == 200){
                        $("#editUserForm").attr('action', "{{url('/user/edit')}}"+"/"+id);
    
                        $("#nama_edit").val(json.data.name);
                        $("#email_edit").val(json.data.email);
                        $("#no_telp_edit").val(json.data.no_telp);
                        $("#akses_edit").val(json.data.role);
                        $("#alamat_edit").val(json.data.alamat);
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: 'Tidak Ditemukan!',
                            text: 'Data User Tidak Ditemukan!',
                        });
                    }
                }
            });
            $('#editUserModal').modal('show');
        }

        function deleteAlert(id){
            Swal.fire({
                icon: 'question',
                title: 'Hapus data',
                text: 'Kamu yakin ingin menghapus data ini?',
                showDenyButton: true,
                confirmButtonText: 'Lanjut',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/user/hapus')}}"+"/"+id,
                        success: function(json){
                            if(json.status == 200){
                                Swal.fire('Data Berhasil dihapus!', '', 'success');
                                location.reload();
                            }else{
                                Swal.fire('Data Gagal dihapus!', '', 'error');
                                location.reload();
                            }
                        }
                    });
                }
            });
        }

        function resetAlert(id){
            Swal.fire({
                icon: 'question',
                title: 'Reset Password',
                text: 'Kamu yakin ingin reset password ini?',
                showDenyButton: true,
                confirmButtonText: 'Lanjut',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/user/resetpassword')}}"+"/"+id,
                        success: function(json){
                            if(json.status == 200){
                                Swal.fire('Password Berhasil diubah!', '', 'success');
                                location.reload();
                            }else{
                                Swal.fire('Password Gagal diubah!', '', 'error');
                                location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush