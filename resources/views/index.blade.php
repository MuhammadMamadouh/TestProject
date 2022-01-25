@extends('layout.master')
@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>{{$title}}</h5>
            <a href={{$createLink}} class="btn btn-primary">New Rocord</a>
        </div>
        <div class="card-body vendor-table">
            <table class="display" id="basic-1">
                <thead>
                    <tr>
                        @foreach ($attributes as $attr)
                        <th>{{$attr['text']}}</th>
                        @endforeach
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

</div>

<!-- footer end-->
</div>
</div>
@endsection
@section('scripts')
<!-- Datatables js-->
<script src="{{asset('js/datatables/jquery.dataTables.min.js')}}"></script>
<script>
   
    table = $('#basic-1').DataTable({
    processing: true,
    destroy: true,
    serverSide: true,
    buttons: ['copy', 'excel', 'pdf', 'colvis'],
    autoWidth: false,
    pageLength: 25,
    "order": [[0, "desc"]],
    ajax: '{{ \Illuminate\Support\Facades\Request::fullUrl() }}',
    columns: [
    {data: 'id', name: 'DT_RowIndex', width: '5%'},

    @foreach($attributes as $column)
    {
    data: '{{$column['value']}}',
    name: '{{$column['value']}}',
    title: '{{ $column['text']}}',
    width: '15%'
    },
    @endforeach
    ],
    });

    $('body').on('click', '.delbtn', function (e) {
    e.preventDefault();
    let form = $(this).closest('form');
    let action = form.attr('action');
    Swal.fire({
    title: 'Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    }).then((result) => {
    
    if (result.isConfirmed) {
    $.ajax({
    url: action,
    type: 'DELETE',
    data:
    {_token: '{{csrf_token()}}'},
    success: function (data) {
    
    Swal.fire(
    '{{\App\Helpers\ResponseMessages::DELETED}}',
    data,
    'success'
    )
   $('#basic-1').DataTable().ajax.reload();
    }
    });
    
    }
    })
    });
</script>
@endsection