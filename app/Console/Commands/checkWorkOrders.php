<?php

namespace App\Console\Commands;

use App\Http\Controllers\Web\Admin\WorkOrderTechnicianController;
use App\Models\Intervention;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrdersTechnician;
use App\Notifications\EmailTechnicians;
use App\Notifications\sendNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class checkWorkOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'technician:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $workOrders = WorkOrder::where('status', 'Assigned')->where('notifiable','1')->get()->toArray();

        $workOrderInterventions = WorkOrdersTechnician::join('work_orders','work_orders_technicians.work_order_id','=','work_orders.id')
            ->where('work_orders_technicians.status','In Progress')
            ->where('work_orders.notifiable','1')
            ->selectRaw('work_orders.id as WorkId, work_orders_technicians.user_id ,work_orders_technicians.id, work_orders_technicians.updated_at')
            ->get()->toArray();

        $today = strtotime(date("Y-m-d H:i:s"));

        foreach ($workOrders as $workOrder)
        {
            $updated_at= strtotime($workOrder['updated_at']);
            $difference  = abs($today - $updated_at);
            $hours = floor($difference/3600);



            if($hours>24){


                $user = User::find($workOrder['assigned_to']);


                $details = [
                    'greeting' => 'Pending diagnostic! BI '.$workOrder['id'],
                    'body'=> 'Please start working on the diagnostic',
                    'actiontext'=> 'Go to Work Order',
                    'actionurl'=> route("technician.workorders.details",['id'=>$workOrder['id']]),
                    'lastline' =>'Notification will be sent in the next 24 hours'
                ];




                Notification::send($user,new EmailTechnicians($details));
                Notification::send($user, new sendNotification("Pending Diagnostic! ",$workOrder['id']));

            }
        }


        foreach ($workOrderInterventions as $w)
        {
            $intervention= Intervention::where('work_orders_technicians_id',$w['id'])->orderBy('created_at','desc')->first();


            if($intervention==null)
            {
                $date = $w['updated_at'];
            } else {
                $intervention->toArray();

                $date = $intervention['created_at'];
            }


            $updated_at= strtotime($date);
            $difference  = abs($today - $updated_at);
            $hours = floor($difference/3600);


            if($hours>24){


                $user = User::find($w['user_id']);


                $details = [
                    'greeting' => 'Pending Repair Work! BI '.$w['WorkId'],
                    'body'=> 'Please start working on the interventions',
                    'actiontext'=> 'Go to Work Order',
                    'actionurl'=> route("technician.workorders.details",['id'=>$w['WorkId']]),
                    'lastline' =>'Notification will be sent in the next 24 hours'
                ];




                Notification::send($user,new EmailTechnicians($details));
                Notification::send($user, new sendNotification("Pending Repair! ",$w['WorkId']));

            }



        }





        $this->info('Success');


    }
}
