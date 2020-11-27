<?php

namespace Notify\Laravel\Pnotify\ServiceProvider\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Notify\Laravel\Pnotify\NotifyPnotifyServiceProvider;
use Notify\Producer\ProducerManager;
use Notify\Renderer\RendererManager;
use Notify\Pnotify\Producer\PnotifyProducer;
use Notify\Pnotify\Renderer\PnotifyRenderer;

class Laravel implements ServiceProviderInterface
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function shouldBeUsed()
    {
        return $this->app instanceof Application;
    }

    public function publishConfig(NotifyPnotifyServiceProvider $provider)
    {
        $source = realpath($raw = __DIR__.'/../../../resources/config/config.php') ?: $raw;

        $provider->publishes(array($source => config_path('notify_pnotify.php')), 'config');

        $provider->mergeConfigFrom($source, 'notify_pnotify');
    }

    public function registerNotifyPnotifyServices()
    {
        $this->app->singleton('notify.producer.pnotify', function (Container $app) {
            return new PnotifyProducer($app['notify.storage'], $app['notify.middleware']);
        });

        $this->app->singleton('notify.renderer.pnotify', function (Container $app) {
            return new PnotifyRenderer($app['notify.config']);
        });

        $this->app->alias('notify.producer.pnotify', 'Notify\Pnotify\Producer\PnotifyProducer');
        $this->app->alias('notify.renderer.pnotify', 'Notify\Pnotify\Renderer\PnotifyRenderer');

        $this->app->extend('notify.producer', function (ProducerManager $manager, Container $app) {
            $manager->addDriver('pnotify', $app['notify.producer.pnotify']);

            return $manager;
        });

        $this->app->extend('notify.renderer', function (RendererManager $manager, Container $app) {
            $manager->addDriver('pnotify', $app['notify.renderer.pnotify']);

            return $manager;
        });
    }

    public function mergeConfigFromPnotify()
    {
        $notifyConfig = $this->app['config']->get('notify.adapters.pnotify', array());

        $pnotifyConfig = $this->app['config']->get('notify_pnotify', array());

        $this->app['config']->set('notify.adapters.pnotify', array_merge($pnotifyConfig, $notifyConfig));
    }
}
