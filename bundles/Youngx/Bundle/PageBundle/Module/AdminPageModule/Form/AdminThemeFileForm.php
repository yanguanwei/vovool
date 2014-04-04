<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Youngx\Bundle\FileBundle\Form\UploadedFileForm;
use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;

class AdminThemeFileForm extends UploadedFileForm
{
    protected $theme;
    protected $basePath;

    public function __construct(Theme $theme, $basePath)
    {
        parent::__construct();

        $this->theme = $theme;
        $this->basePath = $basePath;
        $this->allowedExtensions = true;
    }

    protected function generateBasePath(UploadedFile $uploadedFile)
    {
        return AppContext::themeAssetPath($this->theme->getName(), $this->basePath, 'Front');
    }

    protected function setup()
    {
        $this->add('uploadedFiles', '上传的文件', 'array');
    }
}