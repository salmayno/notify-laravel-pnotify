<?php

namespace Notify\Laravel\Pnotify\ServiceProvider\Providers;

use Notify\Laravel\Pnotify\NotifyPnotifyServiceProvider;

interface ServiceProviderInterface
{
    public function shouldBeUsed();

    public function publishConfig(NotifyPnotifyServiceProvider $provider);

    public function registerNotifyPnotifyServices();

    public function mergeConfigFromPnotify();
}
