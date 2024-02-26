<?php

namespace App\Model;

readonly class ProductDetail
{
  private const string BaseUri = 'https://picsum.photos/';
  private const string Size = '1024/870';

  public function __construct(
    public string $id,
    public string $code,
    public string $image,
    public string $name,
    public string $description,
    public float $priceWithVat,
    public float $priceWoVat,
  ) {}


  public static function fromRow(array $row): self
  {
    return new self(
      id: $row['id'],
      code: $row['code'],
      image: self::BaseUri . $row['image'] . self::Size,
      name: $row['name'],
      description: $row['description'],
      priceWithVat: $row['priceWithVat'],
      priceWoVat: $row['priceWithVat'] / (1 + $row['vat'] / 100),
    );
  }
}