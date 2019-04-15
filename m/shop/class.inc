<?PHP
  class Cart
  {
     var $contents;

     function add ($num, $amount)
     {
        $this->contents[$num] += $amount;
     }

     function delete ($num)
     {
        if (count ($this->contents) > 0) {
           while (list ($key, $value) = each ($this->contents))
              if ($key != $num) $new_cart[$key] = $value;
           $this->contents = $new_cart;
        }
     }

     function getAmount ($num)
     {
        return $this->contents[$num];
     }

     function get_list() { return $this->contents; }

     function get_count() { return count ($this->contents); }
  }
?>