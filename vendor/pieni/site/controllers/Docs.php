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
		$this->vars['content'] = load_view(implode('/', func_get_args()), [], '', true);
		return $this->vars;
	}
}
