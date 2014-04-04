<?php

namespace Youngx\Bundle\DistrictBundle\Module\AdminDistrictModule\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class DistrictImportForm extends Form
{
    public function __construct()
    {
        parent::__construct('districtImportForm');
    }

    protected function setup()
    {
        $this->add('file', 'Import File', null);
    }

    public function submit()
    {
        $file = $this->getField('file')->getValue();
        if ($file instanceof UploadedFile) {
            $handle = fopen($file->getRealPath(),"r");
            $district = AppContext::repository()->create('district');
            $ids = array();
            while ($info = fscanf($handle, "%d %s")) {
                $d = clone $district;
                list ($code, $label) = $info;
                $code = intval($code);
                $label = trim($label);
                $layer = $code % 10000 == 0 ? 1 : ($code % 100 == 0 ? 2 : 3);
                if ($layer == 1) {
                    $parent = 0;
                } else if ($layer == 2) {
                    $parentCode = (int) ((int)($code / 10000) * 10000);
                    $parent = $ids[$parentCode];
                } else {
                    $parentCode = (int) ((int)($code / 100) * 100);
                    $parent = $ids[$parentCode];
                }

                $d->set(array(
                        'code' => $code,
                        'name' => $label,
                        'layer' => $layer,
                        'parent_id' => $parent
                    ));
                $d->save();

                if ($layer < 3) {
                    $ids[$code] = $d->identifier();
                }
            }

            fclose($handle);
        }
    }
}