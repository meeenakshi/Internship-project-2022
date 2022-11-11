<?php


use App\Http\Controllers\Web\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Admin\WorkOrderController as AdminWorkOrderController;
use App\Http\Controllers\Web\Admin\WorkOrderTechnicianController as AdminWorkOrderTechnicianController;
use App\Http\Controllers\Web\Technician\WorkOrderTechnicianController as TechnicianWorkOrderTechnicianController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Web\Technician\DashboardController as TechnicianDashboardController;
use App\Http\Controllers\Web\Technician\WorkOrderController as TechnicianWorkOrderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Web\Technician\SlaController as TechnicianSlaController;
use App\Http\Controllers\Web\Admin\SlaController as AdminSlaController;

//PUBLIC ROUTES
Route::post('/',[AuthController::class, 'login'])->name("login");
Route::get('/',[AuthController::class, 'login']);



//AUTH ROUTES
Route::middleware('auth')->group(function (){

    //logout
    Route::get('logout',[AuthController::class,'logout'])->name("logout");

    //ADMIN routes
    Route::group(['prefix'=>'admin','middleware'=>'is_admin','as'=>'admin.'], function(){


        Route::get('dashboard', [AdminDashboardController::class,'index'])->name('dashboard');
        Route::get('/workorders',[\App\Http\Controllers\Web\Admin\WorkOrderController::class,'index'])->name('workorders');


            //WORK ORDER routes
        Route::group(['prefix'=>'workorders','as'=>'workorders.'], function(){
            Route::get('ready',[AdminWorkOrderController::class,'ready'])->name('ready');
            Route::get('cancelled',[AdminWorkOrderController::class,'cancelled'])->name('cancelled');
            Route::get('approved',[AdminWorkOrderController::class,'approved'])->name('approved');
            Route::get('completed',[AdminWorkOrderController::class,'completed'])->name('completed');
            Route::get('pending',[AdminWorkOrderController::class,'pending'])->name('pending');
            Route::get('closed',[AdminWorkOrderController::class,'closed'])->name('closed');
            Route::get('warranty',[AdminWorkOrderController::class,'warranty'])->name('warranty');
            Route::get('create', [AdminWorkOrderController::class,'showForm'])->name('create');
            Route::get('details/{id}', [AdminWorkOrderController::class,'find'])->name('details')->where('id','[0-9]+');

            Route::get('pdf/{id}', [AdminWorkOrderController::class,'exportPdf'])->name('pdf');


            Route::post('create',[AdminWorkOrderController::class,'store']);
            Route::post('approval',[AdminWorkOrderController::class,'addApproval'])->name('approval');
            Route::post('set-chargeable',[AdminWorkOrderController::class,'setChargeable'])->name('set_chargeable');
            Route::post('assign-diagnostic-technician', [AdminWorkOrderController::class,'assignDiagnosticTechnician'])->name('assign_diagnostic_technician');
            Route::post('close-work-order', [AdminWorkOrderController::class,'close'])->name('close_work_order');
            Route::post('reassign-work-order', [AdminWorkOrderController::class,'reAssign'])->name('reassign');
            Route::post('assign-work-order-technician', [AdminWorkOrderTechnicianController::class,'store'])->name('assign_work_order_technician');

            Route::post('remove-technician', [AdminWorkOrderTechnicianController::class,'removeTechnician'])->name('remove_assigned_technician');


        });

        //USER ROUTES

        Route::get('/users', [UserController::class,'index'])->name('users');

        Route::group(['prefix'=>'users','as'=>'users.'], function(){

            Route::get('create', [UserController::class,'showForm'])->name('create');

            Route::post('create',  [UserController::class,'createUser'])->name('create');

            Route::get('details/{id}', [UserController::class,'find'])->name('details')->where('id','[0-9]+');
        });


        //END USER ROUTES



    //CLIENT ROUTES
        Route::get('/clients', [\App\Http\Controllers\Web\Admin\ClientController::class,'index'])->name('clients');

        Route::group(['prefix'=>'clients','as'=>'clients.'], function(){

            Route::get('create', [\App\Http\Controllers\Web\Admin\ClientController::class,'showForm'])->name('create');

            Route::post('create',  [\App\Http\Controllers\Web\Admin\ClientController::class,'createClient'])->name('create');
            Route::get('details/{id}', [\App\Http\Controllers\Web\Admin\ClientController::class,'find'])->name('details')->where('id','[0-9]+');

        });

    //END CLIENT ROUTES




        Route::get('slas', [AdminSlaController::class,'slas'])->name('slas');

        //SLA ROUTES
        Route::group(['prefix'=>'sla','as'=>'sla.'], function(){

            Route::get('details/{id}', [AdminSlaController::class,'find'])->name('details')->where('id','[0-9]+');

        });




    });
    //END ADMIN ROUTES






    //TECHNICIAN ROUTES


    Route::group(['prefix'=>'technician','middleware'=>'is_technician','as'=>'technician.'], function(){


        //Technician Dashboard Route
        Route::get('dashboard', [TechnicianDashboardController::class,'index'])->name('dashboard');

        //WORK ORDER ROUTES
        Route::group(['prefix'=>'workorders','as'=>'workorders.'], function(){

            Route::get('details/{id}', [TechnicianWorkOrderController::class,'find'])->name('details');
            Route::get('diagnostic',[TechnicianWorkOrderController::class,'getAssignedDiagnostics'])->name('diagnostic');
            Route::get('intervention',[TechnicianWorkOrderController::class,'getInterventionWorkOrders'])->name('intervention');

            Route::post('perform-diagnostic', [TechnicianWorkOrderController::class,'performDiagnostic'])->name('perform_diagnostic');
            Route::post('add-intervention',[\App\Http\Controllers\Web\Technician\InterventionController::class,'store'])->name('add_intervention');
            Route::post('complete-intervention', [TechnicianWorkOrderTechnicianController::class,'update'])->name('complete_intervention');
        });
        //END WORK ORDER ROUTES




            //SLA ROUTES

        Route::get('slas', [TechnicianSlaController::class,'slas'])->name('slas');


        Route::group(['prefix'=>'sla','as'=>'sla.'], function(){

            Route::get('create', [TechnicianSlaController::class,'showForm'])->name('create');


            Route::post('create', [TechnicianSlaController::class,'store']);

            Route::get('details/{id}', [TechnicianSlaController::class,'find'])->name('details')->where('id','[0-9]+');




        });

        //END SLA ROUTES



    });
    //END TECHNICIAN ROUTES




    Route::get('read-notifications',[\App\Http\Controllers\Web\NotificationController::class,'readNotification'])->name('read_notifications');




});

