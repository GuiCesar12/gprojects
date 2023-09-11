@extends('index')

@section('title1', 'Administrator')
@section('title2', $title2)

@section('content')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12 col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <div class="row">
                            <div class="col-6 col-lg-6" id="register-alter">Register</div>
                            <div class="col-6 col-lg-6" id="cancel-alter" style="text-align: right!important; cursor: pointer; display:none;">
                                <button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 0.589rem!important;"><i class="align-middle " data-feather="x-square" style=""></i> Cancel</button>
                                
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="post" name="variables"data-action1="{{route('create' . $variable)}}" data-action2="{{route('update'.$variable)}}" data-action="1">
                        <input type="hidden" name="id">
                        <label for="">{{$variable}}</label>
                        <input type="text" name="{{strtolower($variable)}}" class="form-control" placeholder="Type a {{$variable}}" required>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="btn btn-primary form-control" name="save">Save</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{$variable}}</h5>
                </div>
                <div class="card-body">
                    <table id="table_user" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{$variable}}</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('links')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    var tableUser = null;
    function verifyForm(){
        $.each($('[name="variables"]')[0], function(id, el){
            switch($(el).attr('type')){
                case 'radio':
                case 'check':
                    let name = $(el).attr('name');
                    if(!$('[name="' + name + '"]').is(':checked')){
                        throw 'Selected a profile';
                    }
                    break;
                case 'hidden':
                    if($('[name="variables"]').attr('data-action') == 2 && $(el).attr('type') == 'hidden' && $(el).val().trim() == ''){
                        throw 'Error to alter, click in ícon alter and make again.';
                    }
                    break;
                case 'button':
                    break;
                default:
                    if($(el).val().trim() == ''){
                        console.log($(el).attr('type'))
                        $(el).focus();
                        let type = $(el).attr('type') == 'email' ? 'e-mail' : '{{$variable}}';
                        throw 'Type a ' + type + ' for continue';
                    }
                    
                    if($(el).attr('type') == 'email'){
                        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

                        if (!$(el).val().match(validRegex)){
                            throw 'E-mail type invalid, try again to continue';
                        }
                    }
            }
        });
    }

    function clearInputsForm(){
        $.each($('[name="variables"]')[0], function(id, el){
            if(['radio', 'check'].includes($(el).attr('type'))){
                $(el).removeAttr('checked')
                $(el).prop('checked', false);
            }else{
                $(el).val('');
            }
        });
    }

    function updateTableVariables(){
        $.ajax({
            url: '{{route('selectAll' . $variable. 's')}}',
            method: 'get',
            success:function(returned){
                console.log(returned)
                tableUser.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    $(document).ready(function(){
        updateTableVariables();
        tableUser = $('#table_user').DataTable({
            scrollX: true,
            responsive: true,
            columns:[{
                data:'{{strtolower($variable)}}'
                // data:'{{strtolower($variable)}}'
            }],
            columnDefs:[{
                target:1,
                render:function(data){
                    return `<div class="dropdown" style="font-size: 0.589rem!important;">
                                <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" " title="Click to edit {{$variable}}" name="edit-{{$variable}}"><i class="fa-solid fa-pen-to-square"></i> Edit {{$variable}}</a></li>
                                    <li><a class="dropdown-item"  title="Click to delete {{$variable}}" name="remove-{{$variable}}"><i class="fa-solid fa-trash"></i> Delete {{$variable}}</a></li>
                                </ul>
                            </div>`;
                }
            }]
        });
        $('span:contains("{{$title2}}")').closest('li').addClass('active');
        $('[name="status"]').attr('checked', 'checked')
        $('[name="status"]').prop('checked', true);
        $('[name="save"]').on('click', function(){
            try{
                verifyForm();
                Swal.fire({
                    title: 'Do you want to save the {{$variable}} ?',
                    // showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let dataAction = 'data-action' + $('[name="variables"]').attr('data-action');
                        $.ajax({
                            url: $('[name="variables"]').attr(dataAction),
                            data: $('[name="variables"]').serialize(),
                            method: 'post',
                            assync: false,
                            success: function(returned){
                                Swal.fire('Saved with success!', '', 'success')
                                clearInputsForm();
                                $('#cancel-alter').hide();
                                $('#status').hide();
                                $('[name="status"]').attr('checked', 'checked')
                                $('[name="status"]').prop('checked', true);
                                if($('[name="variables"]').attr('data-action') == 1){
                                    $('#register-alter').html('Register');
                                }else{
                                    $('#register-alter').html('Register');
                                    $('[name="variables"]').attr('data-action', 1)
                                }

                                updateTableVariables()
                            },
                            error: function(error, jhrx){
                                
                                Swal.fire('Error! ' + error.responseText, '', 'error')
                                // Swal.fire('Error! Something went wrong, please try again.', '', 'error')
                                console.log(error, jhrx);
                            }
                        });
                    }
                });
            }catch(e){
                Swal.fire('Error! ' + e, '', 'error')
            }
        });

        $('[name="variables"]').attr('action', $('[name="variables"]').attr('data-action1'))
        $('#cancel-alter').on('click', function(){
            Swal.fire({
                title: 'Do you want to cancel the alter?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('[name="variables"]').attr('data-action', 1)
                    $('[name="variables"]').attr('action', $('[name="variables"]').attr('data-action1'))
                    clearInputsForm();
                    $('[name="status"]').attr('checked', 'checked')
                    $('[name="status"]').prop('checked', true);
                    $('#cancel-alter').hide();
                    $('#status').hide();
                    $('#register-alter').html('Register');
                }
            });
        });

        $(document).on('click', '[name="edit-{{$variable}}"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to edit {{$variable}}?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#status').show();
                    let data = tableUser.row(tr).data();
                    $('[name="id"]').val(data.id)
                    $('[name="{{strtolower($variable)}}"]').val(data.{{strtolower($variable)}})
                    $('[name="variables"]').attr('data-action', 2)
                    $('#cancel-alter').show();
                    $('#register-alter').html('Edit {{$variable}}');
                }
            });
        });

        $(document).on('click', '[name="remove-{{$variable}}"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to remove {{$variable}}?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let tr = $(this).closest('tr');
                    let data = tableUser.row(tr).data();
                    $.ajax({
                        url: '{{ route('delete' . $variable) }}',
                        data: {id: data.id, status: data.status},
                        method: 'post',
                        assync: false,
                        success: function(returned){
                            Swal.fire('Removed! {{$variable}} success', '', 'success')
                            updateTableVariables()
                        },
                        error: function(error, jhrx){
                            Swal.fire('Error!',"'"+error.responseText+"'" , 'error')
                            console.log(error, jhrx);
                        }
                    });
                }
            });
        });
    });
</script>
@endpush