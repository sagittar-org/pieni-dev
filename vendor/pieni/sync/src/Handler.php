<?php
namespace pieni\sync;

class Handler
{
	public function __construct(string $name, $drivers)
	{
		$this->name = $name;
		foreach ($drivers as $driver) {
			$driver[1]['handler'] = $this;
			$this->drivers[] = new $driver[0]($driver[1]);
		}
	}

	public function mtime(string $name = '')
	{
		return $this->timeInfo($name)[0]['mtime'];
	}

	public function get(string $name = '')
	{
		list($latest, $mtimes) = $this->timeInfo($name);
		$data = $this->drivers[$latest['index']]->get($name);
		foreach ($this->drivers as $index => $driver) {
			if ($mtimes[$index] < $latest['mtime']) {
				$driver->put($data, $latest['mtime'], $name);
			}
		}
		return $data;
	}

	private function timeInfo(string $name)
	{
		$latest = ['mtime' => -2];
		foreach ($this->drivers as $index => $driver) {
			if (($mtimes[$index] = $driver->mtime($name)) > $latest['mtime']) {
				$latest = ['mtime' => $mtimes[$index], 'index' => $index];
			}
		}
		return [$latest, $mtimes];
	}
}
