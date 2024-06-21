@extends('index')

@section('title1', 'Administrator')
@section('title2', 'Users')

@section('content')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12 col-lg-4">
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
                    <form method="post" data-action1="{{route('insertUser')}}" data-action2="{{route('alterUser')}}"data-action="1" name="formUsers" >
                        <input type="hidden" name="id">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                        <label for="">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <label for="">Profile</label>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="profile"  value="0">
                                <span class="form-check-label">
                                    Administrator
                                </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="profile"  value="1">
                                <span class="form-check-label">
                                    Project
                                </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="profile"  value="2">
                                <span class="form-check-label">
                                    Manager
                                </span>
                            </label>
                        </div>
                        <div id="status" style="display:none;">
                            <label for="">Status</label>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"  value="1">
                                    <span class="form-check-label">
                                        Active
                                    </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"  value="0">
                                    <span class="form-check-label">
                                        Inactive
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="btn btn-primary form-control" name="save">Save</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users</h5>
                </div>
                <div class="card-body">
                    <table id="table_user" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Profile</th>
                                <th>Status</th>
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
    // function verifyForm(){
    //     $.each($('form')[0], function(id, el){
    //         switch($(el).attr('type')){
    //             case 'radio':
    //             case 'check':
    //                 let name = $(el).attr('name');
    //                 if(!$('[name="' + name + '"]').is(':checked')){
    //                     throw 'Selected a profile';
    //                 }
    //                 break;
    //             case 'hidden':
    //                 if($('form').attr('data-action') == 2 && $(el).attr('type') == 'hidden' && $(el).val().trim() == ''){
    //                     throw 'Error to alter, click in ícon alter and make again.';
    //                 }
    //                 break;
    //             case 'button':
    //                 break;
    //             default:
    //                 if($(el).val().trim() == ''){
    //                     console.log($(el).attr('type'))
    //                     $(el).focus();
    //                     let type = $(el).attr('type') == 'email' ? 'e-mail' : 'name';
    //                     throw 'Type a ' + type + ' for continue';
    //                 }
                    
    //                 if($(el).attr('type') == 'email'){
    //                     var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    //                     if (!$(el).val().match(validRegex)){
    //                         throw 'E-mail type invalid, try again to continue';
    //                     }
    //                 }
    //         }
    //         // if(['radio', 'check'].includes($(el).attr('type'))){
    //         // }else{
    //         //     if($('form').attr('data-action') == 2 && $(el).attr('type') == 'hidden' && $(el).val().trim() == ''){
    //         //         throw 'Error to alter, click in ícon alter and make again.';
    //         //     }else{
    //         //         if($(el).val().trim() == ''){
    //         //             console.log($(el).attr('type'))
    //         //             $(el).focus();
    //         //             let type = $(el).attr('type') == 'email' ? 'e-mail' : 'name';
    //         //             throw 'Type a ' + type + ' for continue';
    //         //         }
    //         //     }
    //         // }
    //     });
    // }
    // function validateEmail(email) {
    //     // Expressão regular para validar o formato do e-mail
    //     var emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/i
    //     return emailRegex.test(email);
    //   }


    function clearInputsForm(){
        $.each($('[name="formUsers"]')[0], function(id, el){
            if(['radio', 'check'].includes($(el).attr('type'))){
                $(el).removeAttr('checked')
                $(el).prop('checked', false);
            }else{
                $(el).val('');
            }
        });
    }

    function updateTableUsers(){
        $.ajax({
            url: '{{route('selectAllUser')}}',
            method: 'get',
            success:function(returned){
                tableUser.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    $(document).ready(function(){
        updateTableUsers();
        tableUser = $('#table_user').DataTable({
            scrollX: true,
        responsive: true,
            columns:[{
                data:'name'
            },{
                data:'email'
            },{
                data:'profile',
                render:function(data, type){
                    switch(data){
                        case 0: return 'Administrator';
                        case 1: return 'Project';
                        case 2: return 'Manager';
                        default: return 'Profile not configurate';
                    }
                }
            },{
                data:'status',
                render:function(data, type){
                    switch(data){
                        case 0: return 'Inactive';
                        case 1: return 'Active';
                        default: return 'Status not configurate';
                    }
                }
            }],
            columnDefs:[{
                target:4,
                render:function(data){
                    return `<div class="dropdown" style="font-size: 0.589rem!important;">
                                <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Edits
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" title="Click to edit user" name="edit"><i class="fa-solid fa-pen-to-square"></i> Edit user</a></li>
                                    <li><a class="dropdown-item" href="#" title="Click to edit status" name="edit-status"><i class="fa-solid fa-rotate-right"></i> Edit status</a></li>
                                </ul>
                            </div>`;
                }
            }]
        });
        $('.feather-users:first').closest('li').addClass('active');
        $('[name="status"]').attr('checked', 'checked')
        $('[name="status"]').prop('checked', true);
        $('[name="save"]').on('click', function(){
           
            try{
                // verifyForm();
                // if(validateEmail($('[name="email"]').val()) == false){
                                
                //     throw new Error('Invalid Email')
                // }
                Swal.fire({
                    title: 'Do you want to save the user?',
                    // showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let dataAction = 'data-action' + $('[name="formUsers"]').attr('data-action');
                        
                        $.ajax({
                            url: $('[name="formUsers"]').attr(dataAction),
                            data: $('[name="formUsers"]').serialize(),
                            method: 'post',
                            assync: false,
                            success: function(returned){
                               
                                clearInputsForm();
                                $('#cancel-alter').hide();
                                $('#status').hide();
                                $('[name="status"]').attr('checked', 'checked')
                                $('[name="status"]').prop('checked', true);

                                
                                if($('[name="formUsers"]').attr('data-action') == 1){
                                    $('#register-alter').html('Register');
                                }else{
                                    $('#register-alter').html('Register');
                                    $('[name="formUsers"]').attr('data-action', 1)
                                }
                                updateTableUsers()
                                Swal.fire('Saved! ' + returned, '', 'success')
                            },
                            error: function(error, jhrx){
                                Swal.fire('Error!', error.responseText, 'error')
                                console.log(error, jhrx);
                            }
                        });
                    }
                });
            }catch(e){
                Swal.fire('Error! ' + e, '', 'error')
            }
        });

        $('[name="formUsers"]').attr('action', $('[name="formUsers"]').attr('data-action1'))
        $('#cancel-alter').on('click', function(){
            Swal.fire({
                title: 'Do you want to cancel the alter?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('[name="formUsers"]').attr('data-action', 1)
                    $('[name="formUsers"]').attr('action', $('[name="formUsers"]').attr('data-action1'))
                    clearInputsForm();
                    $('[name="status"]').attr('checked', 'checked')
                    $('[name="status"]').prop('checked', true);
                    $('#cancel-alter').hide();
                    $('#status').hide();
                    $('#register-alter').html('Register');
                }
            });
        });

        $(document).on('click', '[name="edit"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to edit user?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#status').show();
                    let data = tableUser.row(tr).data();
                    $('[name="id"]').val(data.id)
                    $('[name="name"]').val(data.name)
                    $('[name="email"]').val(data.email)
                    $('[name="profile"][value="' + data.profile + '"]').attr('checked', 'checked')
                    $('[name="profile"][value="' + data.profile + '"]').prop('checked', true);
                    $('[name="status"][value="' + data.status + '"]').attr('checked', 'checked')
                    $('[name="status"][value="' + data.status + '"]').prop('checked', true);
                    $('[name="formUsers"]').attr('data-action', 2)
                    $('#cancel-alter').show();
                    $('#register-alter').html('Edit user');
                }
            });
        })

        $(document).on('click', '[name="edit-status"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to edit status user?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let tr = $(this).closest('tr');
                    let data = tableUser.row(tr).data();
                    $.ajax({
                        url: '{{ route('alterStatus') }}',
                        data: {id: data.id, status: data.status},
                        method: 'post',
                        assync: false,
                        success: function(returned){
                            Swal.fire('Saved! Status modify success', '', 'success')
                            updateTableUsers()
                        },
                        error: function(error, jhrx){
                            Swal.fire('Error!', error.responseText, 'error')
                            console.log(error, jhrx);
                        }
                    });
                }
            });
        })
    })
</script>
@endpush