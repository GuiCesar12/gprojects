@extends('customerindex')

@section('title1', 'Manager')
@section('project', 'Resume Projects')

@section('content')

<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12 col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Notes</h5>
                </div>
                <div class="card-body col-sm-12">
                    <table id="table_note" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Notes</th>
                                <th>Projects</th>
                                <th>Created date</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-sm-12">
            <section class="graficos col-12 col-sm-12">   
                <div class="grafico card z-depth-4">  
                    <h5 class="center">Status</h5>   
                    <div class="color-box green"></div>    
                    <canvas id="gauge"width="50" height="20"></canvas>
                </div>
            </section>
        </div>
    
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Deadline</h5>
                </div>
                <div class="card-body">
                    <table id="table_checklist" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Project</th>
                                <th>Responsible</th>
                                <th id="checkDeadline">Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-sm-12">
        
            <section class="graficos col-sm-12 m6">             
                <div class="grafico card z-depth-4">
                    <h5 class="center"> Timeline </h5>
                    <ul id="progressbar">
                        <li class="active" id="step1"> <strong>Step 1</strong></li>
                        <li id="step2"><strong>Step 2</strong></li>
                        <li id="step3"><strong>Step 3</strong></li>
                        <li id="step4"><strong>Step 4</strong></li>
                    </ul>
                </div>            
            </section>

        </div>
    </div>
</div>
@endsection

@push('links')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@push('scripts')

<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gauge.js/1.3.5/gauge.min.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
var tableNotes = null
var tableChecklists = null
var dataGraph = null

function noteDefault(){
    let uuidNote = '{{request('uuid')}}'
    $.ajax({
        url: '../../projects/reports/actions/selectNotes/{{request('uuid')}}',
        method: 'get',
        success:function(returned){
            console.log(returned)
            tableNotes.clear().rows.add(returned).draw();
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}
function checklistDefault(){
    var uuidCheck = '{{request('uuid')}}'
    console.log(uuidCheck)
    $.ajax({
        url: '../../projects/reports/actions/selectChecklists/{{request('uuid')}}',
        method: 'get',
        success:function(returned){
            console.log(returned)
            tableChecklists.clear().rows.add(returned).draw();
            timelineStatus(returned)
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}
function timelineStatus(data){
    var lis = ""


    stepNumber = 1;
    $.each(data,function(id,element){
        element.checklist
        element.acticity
        
        var classe = element.checklist == 2 ? 'active' : ''
        lis += '<li class="'+classe+'" id="step'+stepNumber+'"> <strong>'+element.activity+'</strong></li>'
    stepNumber++
    })
    $('#progressbar').html(lis)


}






function statusDefault(){
    $.ajax({
        url: '../../projects/reports/actions/selectStatus/{{request('uuid')}}',
        method: 'get',
        success:function(returned){
            console.log(returned)
            tableChecklists.clear().rows.add(returned).draw();
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    })
}



function graphStatus(){
    let uuidNote = '{{request('uuid')}}'
    $.ajax({
        url: '../../projects/reports/actions/selectStatus/{{request('uuid')}}',
        method: 'get',
        success: function(response) {
            
            let opts = {
            
                lines: 12,
                angle: 0.15,
                lineWidth: 0.44,
                pointer: {
                    length: 0.9,
                    strokeWidth: 0.035,
                    color: '#000000'
                },
                limitMax: 'false',
                staticZones: [
                    {strokeStyle: "rgb(255,0,0)", min: 0, max: 330},
                    {strokeStyle: "rgb(255,255,0)", min: 331, max: 660},
                    {strokeStyle: "rgb(0,255,0)", min: 661, max: 1000},
                ],
                strokeColor: '#E0E0E0',
                generateGradient: true

            }
            let target = document.querySelector('#gauge') // your canvas element

            let gaugeChart = new Gauge(target).setOptions(opts) // create sexy gauge!
            gaugeChart.maxValue = 1000 // set max gauge value
            gaugeChart.setMinValue(0) // Prefer setter over gauge.minValue = 0
            gaugeChart.animationSpeed = 32 // set animation speed (32 is default value)
            gaugeChart.set(response.statusProject) // set actual value
        },
        error:function(error, jhrx){
            console.log(error, jhrx);
        }
    
    })
}




$(document).ready(function(){
graphStatus()

    $('span:contains("reports")').closest('li').addClass('active');
    noteDefault()
    tableNotes = $('#table_note').DataTable({
        scrollX: true,
        responsive: true,
        columns:[{
            data:'note'
        },{
            data:'project'
        },{
            data:'formatCreated'
        }]
    });




    
    checklistDefault()
    tableChecklists = $('#table_checklist').DataTable({
        scrollX: true,
        responsive: true,
        columns: [{
            data: 'activity'
        },{
            data: 'project'
        },{
            data: 'name'
        },{
            data: 'formatDeadline'
        }]
    })

 
	var currentGfgStep, nextGfgStep, previousGfgStep;
	var opacity;
	var current = 1;
	var steps = $("fieldset").length;
	setProgressBar(current);
	$(".next-step").click(function () {
		currentGfgStep = $(this).parent();
		nextGfgStep = $(this).parent().next();
		$("#progressbar li").eq($("fieldset")
			.index(nextGfgStep)).addClass("active");

		nextGfgStep.show();
		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				nextGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		setProgressBar(++current);
	});
	$(".previous-step").click(function () {

		currentGfgStep = $(this).parent();
		previousGfgStep = $(this).parent().prev();

		$("#progressbar li").eq($("fieldset")
			.index(currentGfgStep)).removeClass("active");

		previousGfgStep.show();

		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				previousGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		setProgressBar(--current);
	});
	function setProgressBar(currentStep) {
		var percent = parseFloat(100 / steps) * current;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width", percent + "%")
	}


    $('#checkDeadline').click()
   
});





    </script>

@endpush
