<?php
/**
 * Copyright (C) 2019 Graham Breach
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * For more information, please contact <graham@goat1000.com>
 */

namespace Goat1000\SVGGraph;

/**
 * Creates and stores gradients
 */
class GradientList {

  private $graph;
  private $gradients = [];
  private $gradient_map = [];

  public function __construct(&$graph)
  {
    $this->graph =& $graph;
  }

  /**
   * Adds a gradient to the list, returning the element ID for use in url
   */
  public function addGradient($colours, $key = null, $radial = false)
  {
    if(is_null($key) || !isset($this->gradients[$key])) {

      if($radial) {
        // if this is a radial gradient, it must end with 'r'
        $last = count($colours) - 1;
        if(strlen($colours[$last]) == 1)
          $colours[$last] = 'r';
        else
          $colours[] = 'r';
      }

      // find out if this gradient already stored
      $hash = serialize($colours);
      if(isset($this->gradient_map[$hash]))
        return $this->gradient_map[$hash];

      $id = $this->graph->newID();
      if(is_null($key))
        $key = $id;
      $this->gradients[$key] = ['id' => $id, 'colours' => $colours];
      $this->gradient_map[$hash] = $id;
      return $id;
    }
    return $this->gradients[$key]['id'];
  }

  /**
   * Creates a gradient element
   */
  private function makeGradient($key)
  {
    $stops = '';
    $direction = 'v';
    $type = 'linearGradient';
    $colours = $this->gradients[$key]['colours'];
    $id = $this->gradients[$key]['id'];

    if(in_array($colours[count($colours)-1], ['h', 'v', 'r']))
      $direction = array_pop($colours);
    if($direction == 'r') {
      $type = 'radialGradient';
      $gradient = ['id' => $id];
    } else {
      $x2 = $direction == 'v' ? 0 : '100%';
      $y2 = $direction == 'h' ? 0 : '100%';
      $gradient = ['id' => $id, 'x1' => 0, 'x2' => $x2, 'y1' => 0, 'y2' => $y2];
    }

    $col_mul = 100 / (count($colours) - 1);
    $offset = 0;
    foreach($colours as $pos => $colour) {
      $opacity = null;
      $poffset = $pos * $col_mul;
      if(strpos($colour, ':') !== false) {
        // opacity, stop offset or both
        $parts = explode(':', $colour);
        if(is_numeric($parts[0])) {
          $poffset = array_shift($parts);
        }
        $colour = array_shift($parts);
        $opacity = array_shift($parts); // NULL if not set
      }
      // set the offset to the most meaningful number
      $offset = min(100, max(0, $offset, $poffset));
      $stop = ['offset' => $offset . '%', 'stop-color' => $colour];
      if(is_numeric($opacity))
        $stop['stop-opacity'] = $opacity;
      $stops .= $this->graph->element('stop', $stop);
    }

    return $this->graph->element($type, $gradient, null, $stops);
  }

  /**
   * Defines the list of gradients
   */
  public function makeGradients(&$defs)
  {
    foreach($this->gradients as $key => $gradient)
      $defs[] = $this->makeGradient($key);
  }
}

