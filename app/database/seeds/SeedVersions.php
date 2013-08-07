<?php
use Carbon\Carbon;
use Registry\Abstracts\AbstractSeeder;
use Registry\Package;

class SeedVersions extends AbstractSeeder
{
	/**
	 * Seed versions
	 *
	 * @return void
	 */
	public function run()
	{
		$this->versions->flush();

		foreach ($this->packages->all() as $package) {
			foreach ($package->getPackagist()['versions'] as $version) {
				$time = new Carbon($version['time']);
				$this->versions->create(array(
					'name'        => $version['name'],
					'description' => $version['description'],
					'keywords'    => array_values($version['keywords']),
					'homepage'    => $version['homepage'],
					'version'     => $version['version'],

					'created_at'  => $time->toDateTimeString(),
					'updated_at'  => $time->toDateTimeString(),
					'package_id'  => $package->id,
				));
			}
		}
	}
}
