<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\InterventionController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\WorkOrderController;
use App\Http\Controllers\Api\V1\WorkOrderTechnicianController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[AuthController::class,'login'])->name("api_login");

Route::middleware('auth:api')->group(function (){

    Route::get('logout',[AuthController::class,'logout'])->name("api_logout");


    //WORK ORDER routes
    Route::get('work-orders',[WorkOrderController::class,'index'])->name("api_get_work_orders");
    Route::group(['prefix'=>'work-orders'], function(){

        Route::get('{id}',[WorkOrderController::class,'find'])->name("api_find_work_order")->where('id','[0-9]+');
        Route::get('count-by-status',[WorkOrderController::class,'getCount'])->name("api_status_count");
        Route::get('technician/count-by-status',[WorkOrderController::class,'getTechnicianCount'])->name("api_technician_count");
        Route::get('get-datatable',[WorkOrderController::class,'getDatatable'])->name('api_get_datatable');
        Route::get('technician/get-datatable',[WorkOrderController::class,'getTechnicianDataTable'])->name('api_get_technician_datatable');
        Route::get('{id}/assigned-repair-technicians',[WorkOrderTechnicianController::class,'getTechniciansAssigned'])->name('api_work_order_technicians');


        Route::post('create',[WorkOrderController::class, 'store'])->name('api_create_work_order');
        Route::post('remove-technician',[WorkOrderTechnicianController::class, 'removeTechnician'])->name('api_remove_assigned_technician');
        Route::post('assign-repair-technician',[WorkOrderTechnicianController::class,'store'])->name('api_assign_technician_work_order');

        Route::patch('add-appproval/{id}',[WorkOrderController::class,'addApproval'])->name('api_add_approval');
        Route::patch('set-chargeable/{id}',[WorkOrderController::class,'setChargeable'])->name('api_set_chargeable');
        Route::patch('assign-diagnostic-technician/{id}',[WorkOrderController::class,'assignDiagnosticTechnician'])->name('api_assign_diagnostic_technician');
        Route::patch('add-diagnostic/{id}',[WorkOrderController::class,'addDiagnostic'])->name('api_add_diagnostic');
        Route::patch('toggle-notification',[WorkOrderController::class,'toggleNotify'])->name('api_toggle_notification');
        Route::patch('close/{id}',[WorkOrderController::class,'closeWorkOrder'])->name('api_close_work_order');
        Route::patch('reassign/{id}',[WorkOrderController::class, 'reAssign'])->name('api_reassign_work_order');
    });



    //USER routes
    Route::get('users',[UserController::class,'index'])->name('api_get_users');
    Route::group(['prefix'=>'users'], function() {

        Route::get('{id}',[UserController::class,'find'])->name('api_find_user');
        Route::post('register',[AuthController::class,'register'])->name('api_register');


    });







/*    Route::get('filter-status/{status}',[WorkOrderController::class,'filterStatus'])->name("api_filter_status");*/
   /* Route::get('interventions',[WorkOrderController::class,'getInterventionWorkOrders'])->name('api_workorders_intervention');*/









   /* Route::get('get-technicians',[UserController::class,'technicians'])->name('api_get_technicians');*/

/*    Route::get('get-chargeable',[WorkOrderController::class,'getChargeable'])->name('api_get_chargeable');*/


    Route::get('get-users-datatable',[UserController::class,'getUsersDatatable'])->name('api_get_users_datatable');

    Route::post('add-intervention',[InterventionController::class,'store'])->name('api_add_intervention');

    Route::get('find-interventions/{id}', [InterventionController::class,'findByWorkTechId'])->name('api_find_interventions');
    Route::patch('complete-intervention/{id}',[WorkOrderTechnicianController::class,'completeIntervention'])->name('api_complete_intervention');
    Route::get('intervention-status/{userId}/{id}', [WorkOrderTechnicianController::class,'getStatus'])->name('api_get_intervention_status');


    Route::get('interventions/{id}', [InterventionController::class,'getInterventions'])->name('api_get_interventions');

    Route::get('read-notifications', [\App\Http\Controllers\Api\V1\NotificationController::class,'readNotifications'])->name('api_read_notifications');
    Route::get('notifications', [\App\Http\Controllers\Api\V1\NotificationController::class,'getNotifications'])->name('api_get_notifications');

    Route::get('unread-notifications', [\App\Http\Controllers\Api\V1\NotificationController::class,'getUnreadNotifications'])->name('api_get_unread_notifications');




    Route::post('create-sla',[\App\Http\Controllers\Api\V1\SlaController::class, 'store'])->name('api_create_sla');

    Route::get('search-client',[\App\Http\Controllers\Api\V1\ClientController::class,'searchClient'])->name('api_search_client');
    Route::get('clients',[\App\Http\Controllers\Api\V1\ClientController::class,'index'])->name('api_get_clients');
    Route::post('create-client',[\App\Http\Controllers\Api\V1\ClientController::class,'store'])->name('api_create_client');
    Route::get('clients/{id}',[\App\Http\Controllers\Api\V1\ClientController::class,'find'])->name('api_find_client');
    Route::get('get-clients-datatable',[\App\Http\Controllers\Api\V1\ClientController::class,'getDatatable'])->name('api_get_clients_datatable');





   /* Route::get('get-try',[WorkOrderController::class,'try'])->name('api_get_try');*/
    Route::get('sla/{id}',[\App\Http\Controllers\Api\V1\SlaController::class,'find'])->name("api_find_sla")->where('id','[0-9]+');
    Route::get('client-slas/{id?}',[\App\Http\Controllers\Api\V1\SlaController::class,'getSlaDatatable'])->name("api_get_client_slas")->where('id','[0-9]+');

    Route::get('client-hours-spent/{id}',[\App\Http\Controllers\Api\V1\SlaController::class,'getHours'])->name("api_get_client_hours_spent")->where('id','[0-9]+');

});






