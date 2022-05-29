<?php
class Product {
  var string $name;
  var float $price;
  var int $minAge;

  public function __construct(string $name, float $price, int $minAge = 0) {
    $this->name = $name;
    $this->price = $price;
    $this->minAge = $minAge;
  }
}

class ProductContainer {
  var Product $product;
  var int $amount;

  public function __construct(Product $product, int $amount = 1) {
    $this->product = $product;
    $this->amount = $amount;
  }

  public function takeProduct(int $takeAmount = 1) {
    if ($takeAmount > $amount) $this->amount = 0;
    else $this->amount -= $amount;
  }
}

class Store {
  var array $productContainers; # array<ProductContainer>

  public function printAssortment() {
    echo "# | Product | Price | Amount | Age restriction\n";

    foreach ($this->productContainers as $index => $container) {
      $product = $container->product;
      $restriction = ($product->minAge > 0) ? "$product->minAge" : "-";
      echo "$index | $product->name | $product->price | $container->amount | $restriction\n";
    }
  }
}

$store = new Store;
$store->productContainers = array(
  new ProductContainer(new Product("Кавун", 56), ),
  new ProductContainer(new Product("Бурбон", 124.6, 18), 4),
);

class User {
  var string $name;
  var int $age;
}

echo "/////////////////////\n";
echo "////// Магазин //////\n";
echo "/////////////////////\n";
echo "\n";
echo "Розпочати покупки - \"1\"\n";
echo "Отримати пiдсумковий рахунок - \"3\"\n";
echo "Налаштування профiлю - \"2\"\n";
echo "Вихiд iз програми - \"0\"\n";

$choice = readline("> ");

while ($choice < 0 || $choice > 3) {
  echo "Помилка!\n";
  $choice = readline("Пропонуемо вам ввести iнше число: ");
}

switch ($choice) {
  case 1:
    $store->printAssortment();
    break;
  case 3:
    echo "Will add later\n";
    break;
  case 2:
    echo "Will add later\n";
    break;
  case 0:
    break;
}

?>

