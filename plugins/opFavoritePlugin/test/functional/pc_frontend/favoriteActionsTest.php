<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

include dirname(__FILE__).'/../../bootstrap/functional.php';
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser = new opTestFunctional(new opBrowser(), new lime_test(null, new lime_output_color()));
$browser
  ->info('Login')
  ->login('sns@example.com', 'password')
  ->isStatusCode(302)

// CSRF
  ->info('/favorite/add?id=2 - CSRF')
  ->post('/favorite/add?id=2', array('add' => '1'))
  ->checkCSRF()

  ->info('/favorite/delete/2 - CSRF')
  ->get('/favorite/delete/2')
  ->checkCSRF()

// XSS
  ->info('/favorite/add?id=3 - XSS')
  ->get('/favorite/add', array('id' => '3'))
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
  ->end()

  ->info('/favorite/list - XSS')
  ->get('/favorite/list')
  ->with('html_escape')->begin()
    ->isAllEscapedData('Member', 'name')
  ->end()
;

if (class_exists('BlogRssCache'))
{
  $browser
    ->info('Login')
    ->login('sns@example.com', 'password')
    ->isStatusCode(302)

    ->info('/ blog gadget - XSS')
    ->get('/')
    ->with('html_escape')->begin()
      ->isAllEscapedData('Member', 'name')
      ->countEscapedData(1, 'BlogRssCache', 'title', array('width' => 30))
    ->end()

    ->info('/favorite/blog gadget - XSS')
    ->get('/favorite/blog')
    ->with('html_escape')->begin()
      ->isAllEscapedData('Member', 'name')
      ->isAllEscapedData('BlogRssCache', 'title')
    ->end()
  ;
}

if (class_exists('Diary'))
{
  $browser
    ->info('Login')
    ->login('sns3@example.com', 'password')
    ->isStatusCode(302)

    ->info('/ diary gadget - XSS')
    ->get('/')
    ->with('html_escape')->begin()
      ->isAllEscapedData('Member', 'name')
      ->countEscapedData(1, 'Diary', 'title', array('width' => 30))
    ->end()

    ->info('/favorite/diary gadget - XSS')
    ->get('/favorite/diary')
    ->with('html_escape')->begin()
      ->isAllEscapedData('Member', 'name')
      ->countEscapedData(1, 'Diary', 'title', array('width' => 36))
    ->end()
  ;
}
