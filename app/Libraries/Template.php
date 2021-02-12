<?php
namespace App\Libraries;

class Template
{
	/**
	 * Contents page
	 *
	 * @var array
	 */
	protected $templateData = [];

	/**
	 * Set contents
	 *
	 * @param string $name  Variable name in the template
	 * @param string $data Value to be passed to variable
	 * @return void
	 */
	private function set(string $name, string $data): void
	{
		// Set name data
		$this->templateData[$name] = $data;
	}

	/**
	 * Loading template
	 *
	 * @param string $template  Path of template to be used
	 * @param string $view      Path of view to be used
	 * @param array  $viewData View parameters
	 * @param array  $options Options supported by the view function <https://codeigniter4.github.io/userguide/general/common_functions.html?highlight=view#view>
	 * @return string
	 */
	public function load(string $template = '', string $view = '', array $viewData, array $options = []): string
	{
		// Set variable $contents in template
		$this->set('contents', view($view, $viewData));

		// Return template + view
		return view($template, $this->templateData, $options);
	}
}
