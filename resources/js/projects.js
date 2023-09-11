var tableProjects = null;

function updateTableProjects(datas) {
    $.ajax({
        data: datas,
        url: 'projects/actions/selectProjects',
        method: 'post',
        success: function(returned) {
            tableProjects.clear().rows.add(returned).draw();
        },
        error: function(error, jhrx) {
            console.log(error, jhrx);
        }
    })
}





$(document).ready(function() {

    tableProjects = $('#table_project').DataTable({
        scrollX: true,
        responsive: true,

        columns: [{
            data: 'id'
        }, {
            data: 'project'
        }, {
            data: 'description'
        }, {
            data: 'name'
        }, {
            data: 'status'
        }, {
            data: 'size'
        }, {
            data: 'product'
        }, {
            data: 'customer'
        }, {
            data: 'contact'
        }, {
            data: 'formatBegin'
        }, {
            data: 'formatDeadline'
        }, {
            data: 'formatClosure'
        }],
        columnDefs: [{
            target: 12,
            render: function(data) {
                return `<div class="dropdown" style="font-size: 0.589rem!important;">
                            <a class="btn btn-warning btn-sm dropdown-toggle" style="font-size: 0.589rem!important;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Edits
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#" title="Click to edit project" name="modal" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i> Options</a></li>
                                <li><a class="dropdown-item" name="reports"title="Reports"><i class="fa-sharp fa-solid fa-book"></i> Reports</a></li>
                                <li><a class="dropdown-item" title="Click to delete project" name="delete"><i class="fa-solid fa-trash"></i> Delete project</a></li>
                            </ul>
                        </div>`;
            }
        }]
    });
    updateTableProjects();
    $('span:contains("{{$title2}}")').closest('li').addClass('active');
    $('[name="saveProject"]').on('click', function() {
        try {
            // verifyForm();
            Swal.fire({
                title: 'Do you want to save the project?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let dataAction = 'data-action' + $('[name="formProject"]').attr('data-action');
                    $.ajax({
                        url: $('[name="formProject"]').attr(dataAction),
                        data: $('[name="formProject"]').serialize(),
                        method: 'post',
                        assync: false,
                        success: function(returned) {
                            Swal.fire('Saved! ' + returned, '', 'success')
                            clearInputsForm3();
                            $('#cancel-alter').hide();

                            if ($('[name="formProject"]').attr('data-action') == 1) {
                                $('#register-alter').html('Register');


                                //Reload bug when creating the project does not pass the id in the option button
                                // location.reload()
                            } else {
                                $('#register-alter').html('Register');
                                $('[name="formProject"]').attr('data-action', 1)
                            }
                            updateTableProjects()
                        },
                        error: function(error, jhrx) {
                            Swal.fire('Error!', "'" + error.responseText + "'", 'error')
                            console.log(error, jhrx);
                        }
                    });
                }
            });
        } catch (e) {
            Swal.fire('Error! ' + e, '', 'error')
        }
    });
    $('[name="formProject"]').attr('action', $('[name="formProject"]').attr('data-action1'))
    $('#cancel-alter').on('click', function() {
        Swal.fire({
            title: 'Do you want to cancel the alter?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('[name="formProject"]').attr('data-action', 1)
                $('[name="formProject"]').attr('action', $('[name="formProject"]').attr('data-action1'))
                clearInputsForm3();
                $('[name="size"]').attr('selected', 'selected')
                $('[name="size"]').prop('selected', true);
                $('[name="status"]').attr('selected', 'selected')
                $('[name="status"]').prop('selected', true);
                $('[name="contact"]').attr('selected', 'selected')
                $('[name="contact"]').prop('selected', true);
                $('[name="customer"]').attr('selected', 'selected')
                $('[name="customer"]').prop('selected', true);
                $('[name="product"]').attr('selected', 'selected')
                $('[name="product"]').prop('selected', true);
                $('[name="user"]').attr('selected', 'selected')
                $('[name="user"]').prop('selected', true);
                $('#cancel-alter').hide();
                $('#register-alter').html('Register');
                updateTableNotes()
                checkDefault()
                clearInputsForm3()
            }
        });
    });
    $(document).on('click', '[name="reports"]', function() {
        let tr = $(this).closest('tr');
        try {  
            let data = tableProjects.row(tr).data();
            window.open('reports/'+data.uuid,'_blank');
        } catch (e) {
            Swal.fire('Error! ' + e, '', 'error')
        }
    })


    $(document).on('click', '[name="delete"]', function() {
        let tr = $(this).closest('tr');
        try {
            Swal.fire({
                title: 'Do you want to save the project?',
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let data = tableProjects.row(tr).data();
                    $.ajax({
                        url: 'projects/actions/delete',
                        data: { id: data.id },
                        method: 'post',
                        assync: false,
                        success: function(returned) {
                            Swal.fire('Deleted! Sucess Deleted', '', 'success')
                            updateTableProjects()
                        },
                        error: function(error, jhrx) {
                            Swal.fire('Error!', "'" + error.responseText + "'", 'error')

                        }
                    });
                }
            });
        } catch (e) {
            Swal.fire('Error! ' + e, '', 'error')
        }
    })
    $(document).on('click', '[name="createProject"] ', function() {
        $('#collapseProject').click()

    
        noteDefault()
    })
    $(document).on('click', '[name="modal"]', function() {
        let tr = $(this).closest('tr')
        $('#collapseProject').click()
        let data = tableProjects.row(tr).data();
        console.log(data);
        $('[name="id"]').val(data.id)
        $('[name="project"]').val(data.project)
        $('[name="bgDate"]').val(data.beginDate)
        $('[name="clDate"]').val(data.closureDate)
        $('[name="ddDate"]').val(data.deadlineDate)
        $('[name="description"]').val(data.description)
        $('[name="size"] option[value="' + data.id_size + '"]').attr('selected', 'selected')
        $('[name="size"] option[value="' + data.id_size + '"]').prop('selected', true)

        $('[name="status"] option[value="' + data.id_status + '"]').attr('selected', 'selected')
        $('[name="status"] option[value="' + data.id_status + '"]').prop('selected', true)
        $('[name="contact"] option[value="' + data.id_contact + '"]').attr('selected', 'selected')
        $('[name="contact"] option[value="' + data.id_contact + '"]').prop('selected', true)

        $('[name="customer"] option[value="' + data.id_customer + '"]').attr('selected', 'selected')
        $('[name="customer"] option[value="' + data.id_customer + '"]').prop('selected', true)
        $('[name="product"] option[value="' + data.id_product + '"]').attr('selected', 'selected')
        $('[name="product"] option[value="' + data.id_product + '"]').prop('selected', true)
        $('[name="user"] option[value="' + data.id_user + '"]').attr('selected', 'selected')
        $('[name="user"] option[value="' + data.id_user + '"]').prop('selected', true)

        $('[name="projectNote"] option[value="' + data.id + '"]').attr('selected', 'selected')
        $('[name="projectNote"] option[value="' + data.id + '"]').prop('selected', true)
        $('[name="projectNote"]').attr('disabled', 'disabled')
        $('[name="projectNote"]').prop('disabled', true)

        $('[name="projectChecklist"] option[value="' + data.id + '"]').attr('selected', 'selected')
        $('[name="projectChecklist"] option[value="' + data.id + '"]').prop('selected', true)
        $('[name="projectChecklist"]').attr('disabled', 'disabled')
        $('[name="projectChecklist"]').prop('disabled', true)


        $('[name="formProject"]').attr('data-action', 2)
        $('#cancel-alter').show();
        $('#register-alter').html('Edit project');
    })
    loadInfoGraph();
    $('.select-filter').on('change', function() {
        loadInfoGraph();
        console.log($('.select-filter option:selected'))
    });

    function loadInfoGraph() {
        datas = {};
        $.each($('.select-filter option:selected'), function(index, el) {
            if ($(el).val().trim() !== '') {
                datas[$(el).closest('select').attr('name')] = $(el).val().trim();
            }
        })
        updateTableProjects(datas)
    }
})