@extends('index')

@section('title1', 'Projects')
@section('title2', 'Notes')

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
                    <form method="post" data-action1="{{route('createNote')}}" data-action2="{{route('updateNote')}}" data-action="1">
                        <input type="hidden" name="id">
                        <label for="">Note</label>
                        <input type="text" name="note" class="form-control" placeholder="Note" required>
                        <label for="">Projects</label>
                        <select name="id_project" id="id_project" class="form-control">
                            <option value="">----</option>
                            @foreach ($projects as $dados)
                                <option value="{{$dados->id}}">{{$dados->project}} </option>
                            @endforeach
                        </select>
                            <br>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="btn btn-primary form-control" name="save">Save</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Notes</h5>
                </div>
                <div class="card-body">
                    <table id="table_note" class="display">
                        <thead>
                            <tr>
                                <th>Notes</th>
                                <th>Projects</th>
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
    var tableNotes = null;
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

    function clearInputsForm(){
        $.each($('form')[0], function(id, el){
            if(['radio', 'check'].includes($(el).attr('type'))){
                $(el).removeAttr('checked')
                $(el).prop('checked', false);
            }else{
                $(el).val('');
            }
        });
    }

    function updateTableNotes(){
        $.ajax({
            url: '{{route('selectAllNotes')}}',
            method: 'get',
            success:function(returned){
                tableNotes.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    $(document).ready(function(){
        updateTableNotes();
        tableNotes = $('#table_note').DataTable({
            columns:[{
                data:'note'
            },{
                data:'project'
            }],
            columnDefs:[{
                target:2,
                render:function(data){
                    return `<div class="dropdown" style="font-size: 0.589rem!important;">
                                <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Edits
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" title="Click to edit note" name="edit"><i class="fa-solid fa-pen-to-square"></i> Edit note</a></li>
                                    <li><a class="dropdown-item" title="Click to delete project" name="delete"><i class="fa-solid fa-trash"></i> Delete project</a></li>
                                </ul>
                            </div>`;
                }
            }]
        });
        $('span:contains("{{$title2}}")').closest('li').addClass('active');
        $('[name="save"]').on('click', function(){
            try{
                //verifyForm();
                Swal.fire({
                    title: 'Do you want to save the note?',
                    // showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let dataAction = 'data-action' + $('form').attr('data-action');
                        $.ajax({
                            url: $('form').attr(dataAction),
                            data: $('form').serialize(),
                            method: 'post',
                            assync: false,
                            success: function(returned){
                                Swal.fire('Saved! ' + returned, '', 'success')
                                clearInputsForm();
                                $('#cancel-alter').hide();
                                $('#status').hide();
                                $('[name="status"]').attr('checked', 'checked')
                                $('[name="status"]').prop('checked', true);
                                if($('form').attr('data-action') == 1){
                                    $('#register-alter').html('Register');
                                }else{
                                    $('#register-alter').html('Register');
                                    $('form').attr('data-action', 1)
                                }

                                updateTableNotes()
                            },
                            error: function(error, jhrx){
                                Swal.fire('Error! Something went wrong, please try again.', '', 'error')
                                console.log(error, jhrx);
                            }
                        });
                    }
                });
            }catch(e){
                Swal.fire('Error! ' + e, '', 'error')
            }
        });

        $('form').attr('action', $('form').attr('data-action1'))
        $('#cancel-alter').on('click', function(){
            Swal.fire({
                title: 'Do you want to cancel the alter?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('form').attr('data-action', 1)
                    $('form').attr('action', $('form').attr('data-action1'))
                    clearInputsForm();
                    $('#cancel-alter').hide();
                    $('#register-alter').html('Register');
                }
            });
        });

        $(document).on('click', '[name="edit"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to edit note?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let data = tableNotes.row(tr).data();
                    $('[name="id"]').val(data.id)
                    $('[name="note"]').val(data.note)
                    $('[name="id_project"] option[value="' + data.id_project + '"]').attr('selected', 'selected')
                    $('[name="id_project"] option[value="' + data.id_project + '"]').prop('selected', true)
                    $('form').attr('data-action', 2)
                    $('#cancel-alter').show();
                    $('#register-alter').html('Edit note');
                }
            });
        })

        $(document).on('click','[name="delete"]',function(){
            let tr = $(this).closest('tr');

            try{
                Swal.fire({
                    title: 'Do you want to save the note?',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let data = tableNotes.row(tr).data();
                        $.ajax({
                            url: '{{route('deleteNote')}}',
                            data: {id: data.id},
                            method: 'post',
                            assync: false,
                            success: function(returned){
                                Swal.fire('Deleted! Sucess Deleted', '', 'success')

                                updateTableNotes()
                            },
                            error: function(error, jhrx){
                                Swal.fire('Error! Something went wrong, please try again.', '', 'error')
                                console.log(error, jhrx);
                            }
                        });
                    }
                });
            }catch(e){
                Swal.fire('Error! ' + e, '', 'error')
            }

        })


    })
</script>
@endpush