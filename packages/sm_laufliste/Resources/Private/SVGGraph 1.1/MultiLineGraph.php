<?php
/**
 * Copyright (C) 2011-2019 Graham Breach
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
 * MultiLineGraph - joined line, with axes and grid
 */
class MultiLineGraph extends LineGraph {

  use MultiGraphTrait;

  protected function draw()
  {
    $body = $this->grid() . $this->underShapes();

    $plots = '';
    $y_axis_pos = $this->height - $this->pad_bottom -
      $this->y_axes[$this->main_y_axis]->zero();
    $y_bottom = min($y_axis_pos, $this->height - $this->pad_bottom);

    $chunk_count = count($this->multi_graph);
    $this->colourSetup($this->multi_graph->itemsCount(-1), $chunk_count);

    for($i = 0; $i < $chunk_count; ++$i) {
      $bnum = 0;
      $points = [];
      $plot = '';
      $line_breaks = $this->getOption(['line_breaks', $i]);
      $axis = $this->datasetYAxis($i);
      foreach($this->multi_graph[$i] as $item) {
        if($line_breaks && is_null($item->value) && count($points) > 0) {
          $plot .= $this->drawLine($i, $points, $y_bottom);
          $points = [];
        } else {
          $x = $this->gridPosition($item, $bnum);
          if(!is_null($x) && !is_null($item->value)) {
            $y = $this->gridY($item->value, $axis);
            $points[] = [$x, $y, $item, $i, $bnum];
          }
        }
        ++$bnum;
      }

      $plot .= $this->drawLine($i, $points, $y_bottom);
      if($this->semantic_classes)
        $plots .= $this->element('g', ['class' => 'series'], null, $plot);
      else
        $plots .= $plot;
    }

    $group = [];
    $this->clipGrid($group);

    list($best_fit_above, $best_fit_below) = $this->bestFitLines();
    $body .= $best_fit_below;
    $body .= $this->element('g', $group, null, $plots);
    $body .= $this->overShapes();
    $body .= $this->axes();
    $body .= $this->crossHairs();
    $body .= $this->drawMarkers();
    $body .= $best_fit_above;
    return $body;
  }
}

