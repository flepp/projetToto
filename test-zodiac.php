<?php

//inclut automatiquement tous les packages de Composer

require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

try {
  $zodiacSign = $calculator->calculate(13,6);

  $tradFr = array(

  		'aries' => 'bélier',
  		'taurus' => 'taureau',
  		'cancer' => 'cancer',
  		'aquarius' => 'verseau',
  		'capricorn' => 'capricorne',
  		'gemini' => 'gemeaux',
  		'leo' => 'lion',
  		'virgo' => 'vierge',
  		'libra' => 'balance',
  		'scorpio' => 'scorpion',
  		'sagittarius' => 'sagittaire',
  		'pisces' => 'poisson'

  	);

  echo $tradFr[$zodiacSign];

} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}