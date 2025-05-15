<?php

// Абстрактный класс книги
abstract class AbstractBook {
    protected $title;
    protected $readCount = 0;

    public function __construct($title) {
        $this->title = $title;
    }

    public function read() {
        $this->readCount++;
    }

    public function getReadCount() {
        return $this->readCount;
    }

    abstract public function getAccessInfo();
}

// Цифровая книга
class DigitalBook extends AbstractBook {
    private $downloadLink;

    public function __construct($title, $downloadLink) {
        parent::__construct($title);
        $this->downloadLink = $downloadLink;
    }

    public function getAccessInfo() {
        return "Download here: {$this->downloadLink}";
    }
}

// Бумажная книга
class PaperBook extends AbstractBook {
    private $libraryAddress;

    public function __construct($title, $libraryAddress) {
        parent::__construct($title);
        $this->libraryAddress = $libraryAddress;
    }

    public function getAccessInfo() {
        return "Available at: {$this->libraryAddress}";
    }
}

// Использование
$ebook = new DigitalBook("1984", "https://library.com/download/1984");
$paper = new PaperBook("War and Peace", "Central Library, Room 12");

$ebook->read();
$ebook->read();
$paper->read();

echo $ebook->getAccessInfo() . PHP_EOL; // Ссылка
echo "Read count: " . $ebook->getReadCount() . PHP_EOL;

echo $paper->getAccessInfo() . PHP_EOL; // Адрес
echo "Read count: " . $paper->getReadCount() . PHP_EOL;

echo str_repeat("-", 40) . PHP_EOL;

// Задание 6 – static поведение

echo "== Static demo A ==\n";
class A {
    public function foo() {
        static $x = 0;
        echo ++$x . PHP_EOL;
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4

echo "== Static demo A/B ==\n";
class B extends A {}

$a1 = new A();
$b1 = new B();
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2