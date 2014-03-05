<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            //Sonata
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),

            new Sonata\DoctrinePHPCRAdminBundle\SonataDoctrinePHPCRAdminBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),

            //Utils
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            // Doctrine PHPCR
            new Doctrine\Bundle\PHPCRBundle\DoctrinePHPCRBundle(),

            // CMF bundles
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            new Symfony\Cmf\Bundle\CoreBundle\CmfCoreBundle(),
            new Symfony\Cmf\Bundle\MenuBundle\CmfMenuBundle(),
            new Symfony\Cmf\Bundle\ContentBundle\CmfContentBundle(),
            new Symfony\Cmf\Bundle\TreeBrowserBundle\CmfTreeBrowserBundle(),
            new Symfony\Cmf\Bundle\BlockBundle\CmfBlockBundle(),

            //PrestaAdmin
            new Presta\SonataAdminExtendedBundle\PrestaSonataAdminExtendedBundle(),
            new Presta\SonataNavigationBundle\PrestaSonataNavigationBundle(),
            new Presta\SonataGedmoDoctrineExtensionsBundle\PrestaSonataGedmoDoctrineExtensionsBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
            new Presta\ComposerPublicBundle\PrestaComposerPublicBundle(),

            //PrestaCMS
            new Presta\CMSCoreBundle\PrestaCMSCoreBundle(),
            new Presta\CMSMediaBundle\PrestaCMSMediaBundle(),
            new Presta\CMSThemeBasicBundle\PrestaCMSThemeBasicBundle(),
            new Presta\CMSContactBundle\PrestaCMSContactBundle(),
            new Presta\CMSSitemapBridgeBundle\PrestaCMSSitemapBridgeBundle(),
            new Presta\SitemapBundle\PrestaSitemapBundle(),
            new Presta\CMSCKEditorBundle\PrestaCMSCKEditorBundle(),
            new Presta\CMSFAQBundle\PrestaCMSFAQBundle(),

            //PrestaCMS-Sandbox
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Application\Sonata\AdminBundle\ApplicationSonataAdminBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Application\Presta\CMSCoreBundle\ApplicationPrestaCMSCoreBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * Vagrant optimisation: set cache directory in the vm
     *
     * @return string
     */
    public function getCacheDir()
    {
        $envParameters = $this->getEnvParameters();

        if ($this->getEnvironment() === 'dev'
            || (isset($envParameters['vagrant']) && $envParameters['vagrant'] === "1")) {
            return '/dev/shm/vagrant/cache/' .  $this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     *  Vagrant optimisation: set log directory in the vm
     *
     * @return string
     */
    public function getLogDir()
    {
        $envParameters = $this->getEnvParameters();

        if ($this->getEnvironment() === 'dev'
            || (isset($envParameters['vagrant']) && $envParameters['vagrant'] === "1")) {
            return '/dev/shm/vagrant/logs';
        }

        return parent::getLogDir();
    }
}
