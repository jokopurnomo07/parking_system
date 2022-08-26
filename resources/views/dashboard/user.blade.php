@extends('layouts.dashboard')
@section('title', 'Parkir')
@section('dashboard', 'active')

@section('content')

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            @foreach(\Session::get('error') as $key => $error)
                <li>{{ \Session::get('error')[$key][0] }}</li>
            @endforeach
            
        </ul>
    </div>
@endif

<div class="page-content">
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class = "card-content" > 
                        <div class="card-body">
                            <h4 class="card-title">Masuk Parkir</h4>
                            <form class="form" method="post" action="{{ route('dashboard.parkir.masuk') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="no_polisi">Plat Nomor</label>
                                    <input
                                        type="text"
                                        id="no_polisi"
                                        class="form-control"
                                        placeholder="Nomor Polisi"
                                        name="no_polisi"/>
                                </div>
                                <div class="form-group">
                                    <label for="merk_kendaraan">Merk Kendaraan</label>
                                    <input
                                        type="text"
                                        id="merk_kendaraan"
                                        class="form-control"
                                        placeholder="Merk Kendaraan"
                                        name="merk_kendaraan"/>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-block btn-primary me-1">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class = "card-content" > 
                        <div class="card-body">
                            <h4 class="card-title">Keluar Parkir</h4>
                            <form class="form" method="post" action="{{ route('dashboard.parkir.keluar') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_parkir">Kode Parkir</label>
                                    <input
                                        type="text"
                                        id="kode_parkir"
                                        class="form-control"
                                        placeholder="Kode Parkir"
                                        name="kode_parkir"/>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-block btn-primary me-1">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card" > 
            <div class="card-header">
                <h3>Daftar Kendaraan</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Parkir</th>
                            <th>Plat Nomor</th>
                            <th>Merk Kendaraan</th>
                            <th>Tanggal Masuk</th>
                            <th>Jam Masuk</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>


<!--Modal For Tarif Parkir -->
@if (\Session::has('modal'))
    <div id="myModal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" > 
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">
                        Tarif Parkir
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Kode Parkir : {{ Session::get('data')->kode_parkir }}</li>
                        <li class="list-group-item">No Polisi : {{ Session::get('data')->no_polisi }}</li>
                        <li class="list-group-item">Merk Kendaraan : {{ Session::get('data')->merk }}</li>
                        <li class="list-group-item">Tanggal & Jam Masuk : {{ Session::get('data')->tgl_masuk }}, {{ Session::get('data')->time_masuk }}</li>
                        <li class="list-group-item">Tarif : {{ Session::get('tarif') }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div> 
    </div>
@endif

@endsection

@push('after-script')
    @if (\Session::has('modal'))
        <script>
            $(window).on('load',function(){
                $('#myModal').modal('show');
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {
            $('#table1').DataTable({
                bFilter: true,
                destroy: true,
                processing: true,
                serverSide: true,
                oLanguage: {
                    sZeroRecords: "Tidak Ada Data",
                    sSearch: "Pencarian _INPUT_",
                    sLengthMenu: "_MENU_",
                    sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    sInfoEmpty: "0 data",
                    oPaginate: {
                        sNext: "<i class='fa fa-angle-right'></i>",
                        sPrevious: "<i class='fa fa-angle-left'></i>"
                    }
                },
                ajax: {
                    url:"{{ route('dashboard.user') }}",
                    type: "GET"
                },
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        name: 'DT_Row_Index', 
                        "className": "text-center" ,
                        orderable: false, 
                        searchable: false
                    },
                    {
                        data: 'kode_parkir',                                    
                    },
                    {
                        data: 'no_polisi',                                    
                    },
                    {
                        data: 'merk',                                    
                    },
                    {
                        data: 'tgl_masuk',                                    
                    },
                    {
                        data: 'time_masuk',                                    
                    },
                ]
            });
        });
    </script>
@endpush