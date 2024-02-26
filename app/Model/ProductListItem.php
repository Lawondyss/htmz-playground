<?php

namespace App\Model;

final readonly class ProductListItem
{
  private const string BaseUri = 'https://picsum.photos/';
  private const string Size = '300/240';

  public function __construct(
    public string $id,
    public string $name,
    public string $image,
    public string $description,
    public float $price,
  ) {}


  public static function fromRow(array $row): self
  {
    return new self(
      id: $row['id'],
      name: $row['name'],
      image: self::BaseUri . $row['image'] . self::Size,
      description: $row['description'],
      price: $row['priceWithVat'],
    );
  }
}