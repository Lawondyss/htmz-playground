<?php

use App\Model\Products;
use App\Model\Services;
use Nette\Application\Application;
use Nette\Application\Routers\RouteList;
use Nette\Bootstrap\Configurator;
use NetteModule\MicroPresenter;

require __DIR__ . '/vendor/autoload.php';

const AppDir = __DIR__ . '/app';
const LogDir = __DIR__ . '/log';
const TempDir = __DIR__ . '/temp';
const ConfigDir = __DIR__ . '/config';
const TemplatesDir = __DIR__ . '/templates';

/***** DI container *************************************************/
$configurator = new Configurator;
$configurator->enableTracy(LogDir);
$configurator->setDebugMode(true);
$configurator->setTempDirectory(TempDir);

$configurator->addConfig(ConfigDir . '/common.neon');
$container = $configurator->createContainer();

/***** Routes *******************************************************/
$router = new RouteList;
$container->addService('router', $router);

// Homepage
$router->addRoute('/', static function (MicroPresenter $presenter) {
  return $presenter->createTemplate()
                   ->setFile(TemplatesDir . '/@layout.latte');
});

// List of products
$router->addRoute('/products[/<page=1 \d+>]', static function (MicroPresenter $presenter) {
  $page = (int)$presenter->getRequest()->getParameter('page');
  $template = $presenter->createTemplate()
                        ->setFile(TemplatesDir . '/products.latte');

  $template->countPages = 2;
  $template->products = $presenter->getContext()->getByType(Products::class)->findForList($page);

  return $template;
});

// Detail of product
$router->addRoute('/products/<id \w{5}>', static function (MicroPresenter $presenter) {
  $id = $presenter->getRequest()->getParameter('id');
  $product = $presenter->getContext()->getByType(Products::class)->get($id);

  $template = $presenter->createTemplate();

  if ($product === null) {
    $template->setFile(TemplatesDir . '/product-not-found.latte');
  } else {
    $template->setFile(TemplatesDir . '/product.latte');
    $template->product = $product;
  }

  return $template;
});

// List of services
$router->addRoute('/services', static function (MicroPresenter $presenter) {
  $template = $presenter->createTemplate()
                        ->setFile(TemplatesDir . '/services.latte');

  $services = $presenter->getContext()->getByType(Services::class);

  $template->payments = $services->findPayments();
  $template->transports = $services->findTransports();
  $template->others = $services->findOthers();

  return $template;
});

/***** Run app ******************************************************/
$container->getByType(Application::class)->run();
