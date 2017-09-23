<?php

namespace FormBuilderBundle\Stream;

use FormBuilderBundle\Tool\FileLocator;
use Pimcore\File;
use Pimcore\Logger;
use Pimcore\Model\Asset;

class PackageStream
{
    /**
     * @var FileLocator
     */
    protected $fileLocator;

    /**
     * PackageStream constructor.
     *
     * @param FileLocator $fileLocator
     */
    public function __construct(FileLocator $fileLocator)
    {
        $this->fileLocator = $fileLocator;
    }

    /**
     * @param        $data
     * @param string $formName
     *
     * @return bool|null|Asset
     */
    public function createZipAsset($data, $formName)
    {
        if (!is_array($data)) {
            return FALSE;
        }

        $files = [];
        $fieldName = NULL;

        foreach ($data as $fileData) {
            $fieldName = $fileData['fieldName'];
            $fileDir = $this->fileLocator->getFilesFolder() . '/' . $fileData['uuid'];
            if (is_dir($fileDir)) {
                $dirFiles = glob($fileDir . '/*');
                if (count($dirFiles) === 1) {
                    $files[] = [
                        'name' => $fileData['fileName'],
                        'uuid' => $fileData['uuid'],
                        'path' => $dirFiles[0]];
                }
            }
        }

        if (empty($files)) {
            return FALSE;
        }

        $key = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 5);
        $zipFileName = File::getValidFilename($fieldName) . '-' . $key . '.zip';
        $zipPath =  $this->fileLocator->getZipFolder() . '/' . $zipFileName;

        try {
            $zip = new \ZipArchive();
            $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($files as $fileInfo) {
                $zip->addFile($fileInfo['path'], $fileInfo['name']);
            }

            $zip->close();

            //clean up!
            foreach ($files as $fileInfo) {
                $targetFolder =  $this->fileLocator->getFilesFolder();
                $target = join(DIRECTORY_SEPARATOR, [$targetFolder, $fileInfo['uuid']]);

                if (is_dir($target)) {
                    $this->fileLocator->removeDir($target);
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            Logger::log('Error while creating zip for FormBuilder (' . $zipPath . '): ' . $e->getMessage());
            return FALSE;
        }

        if (!file_exists($zipPath)) {
            Logger::log('Zip Path does not exist (' . $zipPath . ')');
            return FALSE;
        }

        $formDataFolder = NULL;
        $formDataParentFolder = Asset\Folder::getByPath('/formdata');

        if (!$formDataParentFolder instanceof Asset\Folder) {
            Logger::error('formDataParent Folder does not exist (/formdata)!');
            return FALSE;
        }

        $formName = File::getValidFilename($formName);
        $formFolderExists = Asset\Service::pathExists('/formdata/' . $formName);

        if ($formFolderExists === FALSE) {
            $formDataFolder = new Asset\Folder();
            $formDataFolder->setCreationDate(time());
            $formDataFolder->setLocked(TRUE);
            $formDataFolder->setUserOwner(1);
            $formDataFolder->setUserModification(0);
            $formDataFolder->setParentId($formDataParentFolder->getId());
            $formDataFolder->setFilename($formName);
            $formDataFolder->save();
        } else {
            $formDataFolder = Asset\Folder::getByPath('/formdata/' . $formName);
        }

        if (!$formDataFolder instanceof Asset\Folder) {
            Logger::error('Error while creating formDataFolder: (/formdata/' . $formName . ')');
            return FALSE;
        }

        $assetData = [
            'data'     => file_get_contents($zipPath),
            'filename' => $zipFileName
        ];

        $asset = NULL;
        try {
            //$mailTemplate = \Pimcore\Model\Document::getById($templateId);
            $asset = \Pimcore\Model\Asset::create($formDataFolder->getId(), $assetData, FALSE);
            //$asset->setProperty('form_attachment', 'document', $mailTemplate);
            $asset->save();

            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
        } catch (\Exception $e) {
            Logger::log('Error while storing asset in Pimcore (' . $zipPath . '): ' . $e->getMessage());
            return FALSE;
        }

        return $asset;
    }

}