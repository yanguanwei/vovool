<?php

namespace Youngx\Bundle\FileBundle\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

abstract class UploadedFileForm extends Form
{
    /**
     * @var UploadedFile[]
     */
    protected $uploadedFiles = array();

    protected $baseUri = 'public://';

    protected $allowedExtensions = array();

    protected function validateInternal()
    {
        if ($this->allowedExtensions !== true) {
            foreach ($this->uploadedFiles as $name => $file) {
                if (!in_array(strtolower($file->getClientOriginalExtension()), $this->allowedExtensions)) {
                    return array(
                        $name =>  '非法的文件格式：' . $file->getClientOriginalExtension()
                    );
                }
            }
        }
    }

    protected function generateBasePathByDate()
    {
        return AppContext::locate($this->baseUri) . '/'.date('Y/m/', Y_TIME);
    }

    protected function generateFilenameByRandom($originalName, $originalExtension)
    {
        return md5(microtime(true) . $originalName) . '.' . $originalExtension;
    }

    protected function generateFilename(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getClientOriginalName();
    }

    protected function generateBasePath(UploadedFile $uploadedFile)
    {
        return $this->generateBasePathByDate();
    }

    public function submit()
    {
        if ($this->uploadedFiles && null != reset($this->uploadedFiles)) {
            foreach ($this->uploadedFiles as $field => $upload) {
                if ($upload->isValid()) {
                    $basePath = $this->generateBasePath($upload);
                    $filename = $this->generateFilename($upload);
                    $upload->move($basePath, $filename);
                    $this->onUploadedFileSave($field, $upload, $basePath, $filename);
                }
            }
            $this->onUploadedFileComplete();
        } else {
        }
    }

    protected function onUploadedFileSave($field, UploadedFile $upload, $basePath, $filename)
    {
    }

    protected function onUploadedFileComplete()
    {

    }

    /**
     * @param UploadedFile $file
     * @param null $key
     */
    public function setUploadedFile(UploadedFile $file, $key = null)
    {
        if (null !== $key) {
            $this->uploadedFiles[$key] = $file;
        } else {
            $this->uploadedFiles[] = $file;
        }
    }

    /**
     * @param array $uploadedFiles
     */
    public function setUploadedFiles(array $uploadedFiles)
    {
        $this->uploadedFiles = array_merge($this->uploadedFiles, $uploadedFiles);
    }

    /**
     * @return UploadedFile[]
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }
} 