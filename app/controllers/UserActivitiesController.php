<?php

class UserActivitiesController extends BaseController {

	/**
	 * Display a listing of useractivities
	 *
	 * @return Response
	 */
	public function __construct(){
    	$this->beforeFilter('check-admin', array('only' => array('getActivities','getHome')));
	}

	public function getHome(){
    	$admin_activities = UserActivity::selected(1,5);
        $user_activities = UserActivity::selected(0,5);
        return View::make('admin.home')->with('admin_activities', $admin_activities)->with('user_activities', $user_activities);
    }

  /*  public function getAdminActivities(){
        $admin_activities = UserActivity::selected(1,10);
        if (Request::ajax()) {
        return Response::json(View::make('user-activities.admin_activities',array('admin_activities'=>$admin_activities))->render());
    }
     return View::make('user-activities.admin_activities')->with('admin_activities',$admin_activities);
    }
*/
   public function getAdminActivities(){
        $activities = UserActivity::selected(1,10);
         return View::make('user-activities.admin_activities')->with('admin_activities', $activities);
    }

    public function getUserActivities(){
        $activities = UserActivity::selected(0,10);
        return View::make('user-activities.user_activities')->with('user_activities', $activities);
    }
	
/*	public function showActivities()
    {
        $activities = UserActivity::selected(1,10);

        if (Request::ajax()) {
            return Response::json(View::make('user-activities.activities', array('admin_activities' => $activities))->render());
        }

        return View::make('user-activities.activities', array('admin_activities' => $activities));
    }*/
}
