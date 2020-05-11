<?php

namespace frontend\widgets\phonesForHeader;

use common\models\Htmlpages;
use common\models\Subscriber;
use yii\base\Widget;

class PhonesForHeaderWidget extends Widget
{
    public $phones;

    public function init()
    {
        $this->phones = Htmlpages::findOne(8);;
    }

    public function run()
    {
        return $this->render('phonesForHeader', [
            'phones' => $this->phones,
        ]);
    }
}