<?php
namespace pieni\site;

class Docs
{
	public function index()
	{
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
	}

	public function view($id)
	{
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
		$this->vars['content'] = $id;
		return $this->vars;
	}
}
