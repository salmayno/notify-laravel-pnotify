<?php

namespace Notify\Laravel\Pnotify\ServiceProvider;

use Notify\Laravel\Pnotify\NotifyPnotifyServiceProvider;
use Notify\Laravel\Pnotify\ServiceProvider\Providers\ServiceProviderInterface;

final class ServiceProviderManager
{
    private $provider;

    /**
     * @var ServiceProviderInterface[]
     */
    private $providers = array(
        'Notify\Laravel\Pnotify\ServiceProvider\Providers\Laravel4',
        'Notify\Laravel\Pnotify\ServiceProvider\Providers\Laravel',
        'Notify\Laravel\Pnotify\ServiceProvider\Providers\Lumen',
    );

    private $notifyServiceProvider;

    public function __construct(NotifyPnotifyServiceProvider $notifyServiceProvider)
    {
        $this->notifyServiceProvider = $notifyServiceProvider;
    }

    public function boot()
    {
        $provider = $this->resolveServiceProvider();

        $provider->publishConfig($this->notifyServiceProvider);
        $provider->mergeConfigFromPnotify();
    }

    public function register()
    {
        $provider = $this->resolveServiceProvider();
        $provider->registerNotifyPnotifyServices();
    }

    /**
     * @return ServiceProviderInterface
     */
    private function resolveServiceProvider()
    {
        if ($this->provider instanceof ServiceProviderInterface) {
            return $this->provider;
        }

        foreach ($this->providers as $providerClass) {
            $provider = new $providerClass($this->notifyServiceProvider->getApplication());

            if ($provider->shouldBeUsed()) {
                return $this->provider = $provider;
            }
        }

        throw new \InvalidArgumentException('Service Provider not found.');
    }
}
