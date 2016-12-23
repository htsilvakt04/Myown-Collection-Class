<?php
//The main mission of this class is solving all the results (object) that retrieved from database.
 class Collection implements Countable, IteratorAggregate
 {

   protected $items;
   public function getIterator() {
      return new ArrayIterator($this->items);
    }
   public function __construct($items = [])
   {

     $this->items = is_array($items) ? $items : $this->getArrayableItems($items);
   }
   public function __toString()
   {
     return $this->toJson();
   }

   public function all()
   {
     return $this->items;
   }
   public function count()
   {
     return count($this->items);
   }
   public function isEmpty()
   {
     return empty($this->items);
   }
   public function first($default = null)
   {
     return isset($this->items[0]) ? $this->items[0] : $default;
   }
   public function last($default = null)
   {
     $reverse = array_reverse($this->items);
     return isset($reverse[0]) ? $reverse[0] : $default;
   }
   public function keys()
   {
     return new static (array_keys($this->items));
   }
   public function each(callable $callback)
   {
     foreach($this->items as $key => $item) {
       $callback($item, $key);
     }
     return $this;
   }

   public function filter(callable $callback = null)
   {
     if($callback) {
       return new static( array_filter($this->items, $callback));
     }
     return new static  (array_filter($this->items));
   }
   public function map(callable $callback)
   {
     $keys = $this->keys()->all();
     $items = array_map($callback, $this->items, $keys);
     return new static (array_combine($keys,$items));
   }
   public function toJson()
   {
     return json_encode($this->items);
   }
   public function merge($items)
   {
       return new static(array_merge($this->items, $this->getArrayableItems($items)));
   }
   protected function getArrayableItems($items)
   {
     if ($items instanceof Collection) {
       return $items->all();
     }
     return $items;
   }


 }
