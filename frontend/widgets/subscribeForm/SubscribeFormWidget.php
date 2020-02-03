<?php

namespace frontend\widgets\subscribeForm;

use common\models\Subscriber;
use yii\base\Widget;

class SubscribeFormWidget extends Widget
{
    public $subscriber;

    public function init()
    {
        $this->subscriber = new Subscriber();
    }

    public function run()
    {
        return $this->render('subscribeForm', [
            'subscriber' => $this->subscriber,
        ]);
    }
}