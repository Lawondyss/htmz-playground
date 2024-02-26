<?php

namespace App\Model;

final class Services
{
  private const array Payments = [
    'platební karta',
    'dobírka',
    'platba při převzetí',
  ];

  private const array Transports = [
    'PPL',
    'Česká pošta',
    'osobní převzetí',
  ];

  private const array Others = [
    'prodloužená záruka',
    'pojištění dopravy',
  ];


  public function findPayments(): array
  {
    return $this::Payments;
  }


  public function findTransports(): array
  {
    return $this::Transports;
  }


  public function findOthers(): array
  {
    return $this::Others;
  }
}