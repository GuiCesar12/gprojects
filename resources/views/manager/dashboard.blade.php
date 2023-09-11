@extends('index')

@section('title1', 'Manager')
@section('title2', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-6">

            <h3>Filters</h3><br>
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
                        @foreach($responsibles as $dados)
                        <option value="{{$dados->id_user}}">{{$dados->name}}</option>
                        @endforeach
                    </select>
                </div> 
            </div>
    <br>
    <div class="card zdepth-12"></div>
    <div class="container">

    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="graficos col s12 m6">            
                <div class="grafico card z-depth-4">
                    <h5 class="center"> Status </h5>
                    <canvas id="myChart2" width="150" height="131"></canvas> 
                </div>            
            </section>
        </div>
        <div class="col-md-6">
            <div class="row">
                <section class="graficos col s12 m6" >   
                    <div class="grafico card z-depth-4">
                        <h5 class="center"> Deadline</h5>
                        <canvas id="myChart" width="100" height="30"></canvas>
                    </div>           
                </section>
            </div>
            <div class="row"> 
                <section class="graficos col s12 m6">            
                    <div class="grafico card z-depth-4">
                        <h5 class="center"> Delivery </h5>
                        <canvas id="myChart3" width="100" height="30"></canvas> 
                    </div>            
                </section>
            </div>
        </div>  
    </div>
    <div class="card zdepth-0"></div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0">Projects</h5>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table_static" class="display" style="width: 100%">
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

var tableStatic = null;
    function updateTableStatic(datas){
        $.ajax({
            data: datas,
            url: '{{route('selectAllDashboards')}}',
            method: 'post',
            success:function(returned){
                tableStatic.clear().rows.add(returned).draw();
            },
            error:function(error, jhrx){
                console.log(error, jhrx);
            }
        })
    }
    $(document).ready(function(){
        
        tableStatic = $('#table_static').DataTable({
            scrollX: true,
            columns:[{
                data: 'id'
            },{
                data:'project'
            },{
                data:'description'
            },{
                data:'name'
            },{
                data:'status'
            },{
                data: 'size'
            },{
                data: 'product'
            },{
                data: 'customer'
            },{
                data: 'contact'
            },{
                data:'formatBegin'
            },{
                data: 'formatDeadline'               
            },{
                data:'formatClosure'
            }]
        });
        
       
    })
    $( document ).ready(function() {
        function OnErrorCall_(){
            return false
        }
        
        function filterStatus(datas_){
            $.ajax({
                type: "POST",
                url: "{{route('projectsStatusDatas')}}",
                // contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(response) {
                    let labels = [];
                    let datas = [];
                    $.each(response, function(id, el){
                        labels.push(el.label);
                        datas.push(el.total);
                    })
                    var ctx = document.getElementById('myChart2');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Visitas',
                                data: datas,
                                backgroundColor: [
                                    'rgba(255, 99, 132)',
                                    'rgba(54, 162, 235)',                         
                                    'rgba(255, 159, 64)',
                                    'rgba(172, 159, 255)'
                                ]
                            }]
                        }
                    }); 
                },
                error: OnErrorCall_,
                data: datas_
            });
        }
        


        function filterDeadline(datas){
            $.ajax({
                type: "POST",
                url: "{{route('projectsDeadlineDatas')}}",
                dataType: "json",
                success: function(response) {
                            let labels = [];
                            let datas = [];
                            $.each(response, function(id, el){
                                labels.push(el.label);
                                datas.push(el.total);
                            })
                            console.log(datas)
                            var ctx = document.getElementById('myChart');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label:'2023',
                                        data: datas,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',                         
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',                     
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                    borderWidth: 1, 
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            }); 
                        },
                error: OnErrorCall_,
                data: datas
            });
        }

        function filterDelivery(){
            $.ajax({
                type: "POST",
                url: "{{route('projectsDeliveryDatas')}}",
                dataType: "json",
                success: function(response) {
                            let labels = [];
                            let datas = [];
                            $.each(response, function(id, el){
                                labels.push(el.label);
                                datas.push(el.total);
                            })
                            console.log(datas)
                            var ctx = document.getElementById('myChart3');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label:'2023',
                                        data: datas,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',                         
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',                     
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                    borderWidth: 1, 
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            }); 
                        },
                error: OnErrorCall_,
                data: datas
            });
        }

        loadInfoGraph();
        $('.select-filter').on('change', function(){
            loadInfoGraph();
        });
        function loadInfoGraph(){
            datas = {};
            $.each($('.select-filter option:selected'), function(index, el){
                if($(el).val().trim() !== ''){
                    datas[$(el).closest('select').attr('name')] = $(el).val().trim();
                }
            })
            filterStatus(datas);
            filterDeadline(datas);
            filterDelivery(datas);
            updateTableStatic(datas)
        }





        
    })
    $('span:contains("{{$title2}}")').closest('li').addClass('active');

    
    </script>

@endpush
