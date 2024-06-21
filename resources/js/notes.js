var tableNotes = null;
function closeModal(){
    $('#collapseProject').modal('hide');
}



function noteDefault(idNote){
    $.ajax({
        data: {
            id : idNote,
        },
        url: 'notes/actions/selectNotes',
        method: 'post',
        success:function(returned){
            console.log(returned)
            tableNotes.clear().rows.add(returned).draw();
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}
function clearInputsForm3(){
    $.each($('form')[1], function(id, el){
        if(['radio', 'check'].includes($(el).attr('type'))){
            $(el).removeAttr('checked')
            $(el).prop('checked', false);
        }else{
            $(el).val('');

        }
        $('[name="projectNote"]').val('')
        $('[name="projectChecklist"]').val('');
        $('[name="projectChecklist"]').attr('disabled','disabled');
        $('[name="projectChecklist"]').prop('disabled', false);
        $('[name="projectNote"]').attr('disabled','disabled');
        $('[name="projectNote"]').prop('disabled', false);
        $('#cancel-alter').hide()
       clearInputsForm1()
       clearInputsForm2()
    });
}
function clearInputsForm2(){
    $.each($('form')[3], function(id, el){
        if(['radio', 'check'].includes($(el).attr('type'))){
            $(el).removeAttr('checked')
            $(el).prop('checked', false);
        }else{
            $('[name="note"]').val('');
        }
    });
}function clearInputsForm1(){
    $.each($('form')[2], function(id, el){
        if(['radio', 'check'].includes($(el).attr('type'))){
            $(el).removeAttr('checked')
         //   $(el).prop('checked', false);
        }else{
            $('[name="activityChecklist"]').val('');
            $('[name="userChecklist"]').val('');
            $('[name="clDateChecklist"]').val('');
            $('[name="ddDateChecklist"]').val('');

        }
    });
}

function updateTableNotes(){
    $.ajax({
        url: 'notes/actions/selectNotes',
        method: 'post',
        success:function(returned){
            tableNotes.clear().rows.add(returned).draw();
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}



$(document).on('click','[name="modal"]',function(){
    let tr = $(this).closest('tr')
    let dataProject = tableProjects.row(tr).data()
    function filterNotes(){
        $.ajax({
            url: 'notes/actions/selectNotes',
            data: dataProject,
            method: 'post',
            success:function(returned){
                console.log(returned)
                tableNotes.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    

    filterNotes()
})

$(document).ready(function(){

    tableNotes = $('#table_note').DataTable({
        scrollX: true,
        responsive: true,
        columns:[{
            data:'note'
        },{
            data:'project'
        },{
            data:'created_at'
        }],
        columnDefs:[{
            target:3,
            render:function(data){
                return `<div class="dropdown" style="font-size: 0.589rem!important;">
                            <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Edits
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#" title="Click to edit note" name="editNote"><i class="fa-solid fa-pen-to-square"></i> Edit note</a></li>
                                <li><a class="dropdown-item" title="Click to delete project" name="deleteNote"><i class="fa-solid fa-trash"></i> Delete project</a></li>
                            </ul>
                        </div>`;
            }
        }]
    });
    $('[name="saveNote"]').on('click', function(){
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
                    let dataAction = 'data-action' + $('[name="formNote"]').attr('data-action');
                    $('[name="projectNote"]').attr('disabled','disabled')
                    $('[name="projectNote"]').prop('disabled',false)
                    console.log(dataAction)
                    $.ajax({
                        url: $('[name="formNote"]').attr(dataAction),
                        data: $('[name="formNote"]').serialize(),
                        method: 'post',
                        assync: false,
                        success: function(returned){
                            Swal.fire('Saved! ' + returned, '', 'success')
                            $('#cancel-alter2').hide();
                            $('[name="projectNote"]').attr('disabled','disabled')
                            $('[name="projectNote"]').prop('disabled',false)
                            if($('[name="formNote"]').attr('data-action') == 5){
                                $('#register-alter2').html('Register');
                            }else{
                                $('#register-alter2').html('Register');
                                $('[name="formNote"]').attr('data-action', 5)
                            }
                            noteDefault($('[name="projectNote"]').val())
                            $('[name="projectNote"]').attr('disabled','disabled')
                            $('[name="projectNote"]').prop('disabled',true)
                            clearInputsForm2();
                        },
                        error: function(error, jhrx){
                            Swal.fire('Error!',"'"+error.responseText+"'" , 'error')
                            console.log(error, jhrx);
                        }
                    });
                    
                }
            });
        }catch(e){
            Swal.fire('Error! ' + e, '', 'error')
        }
    });
    $('[name="formNote"]').attr('action', $('[name="formNote"]').attr('data-action5'))
    $('#cancel-alter2').on('click', function(){
        Swal.fire({
            title: 'Do you want to cancel the alter?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('[name="formNote"]').attr('data-action', 5)
                $('[name="formNote"]').attr('action', $('[name="formNote"]').attr('data-action6'))
                clearInputsForm2();
                $('[name="projectNote"]').attr('disabled','disabled')
                $('[name="projectNote"]').prop('disabled',true)
                $('#cancel-alter2').hide();
                $('#register-alter2').html('Register');
            }
        });
    });
    $(document).on('click', '[name="editNote"]', function(){
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
                $('[name="idNote"]').val(data.id)
                $('[name="note"]').val(data.note)
                $('[name="projectNote"] option[value="' + data.id_project + '"]').attr('selected', 'selected')
                $('[name="projectNote"] option[value="' + data.id_project + '"]').prop('selected', true)
                $('[name="projectNote"]').attr('disabled','disabled')
                $('[name="projectNote"]').prop('disabled',false)
                $('[name="formNote"]').attr('data-action', 6)
                $('#cancel-alter2').show();
                $('#register-alter2').html('Edit note');                   
            }
        });
    })
    $(document).on('click','[name="deleteNote"]',function(){
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
                        url: 'notes/actions/delete',
                        data: {id: data.id},
                        method: 'post',
                        assync: false,
                        success: function(returned){
                            Swal.fire('Deleted! Sucess Deleted', '', 'success')
                             noteDefault($('[name="projectNote"]').val())
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
    // loadInfoGraph();
    // $('.select-filter').on('change', function(){
    //     loadInfoGraph();
    //     console.log($('.select-filter option:selected'))
    // });
    // function loadInfoGraph(){
    //     datas = {};
    //     $.each($('.select-filter option:selected'), function(index, el){
    //         if($(el).val().trim() !== ''){
    //             datas[$(el).closest('select').attr('name')] = $(el).val().trim();
    //         }
    //     })
    //     // console.log(datas)
    //     updateTableProjects(datas)
    // }
})