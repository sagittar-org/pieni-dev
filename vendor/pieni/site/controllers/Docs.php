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
echo load_view($id, [], '', true);
		$this->vars['content'] = load_view($id, [], '', true);
		return $this->vars;
	}
}
