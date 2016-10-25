<?php 
class Home extends Controller
{
	public function index($name = '')
	{
		echo $name;
	}
	public function test()
	{
		echo 'Test';
	}
}