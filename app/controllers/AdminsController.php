<?php

class AdminsController extends BaseController {

	public function __construct(){
        $this->beforeFilter('auth');
        $this->beforeFilter('check-admin');
    }

    public function getHome(){
        $system = OperateSystem::all();
        return View::make('backend.admin.home', compact('system'));
    }

    public function postReloadToolpanel(){
        $system = OperateSystem::all();
        return View::make('backend.ajax.reload_toolpanel', compact('system'));
    }

    public function postReloadToolbar(){
        $system = OperateSystem::all();
        return View::make('backend.ajax.reload_toolbar', compact('system'));
    }

    public function postMessage(){
        return View::make('backend.ajax.message');
    }

    public function postCategory($item){
        $system = OperateSystem::find($item);
        return View::make('backend.ajax.category',compact('system'));
    }
}
