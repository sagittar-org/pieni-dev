<?php
namespace pieni\site;

class Docs
{
	public function index()
	{
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
	}

	public function package($package)
	{
		require_once \pieni\core\FCPATH.'/vendor/autoload.php';
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
		$this->vars['package'] = $package;
		$spreadsheet = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx())->load(\pieni\core\FCPATH."/vendor/pieni/site/views/docs/{$package}/{$package}.xlsx");
		$sheet = $spreadsheet->getSheetByName('overview');
		for ($r = 2; ($id = $sheet->getCellByColumnAndRow(1, $r)->getValue()) !== null; $r++)
		{
			if ($id !== 'overview') continue;
			$this->vars['value'] = $sheet->getCellByColumnAndRow(2, $r)->getValue();
		}
		return $this->vars;
	}

	public function overview($package, $class)
	{
		require_once \pieni\core\FCPATH.'/vendor/autoload.php';
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
		$this->vars['package'] = $package;
		$this->vars['class'] = $class;
		$spreadsheet = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx())->load(\pieni\core\FCPATH."/vendor/pieni/site/views/docs/{$package}/classes/{$class}.xlsx");
		$sheet = $spreadsheet->getSheetByName('overview');
		for ($r = 2; ($id = $sheet->getCellByColumnAndRow(1, $r)->getValue()) !== null; $r++)
		{
			if ($id !== 'overview') continue;
			$this->vars['value'] = $sheet->getCellByColumnAndRow(2, $r)->getValue();
		}
		return $this->vars;
	}

	public function reference($package, $class, $method)
	{
		require_once \pieni\core\FCPATH.'/vendor/autoload.php';
		require_once \pieni\core\FCPATH.'/vendor/pieni/utility/helpers/utility.php';
		$this->vars['package'] = $package;
		$this->vars['class'] = $class;
		$spreadsheet = (new \PhpOffice\PhpSpreadsheet\Reader\Xlsx())->load(\pieni\core\FCPATH."/vendor/pieni/site/views/docs/{$package}/classes/{$class}.xlsx");
		$sheet = $spreadsheet->getSheetByName('reference');
		for ($r = 2; ($id = $sheet->getCellByColumnAndRow(1, $r)->getValue()) !== null; $r++)
		{
			if ($id !== $method) continue;
			$this->vars['id'] = $id;
			$this->vars['title'] = $sheet->getCellByColumnAndRow(2, $r)->getValue();
			$this->vars['description'] = $sheet->getCellByColumnAndRow(3, $r)->getValue();
			$this->vars['comment'] = $sheet->getCellByColumnAndRow(4, $r)->getValue();
			$this->vars['parameters'] = $sheet->getCellByColumnAndRow(5, $r)->getValue();
			$this->vars['returnvalues'] = $sheet->getCellByColumnAndRow(6, $r)->getValue();
			$this->vars['changelog'] = $sheet->getCellByColumnAndRow(7, $r)->getValue();
			$this->vars['examples'] = $sheet->getCellByColumnAndRow(8, $r)->getValue();
			$this->vars['notes'] = $sheet->getCellByColumnAndRow(9, $r)->getValue();
			$this->vars['seealso'] = $sheet->getCellByColumnAndRow(10, $r)->getValue();
		}
		return $this->vars;
	}
}
