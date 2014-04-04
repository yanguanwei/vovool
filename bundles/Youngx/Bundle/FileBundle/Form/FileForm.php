<?php

namespace Youngx\Bundle\FileBundle\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Youngx\Bundle\FileBundle\Entity\File;
use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\Entity;

class FileForm extends UploadedFileForm
{
    /**
     * @var Entity
     */
    protected $entity;

    protected $entityCode;
    /**
     * @var User
     */
    protected $user;

    protected $multiple = true;

    /**
     * @var File
     */
    protected $oldFile;

    /**
     * @var File[]
     */
    protected $files = array();

    protected function generateUriByDate($filename)
    {
        return $this->baseUri . '/'.date('Y/m/', Y_TIME) . '/' . $filename;
    }

    protected function generateUri(UploadedFile $uploadedFile, $filename)
    {
        return $this->generateUriByDate($filename);
    }

    protected function onUploadedFileSave($field, UploadedFile $upload, $basePath, $filename)
    {
        static $file;
        if ($file === null) {
            $file = AppContext::repository()->create('file', array(
                    'uid' => $this->user->getId(),
                    'entity_code' => $this->getEntityCode(),
                    'entity_id' => $this->entity ? $this->entity->identifier() : 0,
                    'created_at' => date('Y-m-d H:i:s')
                ));
        }

        $clone  = clone $file;
        $clone->set(array(
                'filename' => $filename,
                'mime_type' => $upload->getClientMimeType(),
                'uri' => $this->generateUriByDate($upload, $filename)
            ));

        $this->onFileBeforeSave($field, $clone, $upload);
        $clone->save();
        $this->onFileBeforeSave($field, $clone, $upload);
        $this->files[$field] = $clone;
    }

    protected function onUploadedFileComplete()
    {
        if ($this->oldFile) {
            AppContext::repository()->delete($this->oldFile);
            $this->onOldFileDelete($this->oldFile);
        }
    }

    protected function onFileBeforeSave($key, File $file, UploadedFile $uploadedFile)
    {
    }

    protected function onFileSave($key, File $file, UploadedFile $uploadedFile)
    {
    }

    protected function onOldFileDelete(File $file)
    {
    }

    /**
     * @param Entity $entity
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param UploadedFile $file
     * @param null $key
     */
    public function setUploadedFile(UploadedFile $file, $key = null)
    {
        if (null !== $key) {
            $this->files[$key] = $file;
        } else {
            $this->files[] = $file;
        }
    }

    /**
     * @param array $uploadedFiles
     */
    public function setUploadedFiles(array $uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;
    }

    /**
     * @return UploadedFile[]
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return boolean
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @return File[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $entityCode
     */
    public function setEntityCode($entityCode)
    {
        $this->entityCode = $entityCode;
    }

    /**
     * @return mixed
     */
    public function getEntityCode()
    {
        return $this->entityCode;
    }

    /**
     * @param mixed $oldFile
     */
    public function setOldFile($oldFile)
    {
        $oldFile = intval($oldFile);
        if ($oldFile) {
            $this->oldFile = AppContext::repository()->load('file', $oldFile);
        }
    }
}