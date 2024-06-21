<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', function (Request $request) {
    if (! Auth::user()) {
        return view('pages-sign-in');
    }else{
        return redirect('/');
    }
})->name('login');

Route::post('/log', function(Request $request){
    $credentials = [
        'email' => $request::input('email'),
        'password' => $request::input('password'),
        'status' => 1
    ];

    if (Auth::attempt($credentials)) {
        $request::session()->regenerate();

        return redirect('/');
    }

    return back()->withErrors([
        'message' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('log');

Route::get('/logout', function(Request $request){
    \Auth::logout();
    return redirect('/login');
})->name('logout');

Route::any('/', function () {
    return view('index');
})->middleware('auth')->name('index');

Route::prefix('administrator')->group(function(){
    Route::get('/users',[UserController::class,'index'])->middleware(['profileAccess','auth'])->name('users');

    Route::prefix('users/actions')->group(function(){
        Route::post('/create',[UserController::class,'create'])->name('insertUser');
        Route::get('/selectUsers',[UserController::class,'allUsers'])->name('selectAllUser');
        Route::post('/updatePass',[UserController::class,'alterPass'])->name('alterPass');
        Route::post('/updateUser',[UserController::class,'alterUser'])->name('alterUser');
        Route::post('/updateStatus',[UserController::class,'alterStatus'])->name('alterStatus');
    
    });
    
    Route::get('/sizes',[SizeController::class,'index'])->name('sizes');
    Route::prefix('sizes/actions')->group(function(){
        Route::get('/selectSizes',[SizeController::class,'selectAll'])->name('selectAllSizes');
        Route::post('/create',[SizeController::class,'create'])->name('createSize');
        Route::post('/update',[SizeController::class,'update'])->name('updateSize');
        Route::post('/delete',[SizeController::class,'delete'])->name('deleteSize');
    
    });
    Route::get('/contacts',[ContactController::class,'index'])->middleware(['profileAccess','auth'])->name('contacts');
    Route::prefix('contacts/actions')->group(function(){
        Route::get('/selectContacts',[ContactController::class,'selectAll'])->name('selectAllContacts');
        Route::post('/create',[ContactController::class,'create'])->name('createContact');
        Route::post('/update',[ContactController::class,'update'])->name('updateContact');
        Route::post('/delete',[ContactController::class,'delete'])->name('deleteContact');
        
    });
    
    Route::get('/customers',[CustomerController::class,'index'])->middleware(['profileAccess','auth'])->name('customers');
    Route::prefix('customers/actions')->group(function(){
        Route::get('/selectCustomers',[CustomerController::class,'selectAll'])->name('selectAllCustomers');
        Route::post('/create',[CustomerController::class,'create'])->name('createCustomer');
        Route::post('/update',[CustomerController::class,'update'])->name('updateCustomer');
        Route::post('/delete',[CustomerController::class,'delete'])->name('deleteCustomer');
        // Route::post('/verify',[CustomerController::class,'uuidVerification'])->name('verify');
        
    });
    Route::get('/status',[StatusController::class,'index'])->middleware(['profileAccess','auth'])->name('status');
    Route::prefix('status/actions')->group(function(){
        Route::get('/selectStatus',[StatusController::class,'selectAll'])->name('selectAllStatuss');
        Route::post('/create',[StatusController::class,'create'])->name('createStatus');
        Route::post('/update',[StatusController::class,'update'])->name('updateStatus');
        Route::post('/delete',[StatusController::class,'delete'])->name('deleteStatus');
        
    });
    Route::get('/products',[ProductController::class,'index'])->middleware(['profileAccess','auth'])->name('products');
    Route::prefix('products/actions')->group(function(){
        Route::get('/selectProducts',[ProductController::class,'selectAll'])->name('selectAllProducts');
        Route::post('/create',[ProductController::class,'create'])->name('createProduct');
        Route::post('/update',[ProductController::class,'update'])->name('updateProduct');
        Route::post('/delete',[ProductController::class,'delete'])->name('deleteProduct');
        
    });
});
Route::prefix('projects')->group(function(){
    Route::get('/notifications',[NotificationController::class ,'select'])->name('selectNotifications');

    Route::get('/projects',[ProjectController::class,'index'])->middleware(['auth','profileAccess1'])->name('projects');
    Route::prefix('projects/actions')->group(function(){
        Route::post('/selectProjects',[ProjectController::class,'selectAll'])->name('selectAllProjects');
        Route::post('/create',[ProjectController::class,'create'])->name('createProject');
        Route::post('/update',[ProjectController::class,'update'])->name('updateProject');
        Route::post('/delete',[ProjectController::class,'delete'])->name('deleteProject');
    });
    // Route::get('/reports',[ReportController::class,''])->middleware('auth')->name('reports2');
    Route::get('/reports/{uuid}',[ReportController::class,'index'])->name('reports');
    Route::prefix('reports/actions')->group(function(){
        Route::get('/selectReports/{uuid}',[ReportController::class,'project'])->name('selectAllReports');
        Route::get('/selectNotes/{uuid}',[ReportController::class,'notesFilter'])->name('filterNotes');
        Route::get('/selectChecklists/{uuid}',[ReportController::class,'deadlinesFilter'])->name('filterChecklists');
        Route::get('/selectStatus/{uuid}',[ReportController::class,'statusReports'])->name('filterStatus');
    });

    Route::get('/notes',[NoteController::class,'index'])->middleware(['auth','profileAccess1'])->name('notes');
    Route::prefix('notes/actions')->group(function(){
        Route::post('/selectNotes',[NoteController::class,'selectAll'])->name('selectAllNotes');
        Route::post('/create',[NoteController::class,'create'])->name('createNote');
        Route::post('/update',[NoteController::class,'update'])->name('updateNote');
        Route::post('/delete',[NoteController::class,'delete'])->name('deleteNote');

    });
    Route::get('/checklists',[ChecklistController::class,'index'])->middleware(['auth','profileAccess1'])->name('checklists');
    Route::prefix('checklists/actions')->group(function(){
        Route::post('/selectChecklists',[ChecklistController::class,'selectAll'])->name('selectAllChecklists');
        Route::post('/create',[ChecklistController::class,'create'])->name('createChecklist');
        Route::post('/update',[ChecklistController::class,'update'])->name('updateChecklist');
        Route::post('/delete',[ChecklistController::class,'delete'])->name('deleteChecklist');

    });


});
Route::prefix('managers')->group(function(){
    Route::get('/dashboards',[DashboardController::class,'index'])->middleware('auth')->name('dashboards');
    Route::prefix('dashboards/actions')->group(function(){
        Route::post('/selectDashboards',[DashboardController::class,'selectAll'])->name('selectAllDashboards');
        Route::post('/projectsStatusDatas',[DashboardController::class,'projectsStatusDatas'])->name('projectsStatusDatas');
        Route::post('/projectsDeadlineDatas',[DashboardController::class,'projectsDeadlineDatas'])->name('projectsDeadlineDatas');
        Route::post('/projectsDeliveryDatas',[DashboardController::class,'projectsDeliveryDatas'])->name('projectsDeliveryDatas');

    });
});

    
