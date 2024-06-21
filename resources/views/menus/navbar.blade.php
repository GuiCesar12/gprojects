<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><i class="align-middle me-1" data-feather="bell-off" name="iconNotification"></i><i class="align-middle me-1" data-feather="bell" name="iconNotification2"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" name="notification">
                    
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark">{{\Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="card-body" id="alterPass" name="alterPass" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="align-middle me-1"data-feather="settings"></i>Modify   Password </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
            </div>
            <div class="modal-body">
            <form action="post" name="formUpdatePass" data-action7="{{route('alterPass')}}" data-action="7">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                            <input type="hidden" name="id" value="{{\Auth::user()->id}}">
                            <label for="">E-mail</label>
                            <input type="text" name="email"class="form-control" value="{{\Auth::user()->email}}" disabled>
                            <label for="">New Password</label>
                            <input type="password" name="newPassword" class="form-control"id="newPassword"required>
                            <label for="">Confirm New Password</label>
                            <input type="password" name="confirmNewPassword" class="form-control"id="confirmNewPassword"required>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="saveModal">Save changes</button>
                    <button type="button" class="btn btn-secondary" name="close"data-dismiss="modal">Close</button>
                </div>
            </form>
      </div>
    </div>
</div>

<script>

    
function notification(){
    $.ajax({
            method: "get",
            url: '{{route('selectNotifications')}}',
            assync: false,
            success: function(returned){
                $('[name="notification"] a').remove() 
                $('[name="notification"]').prepend("<a name='returned'class='card-body' href='{{route('projects')}}'>"+returned+"</a>") 
                $('[name="iconNotification"]').hide();
                $('[name="iconNotification2"]').show();
            },
            error: function(error, jhrx){
                if(error.status == 301){
                    
                    $('[name="notification"] a').remove() 
                    $('[name="notification"]').prepend("<a class='card-body' >"+error.responseText+"</a>") 
                    $('[name="iconNotification"]').show();
                    $('[name="iconNotification2"]').hide();
                   
                }
                
                console.log(error, jhrx);
            }
        });
        
}




$( document ).ready(function() {
    $('form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
    notification()
    setInterval(notification, 60000);

});



        function clearInputsFormPass(){
        $.each($('form')[0], function(id, el){
            if(['radio', 'check'].includes($(el).attr('type'))){
                $(el).removeAttr('checked')
                $(el).prop('checked', false);
            }else{
                $('[name="newPassword"]').val('');
                $('[name="confirmNewPassword"]').val('');
            }
        });
    }


        $('[name="saveModal"]').on('click', function(){
            try{
                    Swal.fire({
                        title: 'Do you want to save the new Password?',
                        // showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            let dataAction = 'data-action'+ $('[name="formUpdatePass"]').attr('data-action');
                            $.ajax({
                            method: "post",
                            url: '{{route('alterPass')}}',
                            data: $('[name="formUpdatePass"]').serialize(),
                            success: function(returned){
                                Swal.fire('Saved! ' + returned, '', 'success')
                                clearInputsFormPass();                                
                            },
                            error: function(error, jhrx){
                                Swal.fire('Error!', error.responseText, 'error')
                                console.log(error, jhrx);
                            }
                            });
                        }
                    })
            }catch(e){
                Swal.fire('Error! ' + e, '', 'error')
            }
        }) 
        $('[name="close"]').on('click',function(){
            clearInputsFormPass()
            $('#exampleModal1').modal('hide');

        })


</script>

