@extends('layouts.dashboard')
@section('title', 'Laporan')
@section('laporan', 'active')

@section('content')

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    
    <section class="section">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-3 row">
                        <div class="col-auto">
                            <input type="text" name="daterange" class="form-control daterange w-100" />
                            <input type="hidden" class="startDate" />
                            <input type="hidden" class="endDate" />
                        </div>
                        <div class="col-auto">
                            <button type="reset" class="btn btn-danger" id="reset">Reset</button>
                        </div>
                        
                    </div>
                    <div class="col-9 d-flex justify-content-end align-items-end">
                        <a href="{{ route('dashboard.laporan.export') }}">
                            <button class="btn btn-primary">Export</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Parkir</th>
                                <th>Nomor Plat</th>
                                <th>Merk</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Tarif</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('after-script')
    <script>

        $(document).ready(function () {
            let datatable = $('#table1').DataTable({
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
                    url:"{{ route('dashboard.laporan') }}",
                    type: "GET",
                    'data': function(data){

                        let startDate = $('.startDate').val();
                        let endDate = $('.endDate').val();

                        data.startDate = startDate;
                        data.endDate = endDate;
                    }
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
                        data: 'no_polisi'      
                    },
                    {
                        data: 'merk'     
                    },
                    {
                        data: 'tgl_masuk', 
                    },
                    {
                        data: 'parkir_keluar.tgl_keluar',
                    },
                    {
                        data: 'parkir_keluar.tarif',
                        render: function(data) {
                            let getDataUang = parseInt(data).toLocaleString()
                            let changeComma = getDataUang.replace(',', '.')
                            return 'Rp. ' + changeComma
                        }
                    },
                ]
            });

            var start = moment();
            var end = moment();
            $('.daterange').daterangepicker({
                "startDate": start,
                "endDate": end,
                }, function(start, end, label) {
                    startDate = $('.startDate').val(start.format('YYYY-MM-DD'))
                    endDate = $('.endDate').val(end.format('YYYY-MM-DD'))
                    datatable.ajax.reload()
                }
            );

            $('#reset').on('click', function(){
                startDate = $('.startDate').val(null);
                endDate = $('.endDate').val(null);
                datatable.ajax.reload()
            })

        });

    </script>
@endpush