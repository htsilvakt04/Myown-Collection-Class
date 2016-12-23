<?php
//The main mission of this class is solving all the results that retrieved from database.
 class Collection
 {
   protected $items;
   public function __construct($items = [])
   {
     $this->items = (array) $items;
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

 }
