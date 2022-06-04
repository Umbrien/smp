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

  public function takeProduct(int $amount = 1) {
    if ($amount > $this->amount){
      $oldAmount = $this->amount;
      $this->amount = 0;
      return new ProductContainer($this->product, $oldAmount);
    } else {
      $this->amount -= $amount;
      return new ProductContainer($this->product, $amount);
    }
  }
}

class Store {
  var array $productContainers; # array<ProductContainer>

  private function printAssortment(User $user) {
    echo "# | Продукт | Цена | Кол-во\n";

    foreach ($this->productContainers as $index => $container) {
      $product = $container->product;
      $number = $index + 1;
      if($product->minAge <= $user->age)
      #$restriction = ($product->minAge > 0) ? "$product->minAge" : "-";
      #echo "$index | $product->name | $product->price | $container->amount | $restriction\n";
      echo "$number | $product->name | $product->price | $container->amount\n";
    }
  }

  public function __construct(array $productContainers = array()) {
    $this->productContainers = $productContainers;
  }

  public function selectProduct(User $user, ShoppingCart $cart) {
    if ($user->age == 0) {
      echo "Сначала нужно зарегистрироваться\n";
      return;
    }

    $this->printAssortment($user);

    $num = readline("Номер> ");
    if($num == 0) return;
    while (!($num <= count($this->productContainers) && $num > 0)) {
      if($num == 0) return;
      echo "Неправильный номер\n";
      $num = readline("Номер> ");
    }
    $selectedProductAmount = $this->productContainers[$num - 1]->amount;

    $amount = readline("Кол-во> ");
    while (!($amount <= $selectedProductAmount && $amount >= 1)) {
      echo "Неправильное кол-во\n";
      $amount = readline("Кол-во> ");
    }

    $takkenContainer = $this->productContainers[$num - 1]->takeProduct($amount);
    array_push($cart->productContainers, $takkenContainer);
    echo "Продукт успешно добавлен в корзину\n";
  }
}

$store = new Store(array(
  new ProductContainer(new Product("Колбаса", 96.43), ),
  new ProductContainer(new Product("Хлеб", 19.21), 20 ),
  new ProductContainer(new Product("Алкогольный энергетик", 74.1, 18), 4),
));

class User {
  var string $name = "Юрий";
  var int $age = 0;

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
      echo "Имя: $this->name\n";
      echo "Возраст: $this->age\n";
      echo "Что требуется изменить? (1/2/0)\n";
      $changeChoice = readline("> ");
      switch ($changeChoice) {
        case 1:
          $this->name = readline("Новое имя: ");
          break;
        case 2:
          $newAge = readline("Новый возраст: ");
          while(!($this->setAge($newAge))) {
            echo "Возраст должен быть между 3 и 200\n";
            $newAge = readline("Новый возраст: ");
          }
          break;
        default: break;
      }
    }
  }
}
$user = new User;

# TODO show product again and again in buying menu
class ShoppingCart {
  var array $productContainers = array(); # array<ProductContainer>

  public function printCheck() {
    if (empty($this->productContainers)) {
      echo "Корзина пуста. Желаете купить что-нибудь?\n";
      return;
    }

    echo "- - - - - - - \n";
    echo "- - Чек - - - \n";
    echo "- - - - - - - \n";
    $total = 0;
    foreach($this->productContainers as $container) {
      $product = $container->product;
      $categoryPrice = $product->price * $container->amount;
      echo "$product->name | $product->price * $container->amount = $categoryPrice\n";
      $total += $categoryPrice;
    }

    echo "- - - - - - - \n";
    echo "Всего: \$$total\n";
  }
}
$shoppingCart = new ShoppingCart;

function printMenu() {
  echo "---------------------\n";
  echo "------ Магазин ------\n";
  echo "---------------------\n";
  echo "\n";
  echo "Начать покупки - \"1\"\n";
  echo "Показать чек - \"3\"\n";
  echo "Настройки профиля - \"2\"\n";
  echo "Выход - \"0\"\n";
}

$choice = 4;

while ($choice > 0) {
  printMenu();
  $choice = readline("> ");

  while ($choice < 0 || $choice > 3) {
    echo "Ошибка!\n";
    $choice = readline("Предлагаем ввести другое число: ");
  }

  switch ($choice) {
    case 1:
      $store->selectProduct($user, $shoppingCart);
      break;
    case 3:
      $shoppingCart->printCheck();
      break;
    case 2:
      $user->configureProfile();
      break;
    default: break;
  }
}

?>

