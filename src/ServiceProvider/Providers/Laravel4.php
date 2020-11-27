<?php

namespace Notify\Laravel\Pnotify\ServiceProvider\Providers;

use Illuminate\Foundation\Application;
use Notify\Laravel\Pnotify\NotifyPnotifyServiceProvider;

final class Laravel4 extends Laravel
{
    public function shouldBeUsed()
    {
        return $this->app instanceof Application && 0 === strpos(Application::VERSION, '4.');
    }

    public function publishConfig(NotifyPnotifyServiceProvider $provider)
    {
        $provider->package('php-notify/notify-laravel-pnotify', 'notify_pnotify', __DIR__.'/../../../resources');
    }

    public function mergeConfigFromPnotify()
    {
        $notifyConfig = $this->app['config']->get('notify::config.adapters.pnotify', array());

        $pnotifyConfig = $this->app['config']->get('notify_pnotify::config', array());

        $this->app['config']->set('notify::config.adapters.pnotify', array_merge($pnotifyConfig, $notifyConfig));
    }
}
