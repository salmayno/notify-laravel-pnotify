<?php

namespace Notify\Laravel\Pnotify\Tests;

class NotifyPnotifyServiceProviderTest extends TestCase
{
    public function test_container_contain_notify_services()
    {
        $this->assertTrue($this->app->bound('notify.producer'));
        $this->assertTrue($this->app->bound('notify.producer.pnotify'));
    }

    public function test_notify_factory_is_added_to_extensions_array()
    {
        $manager = $this->app->make('notify.producer');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('drivers');
        $property->setAccessible(true);

        $extensions = $property->getValue($manager);

        $this->assertCount(1, $extensions);
        $this->assertInstanceOf('Notify\Producer\ProducerInterface', $extensions['pnotify']);
    }

    public function test_config_pnotify_injected_in_global_notify_config()
    {
        $manager = $this->app->make('notify.producer');

        $reflection = new \ReflectionClass($manager);
        $property = $reflection->getProperty('config');
        $property->setAccessible(true);

        $config = $property->getValue($manager);

        $this->assertArrayHasKey('pnotify', $config->get('adapters'));

        $this->assertEquals(array(
            'toastr' => array('scripts' => array('jquery.js'), 'styles' => array('styles.css'), 'options' => array()),
            'pnotify' => array('scripts' => array('jquery.js'), 'styles' => array('styles.css'), 'options' => array()),
        ), $config->get('adapters'));
    }
}
