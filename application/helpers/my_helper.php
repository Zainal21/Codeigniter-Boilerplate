<?php

function anti_injection($string)
{
  $data = stripslashes(strip_tags(htmlentities(htmlspecialchars($string, ENT_QUOTES))));
  return str_replace("'", "", $data);
}

function PasswordEncrypt($kunci)
{
  return hash('sha512', $kunci . config_item('encryption_key'));
}

function dd($data)
{
  echo json_encode($data);
  die;
}
function last()
{
  $ci = &get_instance();
  echo $ci->db->last_query();
  die;
}

function headerL($data)
{
  $ci = &get_instance();
  return $ci->load->view('page/headerpdf/landscape', $data, true);
}
function headerP($data)
{
  $ci = &get_instance();
  return $ci->load->view('page/headerpdf/potrait', $data, true);
}

if (!function_exists('number_to_words')) {
  function number_to_words($number)
  {
      $before_comma = trim(to_word($number));
      $after_comma = trim(comma($number));
      return ucwords($results = $before_comma . ' rupiah ' . $after_comma);
  }

  function to_word($number)
  {
      $words = "";
      $arr_number = array(
          "",
          "satu",
          "dua",
          "tiga",
          "empat",
          "lima",
          "enam",
          "tujuh",
          "delapan",
          "sembilan",
          "sepuluh",
          "sebelas"
      );

      if ($number < 12) {
          $words = " " . $arr_number[$number];
      } else if ($number < 20) {
          $words = to_word($number - 10) . " belas";
      } else if ($number < 100) {
          $words = to_word($number / 10) . " puluh " . to_word($number % 10);
      } else if ($number < 200) {
          $words = "seratus " . to_word($number - 100);
      } else if ($number < 1000) {
          $words = to_word($number / 100) . " ratus " . to_word($number % 100);
      } else if ($number < 2000) {
          $words = "seribu " . to_word($number - 1000);
      } else if ($number < 1000000) {
          $words = to_word($number / 1000) . " ribu " . to_word($number % 1000);
      } else if ($number < 1000000000) {
          $words = to_word($number / 1000000) . " juta " . to_word($number % 1000000);
      } else {
          $words = "undefined";
      }
      return $words;
  }
}

function NumberFilter($angka)
{
  $hasil = '0';
  if (trim($angka) != '') {
      $hasil = str_replace(".", "", $angka);
  }
  return $hasil;
}

if (!function_exists('PriceToNumber')) {
  function PriceToNumber($value)
  {
    if (!$value) {
        return 0;
    }
    $value = preg_replace('/[^0-9,]/', '', $value);
    $value = str_replace(',', '.', $value);
    // $v = number_format($v,2);
    $value = floatval($value);
    return $value;
  }
}
if (!function_exists('NumberToPrice')) {
  function NumberToPrice($item)
  {
    if (!$item) {
        return 0;
    }
    $item = number_format($item, 2, ',', '.');
    // $v = explode(".", $v);
    // $comma= $v[1];
    // $v= preg_replace('/[^0-9,]/','',$v[0]);
    // $v= str_replace(',', '.', $v);
    // // $v= $v+','+$comma;
  
    // $v = floatval($v);
    return   $item;
    // return $comma;
  }
}

if (!function_exists('timestamp_format')) {
    function timestamp_format($timestamp)
    {
        $time = time() - $timestamp;

        if ($time < 60) {
            return ($time > 1) ? $time.' Detik Lalu' : 'Beberapa detik lalu';
        } elseif ($time < 3600) {
            $tmp = floor($time / 60);

            return ($tmp > 1) ? $tmp.' Menit Lalu' : ' Semenit Yang Lalu';
        } elseif ($time < 86400) {
            $tmp = floor($time / 3600);

            return ($tmp > 1) ? $tmp.' Jam Lalu' : ' Sejam Lalu';
        } elseif ($time < 2592000) {
            $tmp = floor($time / 86400);

            return ($tmp > 1) ? $tmp.' Hari Lalu' : ' Sehari yang Lalu';
        } elseif ($time < 946080000) {
            $tmp = floor($time / 2592000);

            return ($tmp > 1) ? $tmp.' months' : ' a month';
        } else {
            $tmp = floor($time / 946080000);

            return ($tmp > 1) ? $tmp.' years' : ' a year';
        }
    }
}

if (!function_exists('slug')) {
    function slug($input)
    {
        $input = preg_replace('~[^\\pL\d]+~u', '-', $input);
        $input = trim($input, '-');
        $input = iconv('utf-8', 'us-ascii//TRANSLIT', $input);
        $input = strtolower($input);
        $input = preg_replace('~[^-\w]+~', '', $input);
        if (empty($input)) {
            return '';
        }

        return $input;
    }
}
