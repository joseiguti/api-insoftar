<?php
declare(strict_types=1);

namespace App\User;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Helper\UrlHelper;

class FindUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : FindUserHandler
    {
        $filters = $container->get('InputFilterManager');

        return new FindUserHandler(
            $container->get(UserModel::class),
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class),
            $container->get(UrlHelper::class),
            $filters->get(UserInputFilter::class)
        );
    }
}
