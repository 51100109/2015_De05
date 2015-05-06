<?php

class AdminsController extends BaseController {

	public function __construct(){
        $this->beforeFilter('check-admin');
    }

    public function getHome(){
        $system = OperateSystem::all();
        $activities = UserActivity::orderBy("created_at","desc")->paginate(20);
        return View::make('backend.admin.home', compact('system','activities'));
    }

    public function postReloadToolpanel(){
        $system = OperateSystem::all();
        return View::make('backend.admin.reload_toolpanel', compact('system'));
    }

    public function postReloadToolbar(){
        $system = OperateSystem::all();
        return View::make('backend.admin.reload_toolbar', compact('system'));
    }
}
