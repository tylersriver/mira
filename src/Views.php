<?php

namespace Yocto\Views;

class Views
{
    /**
     * @var string
     */
    private string $viewsDirectory;

    /**
     * @var string
     */
    private string $viewExtension = 'phtml';

    /**
     * View constructor.
     *
     * @param  string $viewsDirectory
     * @param  string $viewExtension
     * @throws \Exception
     */
    public function __construct(string $viewsDirectory, string $viewExtension = 'phtml')
    {
        if (!is_dir($viewsDirectory)) {
            throw new DirectoryDoesNotExistException('Directory ' . $viewsDirectory . ' does not exist');
        }

        $this->viewExtension = $viewExtension;
        $this->viewsDirectory = $viewsDirectory;
    }

    /**
     * @param  string $viewName
     * @param  array  $params
     * @return string
     */
    public function render(string $viewName = 'index', array $params = []): string
    {
        $filePath = $this->viewsDirectory . '/' . $viewName . '.' . $this->viewExtension;
        if (!file_exists($filePath)) {
            return '';
        }

        // Inject Parameters
        if ($params) {
            extract($params);
        }

        // Get the view and return
        ob_start();
        include $filePath;
        return (string)ob_get_clean();
    }

    /**
     * This method is private because it should only becalled from inside
     * a template which has access to $this
     * @param string $viewName
     */
    private function insert(string $viewName): void /** @phpstan-ignore-line */
    {
        $filePath = $this->viewsDirectory . '/' . $viewName . '.' . $this->viewExtension;
        if (!file_exists($filePath)) {
            return;
        }

        include $filePath;
    }

    /**
     * @param  string $string
     * @return string
     */
    public function e(string $string): string
    {
        $flags = ENT_QUOTES | (defined('ENT_SUBSTITUTE') ? ENT_SUBSTITUTE : 0);
        return htmlspecialchars($string, $flags, 'UTF-8');
    }
}
