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
    if ($takeAmount > $amount){
      $oldAmount = $this->amount;
      $this->amount = 0;
      return $oldAmount;
    } else {
      $this->amount -= $amount;
      return $amount;
    }
  }
}

class Store {
  var array $productContainers; # array<ProductContainer>

  private function printAssortment() {
    echo "# | Product | Price | Amount | Min age\n";

    foreach ($this->productContainers as $index => $container) {
      $product = $container->product;
      $restriction = ($product->minAge > 0) ? "$product->minAge" : "-";
      echo "$index | $product->name | $product->price | $container->amount | $restriction\n";
    }
  }

  public function __construct(array $productContainers = array()) {
    $this->productContainers = $productContainers;
  }

  public function selectProduct() {
    $this->printAssortment();

    $num = readline("Number> ");
    while (!($num <= count($this->productContainers) && $num >= 0)) {
      echo "Wrong number\n";
      $num = readline("Number> ");
    }
    $selectedProductAmount = $this->productContainers[$num]->amount;

    $amount = readline("Amount> ");
    while (!($amount <= $selectedProductAmount && $amount >= 1)) {
      echo "Wrong amount\n";
      $amount = readline("Amount> ");
    }

    echo "product #$num x$amount";
  }
}

$store = new Store(array(
  new ProductContainer(new Product("Кавун", 56), ),
  new ProductContainer(new Product("Бурбон", 124.6, 18), 4),
));

class User {
  var string $name = "Don Deemon";
  var int $age = 4;

  public function setAge(int $age) {
    if ($age > 3 && $age < 200) {
      $this->age = $age;
      return $age;
    }
    return 0;
  }

  public function configureProfile() {
    $changeChoice = 3;

    while ($changeChoice != 0) {
      echo "Name: $this->name\n";
      echo "Age: $this->age\n";
      echo "What do you want to change? (1/2/0)\n";
      $changeChoice = readline("> ");
      switch ($changeChoice) {
        case 1:
          $this->name = readline("Enter new name: ");
          break;
        case 2:
          $newAge = readline("Enter new age: ");
          while(!($this->setAge($newAge))) {
            echo "Age must be between 3 and 200\n";
            $newAge = readline("Enter new age: ");
          }
          break;
        default: break;
      }
    }
  }
}
$user = new User;

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
    $store->selectProduct();
    break;
  case 3:
    echo "Will add later\n";
    break;
  case 2:
    $user->configureProfile();
    break;
  case 0:
    break;
}

?>

