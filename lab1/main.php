<?php

enum Sector : string {
    case TECHNOLOGY = 'technology';
    case FINANCE = 'finance';
    case HEALTHCARE = 'healthcare';
    case ENERGY = 'energy';
}

class StockPrice {
    public string $date;
    public float $closed_price;
    public float $opened_price;
    public float $highest_price;
    public float $lowest_price;

    public function __construct(string $date, float $closed_price, float $opened_price, float $highest_price, float $lowest_price) {
        $this->date = $date;
        $this->closed_price = $closed_price;
        $this->opened_price = $opened_price;
        $this->highest_price = $highest_price;
        $this->lowest_price = $lowest_price;
    }
}

class Stock {
    public string $ticker;
    public int $shares_outstanding;
    public Sector $sector;
    public array $stock_prices = [];

    public function __construct(string $ticker, int $shares_outstanding, Sector $sector) {
        $this->ticker = $ticker;
        $this->shares_outstanding = $shares_outstanding;
        $this->sector = $sector;
        $this->stock_prices = [];
    }
    public function addStockPrice(StockPrice $stockPrice){
        $date = $stockPrice->date;
        if(array_key_exists($date, $this->stock_prices)){
            echo "There is already a historical price for this date for this stock";
        }
        $this->stock_prices[$date] = $stockPrice;
        return true;
    }
    public function calculateMarketCapForDate($date){
        if(!array_key_exists($date, $this->stock_prices)) {
            echo "No historical price for this stock";
        }
        $price = $this ->stock_prices[$date]->closed_price;
        return $this->shares_outstanding * $price;
    }

    public function getLastClosedPrice(){
        $lastKey = array_key_last($this->stock_prices);
        if($lastKey === null)
            return null;
        return $this->stock_prices[$lastKey]->closed_price;
    }
}

class StockExchange {
    public string $exchange_name;
    public array $listed_stocks = [];

    public function __construct(string $exchange_name) {
        $this->exchange_name = $exchange_name;
    }

    public function listStock(Stock $stock) {
        $this->listed_stocks[] = $stock;
        return true;
    }

    public function findStockByTicker(string $ticker){
        foreach ($this->listed_stocks as $stock){
            if($stock->ticker === $ticker){
                return $stock;
            }
        }
        echo "Stock not found";
    }
}

class Portfolio {
    public float $cash;
    public array $stockHoldings = [];
    public function __construct(float $cash){
        $this-> cash = $cash;
    }

    public function buyStock(string $ticker, int $numberOfShares, StockExchange $stockExchange) {
        $stock = $stockExchange->findStockByTicker($ticker);
        if ($stock === null)
            echo "Stock not found";
        $price = $stock->getLastClosedPrice();
        if ($price === null) {
            echo "No price available for this stock";
        }
        $cost = $price * $numberOfShares;
        if ($this->cash < $cost) {
            echo "Insufficient cash to buy this stock";
        }
        $this->cash -= $cost;
        $found = false;
        foreach ($this->stockHoldings as &$holding) {
            if ($holding['stock']->ticker === $ticker) {
                $holding['numberOfShares'] += $numberOfShares;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->stockHoldings[] = ['numberOfShares' => $numberOfShares, 'stock' => $stock];
        }
        echo "Bought {$numberOfShares} shares of {$ticker} for {$cost} USD on {$stockExchange->exchange_name}";
        return true;
    }

    public function sellStock(string $ticker, int $numberOfShares, StockExchange $stockExchange) {
        $stock = $stockExchange->findStockByTicker($ticker);
        if ($stock === null) {
            echo "Stock not found";
            return null;
        }
        $holdingIndex = null;
        foreach ($this->stockHoldings as $idx => $holding) {
            if ($holding['stock']->ticker === $ticker) {
                $holdingIndex = $idx;
                break;
            }
        }
        if ($holdingIndex === null) {
            echo "Not enough shares to sell";
            return null;
        }
        if ($this->stockHoldings[$holdingIndex]['numberOfShares'] < $numberOfShares) {
            echo "Not enough shares to sell";
            return null;
        }
        $price = $stock->getLastClosedPrice();
        if ($price === null) {
            echo "No price available for this stock";
            return null;
        }
        $proceeds = $price * $numberOfShares;
        $this->cash += $proceeds;
        $this->stockHoldings[$holdingIndex]['numberOfShares'] -= $numberOfShares;
        if ($this->stockHoldings[$holdingIndex]['numberOfShares'] <= 0) {
            unset($this->stockHoldings[$holdingIndex]);
            $this->stockHoldings = array_values($this->stockHoldings);
        }
        echo "Sold {$numberOfShares} shares of {$ticker} for {$proceeds} USD on {$stockExchange->exchange_name}";
        return true;
    }
}

$applePrice1 = new StockPrice('01/01/2025', 100.0, 95.0, 102.0, 90.0);
$applePrice2 = new StockPrice('02/01/2025', 110.0, 100.0, 115.0, 98.0);
$applePrice3 = new StockPrice('03/01/2025', 120.0, 112.0, 125.0, 110.0);

$appleStock = new Stock('AAPL', 16000000000.0, Sector::TECHNOLOGY);
$appleStock->addStockPrice($applePrice1);
$appleStock->addStockPrice($applePrice2);
$appleStock->addStockPrice($applePrice3);

$microsoftStock = new Stock('MSFT', 7500000000.0, Sector::TECHNOLOGY);
$microsoftStock->addStockPrice(new StockPrice('01/01/2025', 300.0, 295.0, 310.0, 290.0));

$nasdaq = new StockExchange('NASDAQ');
$nasdaq->listStock($appleStock);
$nasdaq->listStock($microsoftStock);

echo "MarketCap 02/01/2025: ".($appleStock->calculateMarketCapForDate('02/01/2025') ?? 'null')." USD\n";

$portfolio = new Portfolio(10000.0);
$portfolio->buyStock('AAPL', 10, $nasdaq);
$portfolio->buyStock('MSFT', 5, $nasdaq);
$portfolio->buyStock('MSFT', 1000, $nasdaq);
$portfolio->sellStock('AAPL', 4, $nasdaq);
$portfolio->sellStock('MSFT', 50, $nasdaq);

//echo "Cash: {$portfolio->cashBalance} USD\n";
print_r($portfolio->stockHoldings);