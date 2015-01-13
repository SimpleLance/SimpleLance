<?php

class DashboardController extends BaseController {

	public function index()
	{
		if (Sentry::inGroup(Sentry::findGroupByName('Admins')))
		{

			return View::make('dashboard.admin');
		} else {

			return View::make('dashboard.user');
		}
	}
}