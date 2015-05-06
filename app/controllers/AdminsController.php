<?php

class AdminsController extends BaseController {

	public function __construct(){
        $this->beforeFilter('check-admin');
    }

    public function getHome(){
        $system = OperateSystem::all();
        return View::make('backend.admin.home', compact('system'));
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
