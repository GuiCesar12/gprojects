var tableChecklist = null;

function updateTableChecklists(){
    $.ajax({
        url: 'checklkists/action/selectChecklists',
        method: 'post',
        success:function(returned){
            tableChecklists.clear().rows.add(returned).draw();
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}




$(document).ready(function(){        
    $(document).on('click','[name="modal"]',function(){
        let tr = $(this).closest('tr')
        let dataProject = tableProjects.row(tr).data()
        function filterChecklist(){
            $.ajax({
                url: 'checklists/actions/selectChecklists',
                data: dataProject,
                method: 'post',
                success:function(returned){
                    console.log(returned)
                    tableChecklists.clear().rows.add(returned).draw();
                },
                error:function(error, jhrx){
                    console.log(error, jhrx);
                }
            })
        }
        filterChecklist()


    })
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
                            <li><a class="dropdown-item" href="#" title="Click to edit Checklist" name="editChecklist"><i class="fa-solid fa-pen-to-square"></i> Edit Checklist</a></li>
                            <li><a class="dropdown-item" title="Click to delete Checklist" name="deleteChecklist"><i class="fa-solid fa-trash"></i> Delete Checklist</a></li>
                            </ul>
                            </div>`;
            }
        }]
    });     
    console.log(tableChecklists)

    $('[name="saveChecklist"]').on('click', function(){
        try{
            // verifyForm();
            Swal.fire({
                title: 'Do you want to save the checklist?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let dataAction = 'data-action' + $('[name="formChecklist"]').attr('data-action');
                    $('[name="projectChecklist"]').attr('disabled','disabled')
                    $('[name="projectChecklist"]').prop('disabled',false)
                    $.ajax({
                        url: $('[name="formChecklist"]').attr(dataAction),
                        data: $('[name="formChecklist"]').serialize(),
                        method: 'post',
                        assync: false,
                        success: function(returned){
                            Swal.fire('Saved! ' + returned, '', 'success')
                            clearInputsForm3();
                            $('#cancel-alter1').hide();
                            $('[name="projectChecklist"]').attr('disabled','disabled')
                            $('[name="projectChecklist"]').prop('disabled',false)
                            if($('[name="formChecklist"]').attr('data-action') == 3){
                                $('#register-alter1').html('Register');
                            }else{
                                $('#register-alter1').html('Register');
                                $('[name="formChecklist"]').attr('data-action', 3)
                            }
                            noteDefault()
                            tableDefault()
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

  
$(document).on('click','[name="deleteChecklist"]',function(){
    let tr = $(this).closest('tr');
    try{
        Swal.fire({
            title: 'Do you want to delete the checklist?',
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                let data = tableChecklists.row(tr).data();
                $.ajax({
                    url: 'checklists/actions/delete',
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
$('form').attr('action', $('form').attr('data-action3'))
$('#cancel-alter1').on('click', function(){
    Swal.fire({
        title: 'Do you want to cancel the alter?',
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ok',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $('form').attr('data-action', 3)
            $('form').attr('action', $('form').attr('data-action2'))
            clearInputsForm1();
            $('[name="checklist"]').attr('checked', 'checked')
            $('[name="checklist"]').prop('checked', true);
            $('[name="userChecklist"]').attr('selected', 'selected')
            $('[name="userChecklist"]').prop('selected', true);
            $('[name="projectChecklist"]').attr('selected', 'selected')
            $('[name="projectChecklist"]').prop('selected', true);
            $('[name="projectChecklist"]').attr('disabled','disabled');
            $('[name="projectChecklist"]').prop('disabled', true);
            
            $('#cancel-alter1').hide();
            $('#register-alter1').html('Register');
            filterChecklist()
            noteDefault()
            tableDefault()
            
        }
    });
});

    $(document).on('click', '[name="editChecklist"]', function(){
        let tr = $(this).closest('tr');
        Swal.fire({
            title: 'Do you want to edit checklist?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                let data = tableChecklists.row(tr).data();                    console.log(data)
                $('[name="idChecklist"]').val(data.id)
                $('[name="clDateChecklist"]').val(data.closureDate)
                $('[name="activityChecklist"]').val(data.activity)
                $('[name="ddDateChecklist"]').val(data.deadlineDate)
                $('[name="checklist"][value="' + data.checklist + '"]').attr('checked', 'checked')
                $('[name="checklist"][value="' + data.checklist + '"]').prop('checked', true);
                $('[name="userChecklist"] option[value="' + data.id_user + '"]').attr('selected', 'selected')
                $('[name="userChecklist"] option[value="' + data.id_user + '"]').prop('selected', true)
                
                $('[name="projectChecklist"] option[value="' + data.id_project + '"]').attr('selected', 'selected')
                $('[name="projectChecklist"] option[value="' + data.id_project + '"]').prop('selected', true)
                $('[name="projectChecklist"]').attr('disabled','disabled');
                $('[name="projectChecklist"]').prop('disabled', false);

                $('form').attr('data-action', 4)
                $('#cancel-alter1').show();
                $('#register-alter1').html('Edit checklist');
            }
        });
    })
