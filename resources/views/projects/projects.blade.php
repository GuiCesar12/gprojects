@extends('index')

@section('title1', 'Projects')
@section('title2', 'Projects')

@section('content')





<div class="container-fluid p-0">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="accordion-header" id="flush-headingOne">
                                  <button class="accordion-button collapsed" id="collapseProject" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Project
                                  </button>
                                </h2>
                            </div>
                            
                            <div class="col-md-4">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Checklist
                                    </button>
                                </h2>
                            </div>
                            <div class="col-md-4">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Notes
                                    </button>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="modal-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-12" id="register-alter">Project</div>
                                                        <div class="col-12 col-lg-12" id="cancel-alter" style="text-align: right!important; cursor: pointer; display:none;">
                                                            <button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 0.589rem!important;"><i class="align-middle " data-feather="x-square" style=""></i> Cancel</button>
                            
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" name="formProject" data-action1="{{route('createProject')}}" data-action2="{{route('updateProject')}}" data-action="1">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="hidden" name="id" >
                                            <label for="">Project</label>
                                            <input type="text" name="project" class="form-control" placeholder="Input" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">Size</label>
                                            <select name="size" id="size" class="form-control">
                                                <option value="">----</option>
                                                @foreach($sizes as $dados)
                                                <option value="{{$dados->id}}"> {{$dados->size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">----</option>
                                                @foreach($status as $dados)
                                                <option value="{{$dados->id}}">{{$dados->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">Contact</label>
                                            <select name="contact" id="contact" class="form-control">
                                                <option value="">---</option>
                                                @foreach($contacts as $dados)
                                                <option value="{{$dados->id}}">{{$dados->contact}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="">Customers</label>
                                            <select name="customer" id="customer" class="form-control">
                                                <option value="">----</option>
                                                @foreach($customers as $dados)
                                                <option value="{{$dados->id}}">{{$dados->customer}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
            
                                            <label for="">Products</label>
                                            <select name="product" id="product" class="form-control">
                                                <option value="">----</option>
                                                @foreach($products as $dados)
                                                <option value="{{$dados->id}}">{{$dados->product}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Responsible for project</label>
                                            <select name="user" id="user" class="form-control">
                                                <option value="">----</option>
                                                @foreach($users as $dados)
                                                <option value="{{$dados->id}}">{{$dados->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="">Begin Date</label>
                                            <input type="date" name="bgDate" class="form-control" placeholder="Input" required>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <label for="">Closure Date</label>
                                            <input type="date" name="clDate" class="form-control" placeholder="Input"> 
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Deadline Date</label>
                                            <input type="date" name="ddDate" class="form-control" placeholder="Input" required>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Description</label>
                                            <textarea name="description" id="description" cols="20" rows="2" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <button type="button" class="btn btn-primary form-control" name="saveProject">Save</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>


                        


                        <div class="accordion-item">
                          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="container-fluid p-0">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Checklists</h5>
                                            </div>
                                            <div class="card-body">
                                                <table id="table_checklist" class="display" style="width:100%">
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
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">
                                                        <div class="row">
                                                            <div class="col-6 col-lg-6" id="register-alter1">Checklist</div>
                                                            <div class="col-6 col-lg-6" id="cancel-alter1" style="text-align: right!important; cursor: pointer; display:none;">
                                                                <button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 0.589rem!important;"><i class="align-middle " data-feather="x-square" style=""></i> Cancel</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <form method="post" name="formChecklist" data-action3="{{route('createChecklist')}}" data-action4="{{route('updateChecklist')}}" data-action="3">
                                                        <input type="hidden" name="idChecklist">
                                                        <div class="row">

                                                            <div class="col-md-6" >
                                                                <label for="">Checklist</label>
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
                                                            <div class="col-md-6">
                                                                <label for="">Activity</label>
                                                                <textarea name="activityChecklist" id="activityChecklist" cols="20" rows="1" class="form-control" placeholder="Activity"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">Responsible for activity</label>
                                                                <select name="userChecklist" id="userChecklist" class="form-control">
                                                                    <option value="">----</option>
                                                                    @foreach($usersCheck as $dados)
                                                                    <option value="{{$dados->id}}">{{$dados->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Project</label>
                                                                <select name="projectChecklist" id="projectChecklist" class="form-control">
                                                                    <option value="">----</option>
                                                                    @foreach($projects as $dados)
                                                                    <option value="{{$dados->id}}">{{$dados->project}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">Closure Date</label>
                                                                <input type="date" class="form-control" name="clDateChecklist" id="clDateChecklist">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Deadline Date</label>
                                                                <input type="date" class="form-control" name="ddDateChecklist" id="ddDateChecklist">
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                        <button type="button" class="btn btn-primary form-control" name="saveChecklist">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                
                                        </div>
                                
                                        
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-12 col-lg-5">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">
                                                            <div class="row">
                                                                <div class="col-6 col-lg-6" id="register-alter2">Register</div>
                                                                <div class="col-6 col-lg-6" id="cancel-alter2" style="text-align: right!important; cursor: pointer; display:none;">
                                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 0.589rem!important;"><i class="align-middle " data-feather="x-square" style=""></i> Cancel</button>
                                                                    
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="post" name="formNote" data-action5="{{route('createNote')}}" data-action6="{{route('updateNote')}}" data-action="5">
                                                            <input type="hidden" name="idNote">
                                                            <label for="">Note</label>
                                                            <input type="text" name="note" class="form-control" placeholder="Note" required>
                                                            <label for="">Projects</label>
                                                            <select name="projectNote" id="projectNote" class="form-control">
                                                                <option value="">----</option>
                                                                @foreach ($projects as $dados)
                                                                    <option value="{{$dados->id}}">{{$dados->project}} </option>
                                                                @endforeach
                                                            </select>
                                                                <br>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" class="btn btn-primary form-control" name="saveNote">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                    
                                            </div>
                                    
                                            <div class="col-12 col-lg-7">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title mb-0">Notes</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="table_note" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Notes</th>
                                                                    <th>Projects</th>
                                                                    <th>Created Date</th>
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
                                </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="">Status</label>
            <select name="id_status" id="filter" class="form-control select-filter">
                <option value="">---</option>
                <option value="">All</option>
                @foreach($status as $dados)
                <option value="{{$dados->id}}">{{$dados->status}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Customer</label>
            <select name="id_customer" id="filter" class="form-control select-filter">
                <option value="">---</option>
                <option value="*">All</option>
                @foreach($customers as $dados)
                <option value="{{$dados->id}}">{{$dados->customer}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Contact</label>
            <select name="id_contact" id="filter" class="form-control select-filter">
                <option value="">---</option>
                <option value="*">All</option>
                @foreach($contacts as $dados)
                <option value="{{$dados->id}}">{{$dados->contact}}</option>
                @endforeach
            </select>
        </div> 
        <div class="col-md-3">
            <label for="">Responsible</label>
            <select name="id_user" id="filter" class="form-control select-filter">
                <option value="">---</option>
                <option value="*">All</option>
                @foreach($users as $dados)
                <option value="{{$dados->id}}">{{$dados->name}}</option>
                @endforeach
            </select>
        </div> 
    </div>
    <br>
    <div class="card zdepth-12"></div>


    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title mb-0">Projects</h5>

                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <h5 class="card-title mb-0">
                            <i class="align-middle" data-feather="plus-square" id="createProject" name="createProject" data-bs-toggle="modal" data-bs-target="#exampleModal"> </i>
                        </h5>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table id="table_project" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Project</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Size</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Begin Date</th>
                            <th>Deadline Date</th>
                            <th>Closure Date</th>
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
@endsection

@push('links')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script>

</script>
<script src="../resources/js/projects.js"></script>
<script src="../resources/js/checklists.js"></script>
<script src="../resources/js/notes.js"></script>

<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
@endpush