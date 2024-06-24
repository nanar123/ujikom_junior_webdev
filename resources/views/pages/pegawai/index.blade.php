@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h4>Table Pegawai</h4>
                    </div>
                    <div class="card-body px-20 pt-20 pb-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <button type="button" class="btn btn-xs btn-outline-primary m-2 ms-auto"
                                    data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fas fa-plus m-1"></i> Tambah
                                </button>
                            </div>
                            <table id="table-pegawai" class="table align-items-center mb-0 table-striped table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                            Foto
                                        </th> --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 text-start">
                                            No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">
                                            Nama</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ">
                                            Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-1">
                                            No Hp</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-1">
                                            Alamat</th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                            Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawais as $pegawai)
                                        <tr>
                                            {{-- <td>
                                                @if ($pegawai->avatar == null)
                                                    <span class="badge bg-warning text-dark">Tidak ada Foto</span>
                                                @else
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('storage/' . $pegawai->avatar) }}"
                                                        alt="{{ $pegawai->name }}" width="50">
                                                @endif
                                            </td> --}}

                                            <td class="text-start">{{ $loop->iteration }}</td>
                                            <td>{{ $pegawai->name }}</td>
                                            <td>{{ $pegawai->email }}</td>

                                            <td>
                                                @if ($pegawai->phone_number == null)
                                                    <span class="badge badge-secondary">
                                                        <i class="bi bi-telephone"></i></span>
                                                @else
                                                    {{ $pegawai->phone_number }}
                                                @endif
                                            </td>

                                            <td>{{ $pegawai->alamat }}</td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-xs btn-warning"
                                                            onclick="openEditModal('{{ $pegawai->id }}')"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-xs btn-danger"
                                                            onclick="deleteUser('{{ $pegawai->id }}')"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                            data-bs-confirm="Apakah Anda yakin ingin menghapus pengguna ini?">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add User --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark m-2" id="addModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nama</label>
                            <input required type="text" class="form-control" id="addName" name="name">
                            {{-- <div id="nameHelp" class="form-text"></div> --}}
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email address</label>
                            <input required type="email" class="form-control" id="addEmail" name="email">

                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password</label>
                            <input required type="password" class="form-control" id="addPassword" name="password">

                        </div>
                        <div class="mb-3">
                            <label for="addNoPhone" class="form-label">No Phone</label>
                            <input required type="tel" class="form-control" id="addNoPhone" name="phone_number">

                        </div>
                        <div class="mb-3">
                            <label for="addAlamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="addAlamat" rows="3" name="alamat"></textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="addAvatar" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="addAvatar" name="avatar">
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="createUser()">Save </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Add User --}}


    {{-- Edit User --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark m-2" id="editModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input required type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email address</label>
                            <input required type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input required type="password" class="form-control" id="editPassword" name="password">

                        </div>
                        <div class="mb-3">
                            <label for="editNoPhone" class="form-label">No Phone</label>
                            <input required type="tel" class="form-control" id="editNoPhone" name="phone_number">

                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editAlamat" rows="3" name="alamat"></textarea>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="editAvatar" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="editAvatar" name="avatar">
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editUser(userId)">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Edit User --}}
@endsection


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        let userId = null;

        $('#addModal').on('show.bs.modal', function(e) {
            $('#addForm').trigger('reset');
            $('#addForm input').removeClass('is-invalid');
            $('#addForm .invalid-feedback').remove();
        });

        $('#editModal').on('show.bs.modal', function(e) {
            $('#addForm').trigger('reset');
            $('#editForm input').removeClass('is-invalid');
            $('#editForm .invalid-feedback').remove();
        });

        function createUser() {
            const url = "{{ route('api.pegawais.store') }}";

            // Ambil form data
            let formData = new FormData();
            formData.append('name', $('#addName').val());
            formData.append('email', $('#addEmail').val());
            formData.append('password', $('#addPassword').val());
            formData.append('phone_number', $('#addNoPhone').val());
            formData.append('alamat', $('#addAlamat').val());
            // formData.append('avatar', $('#addAvatar').prop('files')[0]);

            // Kirim data ke server POST /users
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Tampilkan pesan sukses
                    toastr.success(response.message, 'Sukses');

                    // Reload halaman setelah 3 detik
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function(error) {
                    // Ambil response error
                    let response = error.responseJSON;

                    // Tampilkan pesan error
                    toastr.error(response.message, 'Error');
                }
            });
        }


        // function editUser() {
        //     const url = {{ route('api.pegawais.update', ':userId') }}; // Ganti dengan URL endpoint yang sesuai

        //     // Ambil form data
        //     let formData = new FormData();
        //     formData.append('name', $('#editName').val());
        //     formData.append('email', $('#editEmail').val());
        //     formData.append('password', $('#editPassword').val());
        //     formData.append('alamat', $('#editAlamat').val()); // Memperbarui ini menjadi editAlamat
        //     formData.append('phone_number', $('#editNoPhone').val());
        //     formData.append('avatar', $('#editAvatar').prop('files')[0]);

        //     formData.append('_method', 'PUT'); // Menyertakan method PUT

        //     // Kirim data ke server dengan metode PUT
        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             toastr.success(response.message, 'Sukses');

        //             setTimeout(() => {
        //                 location.reload();
        //             }, 1000);
        //         },
        //         error: function(xhr) {
        //             let response = xhr.responseJSON;
        //             toastr.error(response ? response.message : 'Gagal mengupdate user', 'Error');
        //         }
        //     });
        // }

        function editUser() {
            let url = "{{ route('api.pegawais.update', ':userId') }}";
            url = url.replace(':userId', userId);

            // Ambil form data
            let data = {
                name: $('#editName').val(),
                email: $('#editEmail').val(),
                password: $('#editPassword').val(),
                phone_number: $('#editNoPhone').val(),
                alamat: $('#editAlamat').val(),
                // avatar: $('#addAvatar').prop('files')[0];
                _method: 'PUT'

            };

            // Kirim data ke server POST /users
            $.post(url, data)
                .done((response) => {
                    // Tampilkan pesan sukses
                    toastr.success(response.message, 'Sukses');

                    // Reload halaman setelah 3 detik
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                })
                .fail((error) => {
                    // Ambil response error
                    let response = error.responseJSON;

                    // Tampilkan pesan error
                    toastr.error(response.message, 'Error');
                });

            if (response.errors) {
                // loop object errors
                for (const error in response.errors) {
                    // cari input name yang error pada #editForm
                    let input = $(`#editForm input[name="${error}"]`)

                    // tambahkan class is-invalid pada input
                    input.addClass('is-invalid');

                    // buat elemen class="invalid-feedback"
                    let feedbackElement = `<div class="invalid-feedback">`
                    feedbackElement += `<ul class="list-unstyled">`
                    response.errors[error].forEach((message) => {
                        feedbackElement += `<li>${message}</li>`
                    })
                    feedbackElement += `</ul>`
                    feedbackElement += `</div>`

                    // tambahkan class invalid-feedback setelah input
                    input.after(feedbackElement)
                }
            }
        }


        function deleteUser(userId) {

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Pegawai akan dihapus, kamu tidak bisa mengembalikannya lagi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    let url = "{{ route('api.pegawais.destroy', ':userId') }}";
                    url = url.replace(':userId', userId);

                    $.post(url, {
                            _method: 'DELETE'
                        })
                        .done((response) => {
                            toastr.success(response.message, 'Sukses')

                            setTimeout(() => {
                                location.reload()
                            }, 1000);
                        })
                        .fail((error) => {
                            toastr.error('Gagal menghapus ', 'Error')
                        })
                }
            })
        }


        function openEditModal(id) {
            userId = id;

            let url = '{{ route('api.pegawais.show', ':userId') }}';
            url = url.replace(':userId', userId);

            $.get(url)
                .done((response) => {
                    // isi form editModal dengan data user
                    $('#editName').val(response.data.name);
                    $('#editEmail').val(response.data.email);
                    $('#editNoPhone').val(response.data.phone_number);
                    $('#editAlamat').val(response.data.alamat); // Memperbarui ini menjadi editAlamat
                    // $('#editAvatar').val(response.data.avatar);

                    // tampilkan modal editModal
                    $('#editModal').modal('show');
                })
                .fail((error) => {
                    // tampilkan pesan error
                    toastr.error('Gagal mengambil data user', 'Error');
                });
        }




        new DataTable('#table-pegawai');
    </script>
@endpush
