<?php

namespace App\Model;

use function array_filter;
use function array_map;
use function array_slice;
use function current;

final class Products
{
  private const array Data = [
    [
      'id' => 'qwert',
      'code' => 'hLV001',
      'image' => 'id/21/',
      'name' => 'Bílé lodičky',
      'description' => 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum vel dignissim lectus. Nulla facilisi. Nam sit amet lectus mi. Morbi magna elit, vehicula ac ornare vel, eleifend nec ante. Proin vehicula massa tortor, eu finibus ipsum fringilla in. Nam orci libero, auctor vel erat id, luctus pharetra metus. Maecenas ut felis eget eros posuere luctus. Duis interdum eleifend gravida. Etiam placerat aliquam ante. Nam feugiat dui ac consectetur fringilla.',
      'priceWithVat' => 2_599.0,
      'vat' => 20,
    ],
    [
      'id' => 'zuiop',
      'code' => 'kVL002',
      'image' => 'id/225/',
      'name' => 'Čajový set',
      'description' => 'Donec nisl ex, pharetra sit amet purus at, blandit viverra quam. Nullam turpis odio, euismod ullamcorper egestas vitae, lacinia ut est. Integer interdum tempus tortor sed blandit. Ut quis dolor lorem. Nullam interdum tincidunt sem, eget fringilla magna euismod placerat. Proin commodo eu nunc ut vestibulum. Vestibulum hendrerit, turpis a congue vehicula, velit lectus auctor dolor, et interdum lacus mi id purus.',
      'priceWithVat' => 18_300.0,
      'vat' => 20,
    ],
    [
      'id' => 'asdfg',
      'code' => 'sLV003',
      'image' => 'id/239/',
      'name' => 'Pampeliška',
      'description' => 'Praesent eleifend nibh eget diam rhoncus, et laoreet lacus ultricies. Donec feugiat est enim, a aliquam nibh volutpat cursus. Donec ut iaculis ligula. Aliquam dapibus nisl at ex porta, vel tristique neque ullamcorper. Integer ultricies volutpat efficitur. Donec laoreet dapibus sapien quis scelerisque. Cras id dolor a ante eleifend dapibus. Donec a orci in turpis placerat porttitor. Proin massa urna, condimentum non ante sit amet, sodales imperdiet ex. Donec tellus velit, condimentum sit amet semper in, pellentesque sed tellus.',
      'priceWithVat' => 449.0,
      'vat' => 20,
    ],
    [
      'id' => 'hjkly',
      'code' => 'bLV004',
      'image' => 'id/318/',
      'name' => 'Eiffelova věž',
      'description' => 'Mauris posuere augue eget vulputate dictum. Aenean dapibus lectus in tincidunt sodales. Praesent posuere finibus facilisis. Nam eu purus sodales, eleifend erat quis, tempor dolor. Suspendisse quis lectus egestas, commodo ipsum at, dictum velit. Sed at varius arcu. Aliquam tellus est, ultricies vitae lorem nec, consectetur consequat ex.',
      'priceWithVat' => 1_599_000.0,
      'vat' => 20,
    ],
    [
      'id' => 'xcvbn',
      'code' => 'pLV005',
      'image' => 'id/429/',
      'name' => 'Šálek malin',
      'description' => 'Sed ut ornare nisi. Suspendisse convallis semper interdum. Nullam tincidunt posuere bibendum. Phasellus porttitor nunc pretium nisi lobortis convallis. Vivamus quis mauris a arcu mattis consectetur. Integer sit amet ex efficitur, cursus odio feugiat, posuere diam. Mauris auctor sodales metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Curabitur et mattis urna. Donec vulputate velit non diam volutpat varius.',
      'priceWithVat' => 879.0,
      'vat' => 20,
    ],
  ];


  /**
   * @return ProductListItem[]
   */
  public function findForList(int $page): array
  {
    $onPage = 3;
    $offset = ($page - 1) * $onPage;
    $data = array_slice($this::Data, $offset, $onPage);

    return array_map(static fn(array $row) => ProductListItem::fromRow($row), $data);
  }


  public function get(string $id): ?ProductDetail
  {
    $row = current(array_filter($this::Data, static fn(array $r) => $r['id'] === $id));

    return $row ? ProductDetail::fromRow($row) : null;
  }
}