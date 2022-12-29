<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController {
  public function index() {
    return View::make('index');
  }

  public function upload() {
    if ($_FILES['file']['size'] > 0) {
      if (!is_dir(STORAGE_PATH)) {
        mkdir(STORAGE_PATH);
      }

      $storageFiles = array_slice(scandir(STORAGE_PATH), 2);
      if (count($storageFiles) > 0) {
        unlink(STORAGE_PATH . '/' . $storageFiles[0]);
      }

      foreach ($_FILES as $file) {
        $filePath = STORAGE_PATH . '/' . $file['name'];

        move_uploaded_file($file['tmp_name'], $filePath);
      }
    }

    header('location: /showData');
  }

  public function showData() {
    $storageFiles = array_slice(scandir(STORAGE_PATH), 2);
    $file = fopen(STORAGE_PATH . '/' . $storageFiles[0], 'r');

    $transactions = [];
    $totals = [
      'totalIncome' => 0,
      'totalExpense' => 0,
      'netTotal' => 0
    ];

    while (($transaction = fgetcsv($file)) !== false) {
      [$date, $checkNumber, $description, $amount] = $transaction;
      $amount = (float) str_replace(['$', ','], '', $amount);

      $totals['netTotal'] += $amount;
      if ($amount > 0) {
        $totals['totalIncome'] += $amount;
      } else {
        $totals['totalExpense'] += $amount;
      }


      $transactions[] = [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
      ];
    }
    array_shift($transactions);

    return View::make('showData', ['transactions' => $transactions, 'totals' => $totals]);
  }
}
