<?php
class Store {
  var array $productContainers;

  private function printAssortment(StoreUser $user) {
    echo "# | Продукт | Цена | Кол-во\n";

    foreach ($this->productContainers as $index => $container) {
      $product = $container->product;
      $number = $index + 1;
      if($product->minimalAgeAllowed <= $user->userAge)
      echo "$number | $product->userName | $product->price | $container->amount\n";
    }
  }

  public function __construct(array $productContainers = array()) {
    $this->productContainers = $productContainers;
  }

  public function selectProduct(StoreUser $user, ShoppingCart $cart) {
    if ($user->userAge == 0) {
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

class StoreProduct {
  var string $userName;
  var float $price;
  var int $minimalAgeAllowed;

  public function __construct(string $userName, float $price, int $minimalAgeAllowed = 0) {
    $this->userName = $userName;
    $this->price = $price;
    $this->minimalAgeAllowed = $minimalAgeAllowed;
  }
}

class ProductWithAmount {
  var StoreProduct $product;
  var int $amount;

  public function __construct(StoreProduct $product, int $amount = 1) {
    $this->product = $product;
    $this->amount = $amount;
  }

  public function takeProduct(int $amount = 1) {
    if ($amount > $this->amount){
      $oldAmount = $this->amount;
      $this->amount = 0;
      return new ProductWithAmount($this->product, $oldAmount);
    } else {
      $this->amount -= $amount;
      return new ProductWithAmount($this->product, $amount);
    }
  }
}

class ShoppingCart {
  var array $productContainers = array();

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
      echo "$product->userName | $product->price * $container->amount = $categoryPrice\n";
      $total += $categoryPrice;
    }

    echo "- - - - - - - \n";
    echo "Всего: \$$total\n";
  }
}
$shoppingCart = new ShoppingCart;

$store = new Store(array(
  new ProductWithAmount(new StoreProduct("Колбаса", 96.43), ),
  new ProductWithAmount(new StoreProduct("Хлеб", 19.21), 20 ),
  new ProductWithAmount(new StoreProduct("Алкогольный энергетик", 74.1, 18), 4),
));

class StoreUser {
  var string $userName = "Юрий";
  var int $userAge = 0;

  public function setAge(int $userAge) {
    if ($userAge > 3 && $userAge < 200) {
      $this->userAge = $userAge;
      return $userAge;
    }
    return 0;
  }

  public function configureProfile() {
    $changeChoice = 3;

    while ($changeChoice != 0) {
      echo "Имя: $this->userName\n";
      echo "Возраст: $this->userAge\n";
      echo "Что требуется изменить? (1/2/0)\n";
      $changeChoice = readline("> ");
      switch ($changeChoice) {
        case 1:
          $this->userName = readline("Новое имя: ");
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
$user = new StoreUser;

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

$userChoice = 4;

while ($userChoice > 0) {
  printMenu();
  $userChoice = readline("> ");

  while ($userChoice < 0 || $userChoice > 3) {
    echo "Ошибка!\n";
    $userChoice = readline("Предлагаем ввести другое число: ");
  }

  switch ($userChoice) {
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

