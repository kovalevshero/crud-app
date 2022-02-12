<!DOCTYPE html>
<html>
    <head>
        <title>CRUD Employee</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.4/datatables.min.css"/>
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4 text-center">CRUD Employee</h1>
            @if (session('success'))
                <div class="alert alert-success"> {{ session('success') }}</div>
            @endif
            <div class="card-tools d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-sm mr-3 mb-3 btn-add" data-bs-toggle="modal" data-bs-target="#modal-create">Tambah Data</button>
            </div>
            <table class="table table-bordered employee-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        {{-- Modal create --}}
        <div class="modal fade" id="modal-create">
            <form action="/employee" method="POST">
                {{ csrf_field() }}
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input Data</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 col-xs-12">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control create-name">
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control create-email">
                            </div>            
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light bg-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-outline-light bg-success swalDefaultSuccess" id="process-create-name" data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        {{-- Modal edit --}}
        <div class="modal fade" id="modal-edit">
            <form action="/employee/update" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" class="form-control edit-id" value="">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Data</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 col-xs-12">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control edit-name">
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control edit-email">
                            </div>            
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light bg-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-outline-light bg-success swalDefaultSuccess" id="process-edit-employee" data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('.employee-table').DataTable({
                processing: true,
                serverSide: true,
                orderable: true, 
                searchable: true,
                ajax: "{{ route('employee.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name', 
                        name: 'name'
                    },
                    {
                        data: 'email', 
                        name: 'email'
                    },
                    {
                        render: function(data, type, row) {
                            return '<div class="d-flex justify-content-start">' +
                                '<button class="btn btn-sm btn-secondary btn-edit swalDefaultSuccess mx-1" data-toggle="tooltip" data-id=' + row.id + ' data-name=' + row.name + ' data-email=' + row.email + ' title="Ubah">Edit</button>' +
                                '<a class="btn btn-sm btn-danger btn-delete swalDefaultSuccess mx-1" data-toggle="tooltip" href="/employee/delete/' + row.id + '" data-id=' + row.id + ' title="Hapus">Delete</a>' +
                            '</div>'
                        },
                    },
                ]
            })

            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id')
                let name = $(this).data('name')
                let email = $(this).data('email')

                $('#modal-edit .edit-id').val(id)
                $('#modal-edit .edit-name').val(name)
                $('#modal-edit .edit-email').val(email)
                $('#modal-edit').modal('show')
            })
        })
    </script>
</html>