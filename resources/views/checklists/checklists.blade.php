@extends('index')

@section('title1', 'Checklists')
@section('title2', 'Checklists')

@section('content')
<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12 col-lg-3">
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
                    <form method="post" data-action1="{{route('createChecklist')}}" data-action2="{{route('updateChecklist')}}" data-action="1">
                        <input type="hidden" name="id">
                        <label for="">Checklist</label>
                        <div>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="checklist"  value="0">
                                <span class="form-check-label">
                                    To do
                                </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="checklist"  value="1">
                                <span class="form-check-label">
                                    Doing
                                </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="checklist"  value="2">
                                <span class="form-check-label">
                                    Done
                                </span>
                            </label>
                        </div>



                        <label for="">Activity</label>
                        <textarea name="activity" id="activity" cols="20" rows="2" class="form-control"></textarea>
                        <label for="">Responsible for activity</label>
                        <select name="user" id="user" class="form-control">
                            <option value="">----</option>
                            @foreach ($users as $dados)
                                <option value="{{$dados->id}}">{{$dados->name}}</option>
                            @endforeach
                            
                        </select>
                        <label for="">Project</label>
                        <select name="project" id="project" class="form-control">
                            <option value="">----</option>
                            @foreach ($projects as $dados)
                                <option value="{{$dados->id}}">{{$dados->project}}</option>
                            @endforeach  
                        </select>
                        <label for="">Closure Date</label>
                        <input type="date" class="form-control" name="clDate" id="clDate">
                        <label for="">Deadline Date</label>
                        <input type="date" class="form-control" name="ddDate" id="ddDate">
                            <br>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="btn btn-primary form-control" name="save">Save</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Checklists</h5>
                </div>
                <div class="card-body">
                    <table id="table_checklist" class="display">
                        <thead>
                            <tr>
                                <th>Checklist</th>
                                <th>Activity</th>
                                <th>Responsible</th>
                                <th>Projects</th>
                                <th>Closure Date</th>
                                <th>Deadline Date</th>
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
    var tableChecklists = null;
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
    function updateTableChecklists(){
        $.ajax({
            url: '{{route('selectAllChecklists')}}',
            method: 'get',
            success:function(returned){
                tableChecklists.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    $(document).ready(function(){
        
        tableChecklists = $('#table_checklist').DataTable({
            columns:[{
                data:'checklist',
                render:function(data, type){
                    switch(data){
                        case 0: return 'To do';
                        case 1: return 'Doing';
                        case 2: return 'Done';
                        default: return 'Checklist not configurate';
                    }
                }
            },{
                data:'activity'
            },{
                data: 'name'
            },{
                data: 'project'
            },{
                data: 'closureDate'
            },{
                data:'deadlineDate'
            }],
            columnDefs:[{
                target:6,
                render:function(data){
                    return `<div class="dropdown" style="font-size: 0.589rem!important;">
                                <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Edits
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" title="Click to edit Checklist" name="edit"><i class="fa-solid fa-pen-to-square"></i> Edit Checklist</a></li>
                                    <li><a class="dropdown-item" title="Click to delete Checklist" name="delete"><i class="fa-solid fa-trash"></i> Delete Checklist</a></li>
                                </ul>
                            </div>`;
                }
            }]
        });

        updateTableChecklists();
        $('span:contains("{{$title2}}")').closest('li').addClass('active');
        $('[name="save"]').on('click', function(){
            try{
               // verifyForm();
                Swal.fire({
                    title: 'Do you want to save the user?',
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
                                
                                if($('form').attr('data-action') == 1){
                                    $('#register-alter').html('Register');
                                }else{
                                    $('#register-alter').html('Register');
                                    $('form').attr('data-action', 1)
                                }
                                updateTableChecklists()
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
        $(document).on('click','[name="delete"]',function(){
            let tr = $(this).closest('tr');

            try{
                Swal.fire({
                    title: 'Do you want to save the user?',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let data = tableChecklists.row(tr).data();
                        $.ajax({
                            url: '{{route('deleteChecklist')}}',
                            data: {id: data.id},
                            method: 'post',
                            assync: false,
                            success: function(returned){
                                Swal.fire('Deleted! Sucess Deleted', '', 'success')

                                updateTableChecklists()
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


        $(document).on('click', '[name="edit"]', function(){
            let tr = $(this).closest('tr');
            Swal.fire({
                title: 'Do you want to edit Checklist?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let data = tableChecklists.row(tr).data();
                    $('[name="id"]').val(data.id)
                    $('[name="clDate"]').val(data.closureDate)
                    $('[name="activity"]').val(data.activity)
                    $('[name="ddDate"]').val(data.deadlineDate)

                    $('[name="checklist"][value="' + data.checklist + '"]').attr('checked', 'checked')
                    $('[name="checklist"][value="' + data.checklist + '"]').prop('checked', true);

                    $('[name="user"] option[value="' + data.id_user + '"]').attr('selected', 'selected')
                    $('[name="user"] option[value="' + data.id_user + '"]').prop('selected', true)
                    
                    $('[name="project"] option[value="' + data.id_project + '"]').attr('selected', 'selected')
                    $('[name="project"] option[value="' + data.id_project + '"]').prop('selected', true)

                    $('form').attr('data-action', 2)
                    $('#cancel-alter').show();
                    $('#register-alter').html('Edit user');
                }
            });
        })
    })
</script>
@endpush