<?php
class Package extends Eloquent
{

	/**
	 * The raw informations
	 *
	 * @var Packagist\Api\Result\Package
	 */
	protected $informations;

	/**
	 * Get all of the Package's Maintainers
	 *
	 * @return Collection
	 */
	public function maintainers()
	{
		return $this->belongsToMany('Maintainer');
	}

	/**
	 * Get all of the Package's versions
	 *
	 * @return Collection
	 */
	public function versions()
	{
		return $this->hasMany('Version');
	}

	/**
	 * Get the informations of a package
	 *
	 * @return object
	 */
	public function getInformations()
	{
		if (!$this->informations) {
			$this->informations = Cache::rememberForever($this->name, function() {
				$informations = App::make('guzzle')->get('/packages/'.$this->name.'.json')->send()->json();

				return (object) $informations['package'];
			});
		}

		return $this->informations;
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get tags as an array
	 *
	 * @return array
	 */
	public function getTagsAttribute()
	{
		if ($this->versions->isEmpty()) return array();

		$tags = $this->versions[0]->keywords;
		$tags = array_filter($tags, function($value) {
			return !in_array($value, array('laravel', 'illuminate', 'L4', 'Laravel 4', 'laravel4', 'laravel-4'));
		});

		return $tags;
	}

	/**
	 * Get Maintainers as a string list
	 *
	 * @return string
	 */
	public function getMaintainersListAttribute()
	{
		$list = array();
		$maintainers = $this->maintainers;
		foreach ($maintainers as $maintainer) {
			$list[] = $maintainer->__toString();
		}

		return implode(', ', $list);
	}

}
